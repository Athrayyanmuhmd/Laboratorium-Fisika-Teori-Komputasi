<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminRentalController extends Controller
{
    public function index(Request $request): View
    {
        $query = Rental::with(['equipment', 'equipment.laboratory']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('start_date', '<=', $request->date_to);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('requester_name', 'like', "%{$search}%")
                  ->orWhere('requester_email', 'like', "%{$search}%")
                  ->orWhere('requester_phone', 'like', "%{$search}%")
                  ->orWhere('project_title', 'like', "%{$search}%");
            });
        }
        
        $rentals = $query->latest()->paginate(15);
        
        // Statistics
        $stats = [
            'total' => Rental::count(),
            'pending' => Rental::where('status', 'pending')->count(),
            'approved' => Rental::where('status', 'approved')->count(),
            'returned' => Rental::where('status', 'returned')->count(),
            'rejected' => Rental::where('status', 'rejected')->count(),
        ];
        
        return view('admin.simulations.index', compact('rentals', 'stats'));
    }

    public function show(Rental $rental): View
    {
        $rental->load(['equipment', 'equipment.laboratory', 'approvedBy', 'returnedBy']);
        return view('admin.simulations.show', compact('rental'));
    }

    public function edit(Rental $rental): View
    {
        $equipment = Equipment::where('status', 'available')->get();
        return view('admin.simulations.edit', compact('rental', 'equipment'));
    }

    public function update(Request $request, Rental $rental): RedirectResponse
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'admin_notes' => 'nullable|string',
        ]);

        // Calculate duration
        $validated['duration'] = now()->parse($validated['start_date'])->diffInDays($validated['end_date']) + 1;

        $rental->update($validated);

        return redirect()->route('admin.simulations.show', $rental)
            ->with('success', 'Permintaan simulasi berhasil diperbarui.');
    }

    public function approve(Request $request, Rental $rental): RedirectResponse
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Hanya permintaan dengan status pending yang dapat disetujui.');
        }

        $validated = $request->validate([
            'approved_start_date' => 'required|date',
            'approved_end_date' => 'required|date|after:approved_start_date',
            'admin_notes' => 'nullable|string',
        ]);

        // Update rental
        $rental->update([
            'status' => 'approved',
            'start_date' => $validated['approved_start_date'],
            'end_date' => $validated['approved_end_date'],
            'duration' => now()->parse($validated['approved_start_date'])->diffInDays($validated['approved_end_date']) + 1,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'admin_notes' => $validated['admin_notes'],
        ]);

        // Update equipment availability if specific equipment is assigned
        if ($rental->equipment_id) {
            $equipment = $rental->equipment;
            if ($equipment->available_quantity > 0) {
                $equipment->decrement('available_quantity');
                if ($equipment->available_quantity == 0) {
                    $equipment->update(['status' => 'rented']);
                }
            }
        }

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Permintaan simulasi berhasil disetujui.');
    }

    public function reject(Request $request, Rental $rental): RedirectResponse
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Hanya permintaan dengan status pending yang dapat ditolak.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $rental->update([
            'status' => 'rejected',
            'admin_notes' => $validated['rejection_reason'],
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Permintaan simulasi berhasil ditolak.');
    }

    public function return(Request $request, Rental $rental): RedirectResponse
    {
        if ($rental->status !== 'approved') {
            return back()->with('error', 'Hanya permintaan yang disetujui yang dapat diselesaikan.');
        }

        $validated = $request->validate([
            'return_condition' => 'required|in:good,damaged,missing',
            'return_notes' => 'nullable|string',
            'actual_return_date' => 'required|date',
        ]);

        $rental->update([
            'status' => 'returned',
            'returned_by' => Auth::id(),
            'returned_at' => $validated['actual_return_date'],
            'return_condition' => $validated['return_condition'],
            'return_notes' => $validated['return_notes'],
        ]);

        // Update equipment availability
        if ($rental->equipment_id) {
            $equipment = $rental->equipment;
            $equipment->increment('available_quantity');
            
            // Update equipment status if needed
            if ($equipment->available_quantity > 0 && $equipment->status === 'rented') {
                $equipment->update(['status' => 'available']);
            }
            
            // Update equipment condition if damaged
            if ($validated['return_condition'] === 'damaged') {
                $equipment->update(['condition' => 'poor']);
            }
        }

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Simulasi berhasil diselesaikan.');
    }
}
