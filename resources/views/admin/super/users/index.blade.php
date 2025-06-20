@extends('layouts.super-admin')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('breadcrumb', 'Super Admin / User Management')

@push('styles')
<style>
    .user-card {
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .role-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .role-super-admin {
        background: linear-gradient(135deg, #7c3aed, #a855f7);
        color: white;
    }
    
    .role-lab-admin {
        background: rgba(59, 130, 246, 0.1);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .role-staff {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .role-user {
        background: rgba(107, 114, 128, 0.1);
        color: #374151;
        border: 1px solid rgba(107, 114, 128, 0.2);
    }
    
    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .status-inactive {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    
    .filter-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(139, 92, 246, 0.05));
        border: 2px solid rgba(59, 130, 246, 0.1);
        backdrop-filter: blur(20px);
    }
</style>
@endpush

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-3xl font-bold font-display text-gray-800">User Management</h1>
            <p class="text-gray-600 mt-2">Manage system users, roles, and permissions</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('super-admin.users.create') }}" 
               class="btn-modern gradient-primary text-white px-6 py-3 rounded-xl font-medium shadow-colored">
                <i class="fas fa-plus mr-2"></i>
                Add New User
            </a>
            <button class="btn-modern bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium shadow-soft hover:bg-gray-50">
                <i class="fas fa-download mr-2"></i>
                Export
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-white rounded-xl p-6 shadow-soft">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl gradient-primary flex items-center justify-center mr-4">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ number_format($statistics['total']) }}</div>
                    <div class="text-sm text-gray-500">Total Users</div>
                </div>
            </div>
        </div>
        
        <div class="glass-white rounded-xl p-6 shadow-soft">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mr-4">
                    <i class="fas fa-crown text-white text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ $statistics['super_admins'] + $statistics['lab_admins'] }}</div>
                    <div class="text-sm text-gray-500">Administrators</div>
                </div>
            </div>
        </div>
        
        <div class="glass-white rounded-xl p-6 shadow-soft">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-success-500 to-success-600 flex items-center justify-center mr-4">
                    <i class="fas fa-user-check text-white text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ $statistics['active'] }}</div>
                    <div class="text-sm text-gray-500">Active Users</div>
                </div>
            </div>
        </div>
        
        <div class="glass-white rounded-xl p-6 shadow-soft">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-warning-500 to-warning-600 flex items-center justify-center mr-4">
                    <i class="fas fa-user-tie text-white text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ $statistics['staff'] }}</div>
                    <div class="text-sm text-gray-500">Staff Members</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-card rounded-xl p-6 shadow-soft">
        <form method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search Users</label>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by name or email..."
                       class="input-modern w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:ring-0">
            </div>
            
            <div class="min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" class="input-modern w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:ring-0">
                    <option value="">All Roles</option>
                    <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="lab_admin" {{ request('role') === 'lab_admin' ? 'selected' : '' }}>Lab Admin</option>
                    <option value="staff" {{ request('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            
            <div class="min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="input-modern w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:ring-0">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="flex space-x-2">
                <button type="submit" 
                        class="btn-modern bg-primary-500 text-white px-6 py-3 rounded-lg font-medium shadow-colored hover:bg-primary-600">
                    <i class="fas fa-search mr-2"></i>
                    Search
                </button>
                
                <a href="{{ route('super-admin.users.index') }}" 
                   class="btn-modern bg-gray-500 text-white px-6 py-3 rounded-lg font-medium shadow-soft hover:bg-gray-600">
                    <i class="fas fa-times mr-2"></i>
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Users List -->
    <div class="glass-white rounded-xl shadow-large overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Users List</h3>
                <div class="text-sm text-gray-500">
                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
                </div>
            </div>
        </div>

        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laboratory</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center mr-4">
                                        <span class="text-white text-sm font-bold">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        @if($user->phone)
                                            <div class="text-xs text-gray-400">{{ $user->phone }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="role-badge role-{{ $user->role }}">
                                    @if($user->role === 'super_admin')
                                        <i class="fas fa-crown mr-1"></i>
                                        Super Admin
                                    @elseif($user->role === 'lab_admin')
                                        <i class="fas fa-user-cog mr-1"></i>
                                        Lab Admin
                                    @elseif($user->role === 'staff')
                                        <i class="fas fa-user-tie mr-1"></i>
                                        Staff
                                    @else
                                        <i class="fas fa-user mr-1"></i>
                                        User
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->laboratory)
                                    <div class="text-sm text-gray-900">{{ $user->laboratory->name }}</div>
                                @else
                                    <span class="text-gray-400 text-sm">No Laboratory</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="role-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('super-admin.users.show', $user) }}" 
                                       class="text-primary-600 hover:text-primary-800 p-2 rounded-lg hover:bg-primary-50 transition-colors">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('super-admin.users.edit', $user) }}" 
                                       class="text-warning-600 hover:text-warning-800 p-2 rounded-lg hover:bg-warning-50 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('super-admin.users.toggle-status', $user) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="{{ $user->is_active ? 'text-red-600 hover:text-red-800 hover:bg-red-50' : 'text-green-600 hover:text-green-800 hover:bg-green-50' }} p-2 rounded-lg transition-colors">
                                                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('super-admin.users.destroy', $user) }}" 
                                              class="inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No users found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first user.</p>
                <a href="{{ route('super-admin.users.create') }}" 
                   class="btn-modern gradient-primary text-white px-6 py-3 rounded-xl font-medium shadow-colored">
                    <i class="fas fa-plus mr-2"></i>
                    Add New User
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 