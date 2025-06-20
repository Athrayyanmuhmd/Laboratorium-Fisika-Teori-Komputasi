<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SuperAdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $staff = Staff::with('laboratory')
            ->when(request('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('position', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(request('laboratory'), function($query, $laboratory) {
                $query->where('laboratory_id', $laboratory);
            })
            ->when(request('status'), function($query, $status) {
                $query->where('is_active', $status === 'active');
            })
            ->latest()
            ->paginate(15);

        $laboratories = Laboratory::where('status', 'active')->get();

        $statistics = [
            'total' => Staff::count(),
            'active' => Staff::where('is_active', true)->count(),
            'inactive' => Staff::where('is_active', false)->count(),
            'by_laboratory' => Staff::with('laboratory')
                ->selectRaw('laboratory_id, COUNT(*) as count')
                ->groupBy('laboratory_id')
                ->get()
        ];

        return view('admin.super.staff.index', compact('staff', 'laboratories', 'statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.staff.create', compact('laboratories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'specialization' => 'nullable|string|max:500',
            'education' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('staff', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Staff::create($validated);

        return redirect()->route('super-admin.staff.index')
            ->with('success', 'Staff berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff): View
    {
        $staff->load('laboratory');
        
        return view('admin.super.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.staff.edit', compact('staff', 'laboratories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff): RedirectResponse
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|unique:staff,email,' . $staff->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'specialization' => 'nullable|string|max:500',
            'education' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($staff->photo_path) {
                Storage::disk('public')->delete($staff->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('staff', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $staff->update($validated);

        return redirect()->route('super-admin.staff.index')
            ->with('success', 'Staff berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff): RedirectResponse
    {
        // Delete photo if exists
        if ($staff->photo_path) {
            Storage::disk('public')->delete($staff->photo_path);
        }

        $staff->delete();

        return redirect()->route('super-admin.staff.index')
            ->with('success', 'Staff berhasil dihapus!');
    }

    public function toggleStatus(Staff $staff): RedirectResponse
    {
        $staff->update(['is_active' => !$staff->is_active]);

        $status = $staff->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Staff berhasil {$status}!");
    }

    public function toggleFeatured(Staff $staff)
    {
        $staff->update([
            'is_featured' => !$staff->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $staff->is_featured
        ]);
    }
}
