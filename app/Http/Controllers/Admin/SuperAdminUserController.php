<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::with('laboratory')
            ->when(request('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(request('role'), function($query, $role) {
                $query->where('role', $role);
            })
            ->when(request('status'), function($query, $status) {
                $query->where('is_active', $status === 'active');
            })
            ->latest()
            ->paginate(15);

        $statistics = [
            'total' => User::count(),
            'super_admins' => User::where('role', 'super_admin')->count(),
            'lab_admins' => User::where('role', 'lab_admin')->count(),
            'staff' => User::where('role', 'staff')->count(),
            'users' => User::where('role', 'user')->count(),
            'active' => User::where('is_active', true)->count(),
            'inactive' => User::where('is_active', false)->count(),
        ];

        return view('admin.super.users.index', compact('users', 'statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.users.create', compact('laboratories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,lab_admin,dosen,staff,user',
            'laboratory_id' => 'nullable|exists:laboratories,id',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');

        User::create($validated);

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $user->load(['laboratory', 'approvedRentals', 'approvedVisits', 'approvedTests']);
        
        return view('admin.super.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $laboratories = Laboratory::where('status', 'active')->get();
        
        return view('admin.super.users.edit', compact('user', 'laboratories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,lab_admin,dosen,staff,user',
            'laboratory_id' => 'nullable|exists:laboratories,id',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');

        $user->update($validated);

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Prevent deletion of self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        // Prevent deletion of the only super admin
        if ($user->role === 'super_admin' && User::where('role', 'super_admin')->count() === 1) {
            return back()->with('error', 'Tidak dapat menghapus satu-satunya Super Admin!');
        }

        $user->delete();

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        // Prevent deactivating self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri!');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil {$status}!");
    }

    public function changeRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => 'required|in:super_admin,lab_admin,dosen,staff,user'
        ]);

        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role sendiri!');
        }

        // Prevent removing the only super admin
        if ($user->role === 'super_admin' && 
            $request->role !== 'super_admin' && 
            User::where('role', 'super_admin')->count() === 1) {
            return back()->with('error', 'Tidak dapat mengubah role satu-satunya Super Admin!');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role user berhasil diubah!');
    }
}
