<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SuperAdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $galleries = Gallery::with('laboratory')
            ->when(request('search'), function($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when(request('category'), function($query, $category) {
                $query->where('category', $category);
            })
            ->when(request('laboratory'), function($query, $laboratory) {
                $query->where('laboratory_id', $laboratory);
            })
            ->when(request('status'), function($query, $status) {
                $query->where('is_active', $status === 'active');
            })
            ->when(request('featured'), function($query, $featured) {
                $query->where('is_featured', $featured === 'yes');
            })
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        $laboratories = Laboratory::where('status', 'active')->get();

        $statistics = [
            'total' => Gallery::count(),
            'active' => Gallery::where('is_active', true)->count(),
            'featured' => Gallery::where('is_featured', true)->count(),
            'by_category' => Gallery::selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->get()
                ->pluck('count', 'category')
                ->toArray()
        ];

        return view('admin.super.gallery.index', compact('galleries', 'laboratories', 'statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.gallery.create', compact('laboratories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
            'image_alt' => 'nullable|string|max:255',
            'category' => 'required|in:facility,equipment,activity,staff,research',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Gallery::create($validated);

        return redirect()->route('super-admin.gallery.index')
            ->with('success', 'Gallery item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): View
    {
        $gallery->load('laboratory');
        
        return view('admin.super.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.gallery.edit', compact('gallery', 'laboratories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_alt' => 'nullable|string|max:255',
            'category' => 'required|in:facility,equipment,activity,staff,research',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $gallery->sort_order;

        $gallery->update($validated);

        return redirect()->route('super-admin.gallery.index')
            ->with('success', 'Gallery item berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Delete image if exists
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('super-admin.gallery.index')
            ->with('success', 'Gallery item berhasil dihapus!');
    }

    public function toggleStatus(Gallery $gallery): RedirectResponse
    {
        $gallery->update(['is_active' => !$gallery->is_active]);

        $status = $gallery->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Gallery item berhasil {$status}!");
    }

    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update([
            'is_featured' => !$gallery->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $gallery->is_featured
        ]);
    }
}
