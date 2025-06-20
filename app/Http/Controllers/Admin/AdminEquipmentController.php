<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminEquipmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Equipment::with('laboratory');
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }
        
        $equipment = $query->paginate(12);
        
        // Get filter options
        $categories = Equipment::distinct()->pluck('category')->filter()->sort();
        $statuses = ['available', 'rented', 'maintenance', 'retired'];
        $conditions = ['excellent', 'good', 'fair', 'poor', 'damaged'];
        
        return view('admin.equipment.index', compact('equipment', 'categories', 'statuses', 'conditions'));
    }

    public function create(): View
    {
        $laboratories = Laboratory::all();
        return view('admin.equipment.create', compact('laboratories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:equipment,code',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'purchase_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'condition' => 'required|in:excellent,good,fair,poor,damaged',
            'status' => 'required|in:available,rented,maintenance,retired',
            'last_calibration' => 'nullable|date',
            'next_calibration' => 'nullable|date|after:last_calibration',
            'rental_price_per_day' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string'
        ]);

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('equipment', $filename, 'public');
                $images[] = $path;
            }
        }

        $validated['images'] = $images;
        $validated['available_quantity'] = $validated['quantity'];

        Equipment::create($validated);

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Alat laboratorium berhasil ditambahkan.');
    }

    public function show(Equipment $equipment): View
    {
        $equipment->load(['laboratory', 'rentals.equipment', 'maintenanceRecords']);
        return view('admin.equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment): View
    {
        $laboratories = Laboratory::all();
        return view('admin.equipment.edit', compact('equipment', 'laboratories'));
    }

    public function update(Request $request, Equipment $equipment): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:equipment,code,' . $equipment->id,
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'purchase_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'condition' => 'required|in:excellent,good,fair,poor,damaged',
            'status' => 'required|in:available,rented,maintenance,retired',
            'last_calibration' => 'nullable|date',
            'next_calibration' => 'nullable|date|after:last_calibration',
            'rental_price_per_day' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
            'remove_images' => 'nullable|array'
        ]);

        // Handle image removal
        if ($request->filled('remove_images')) {
            $currentImages = $equipment->images ?? [];
            foreach ($request->remove_images as $imageToRemove) {
                if (in_array($imageToRemove, $currentImages)) {
                    Storage::disk('public')->delete($imageToRemove);
                    $currentImages = array_filter($currentImages, fn($img) => $img !== $imageToRemove);
                }
            }
            $validated['images'] = array_values($currentImages);
        } else {
            $validated['images'] = $equipment->images ?? [];
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('equipment', $filename, 'public');
                $validated['images'][] = $path;
            }
        }

        // Update available quantity if total quantity changed
        $quantityDiff = $validated['quantity'] - $equipment->quantity;
        $validated['available_quantity'] = max(0, $equipment->available_quantity + $quantityDiff);

        $equipment->update($validated);

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Alat laboratorium berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        // Check if equipment has active rentals
        if ($equipment->rentals()->whereIn('status', ['pending', 'approved'])->exists()) {
            return redirect()->route('admin.equipment.index')
                ->with('error', 'Tidak dapat menghapus alat yang sedang dipinjam atau memiliki permintaan pending.');
        }

        // Delete images
        if ($equipment->images) {
            foreach ($equipment->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $equipment->delete();

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Alat laboratorium berhasil dihapus.');
    }

    public function toggleStatus(Equipment $equipment): RedirectResponse
    {
        $newStatus = $equipment->status === 'available' ? 'maintenance' : 'available';
        $equipment->update(['status' => $newStatus]);

        $message = $newStatus === 'available' 
            ? 'Alat berhasil diaktifkan.' 
            : 'Alat berhasil dinonaktifkan untuk pemeliharaan.';

        return redirect()->back()->with('success', $message);
    }
}
