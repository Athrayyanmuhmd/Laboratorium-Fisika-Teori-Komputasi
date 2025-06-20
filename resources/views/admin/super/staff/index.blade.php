@extends('layouts.super-admin')

@section('title', 'Staff Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="p-6 space-y-6">
        <!-- Page Header -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        👥 Staff Management
                    </h1>
                    <p class="text-gray-600 mt-2">Manage laboratory staff and expertise team</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('super-admin.staff.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add Staff</span>
                    </a>
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium">Total: {{ $staff->count() }} Staff</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Staff -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Staff</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $staff->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="text-green-600 font-medium">{{ $staff->where('is_active', true)->count() }} Active</span>
                        <span class="text-gray-400 mx-2">•</span>
                        <span class="text-amber-600 font-medium">{{ $staff->where('is_active', false)->count() }} Inactive</span>
                    </div>
                </div>
            </div>

            <!-- Active Research -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Research Areas</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $staff->pluck('specialization')->unique()->count() }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Computational Physics, Data Analysis, Web Development
                    </div>
                </div>
            </div>

            <!-- Published on Website -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Published</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $staff->where('is_featured', true)->count() }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Displayed on landing page
                    </div>
                </div>
            </div>

            <!-- Department Count -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Departments</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $staff->pluck('department')->unique()->count() }}</p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Physics, Computer Science
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <form method="GET" action="{{ route('super-admin.staff.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search staff..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                
                <select name="featured" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Staff</option>
                    <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                    <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                </select>
                
                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('super-admin.staff.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-center transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Staff Table -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Staff Directory</h3>
                <p class="text-sm text-gray-600 mt-1">Manage your laboratory staff and expertise team</p>
            </div>
            
            @if($staff->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($staff as $member)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            @if($member->photo_path)
                                                <img src="{{ Storage::url($member->photo_path) }}" alt="{{ $member->name }}" 
                                                     class="w-12 h-12 rounded-xl object-cover shadow-md">
                                            @else
                                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                                    <span class="text-white font-bold text-lg">{{ substr($member->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $member->position }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->laboratory->name ?? 'No Laboratory' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $member->specialization }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="toggleFeatured({{ $member->id }}, {{ $member->is_featured ? 'false' : 'true' }})"
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full cursor-pointer transition-colors
                                                {{ $member->is_featured ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->is_featured ? 'Featured' : 'Not Featured' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('super-admin.staff.show', $member) }}" 
                                           class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            View
                                        </a>
                                        <a href="{{ route('super-admin.staff.edit', $member) }}" 
                                           class="text-amber-600 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 px-3 py-1 rounded-lg transition-colors">
                                            Edit
                                        </a>
                                        <button onclick="deleteStaff({{ $member->id }})" 
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $staff->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No staff found</h3>
                    <p class="text-gray-500 mb-6">Get started by adding your first staff member.</p>
                    <a href="{{ route('super-admin.staff.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Add First Staff
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleFeatured(staffId, featured) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PATCH');
    formData.append('is_featured', featured);

    fetch(`/super-admin/staff/${staffId}/toggle-featured`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating featured status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating featured status');
    });
}

function deleteStaff(staffId) {
    if (confirm('Are you sure you want to delete this staff member?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/super-admin/staff/${staffId}`;
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(tokenInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
@endsection 