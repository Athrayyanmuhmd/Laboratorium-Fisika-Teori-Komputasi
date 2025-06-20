@extends('layouts.super-admin')

@section('title', 'Gallery Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="p-6 space-y-6">
        <!-- Page Header -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        🖼️ Gallery Management
                    </h1>
                    <p class="text-gray-600 mt-2">Manage laboratory gallery and visual documentation</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('super-admin.gallery.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add Image</span>
                    </a>
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium">Total: {{ $gallery->count() }} Images</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Images -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Images</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $gallery->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="text-green-600 font-medium">{{ $gallery->where('is_active', true)->count() }} Published</span>
                        <span class="text-gray-400 mx-2">•</span>
                        <span class="text-amber-600 font-medium">{{ $gallery->where('is_active', false)->count() }} Draft</span>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Categories</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $gallery->pluck('category')->unique()->count() }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Laboratory, Equipment, Activities
                    </div>
                </div>
            </div>

            <!-- Featured Images -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Featured</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $gallery->where('is_featured', true)->count() }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Displayed on landing page
                    </div>
                </div>
            </div>

            <!-- Storage Used -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Storage</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ number_format($gallery->count() * 2.5, 1) }} MB
                        </p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-sm text-gray-600">
                        Estimated usage
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <form method="GET" action="{{ route('super-admin.gallery.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search images..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                
                <select name="category" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    <option value="laboratory" {{ request('category') == 'laboratory' ? 'selected' : '' }}>Laboratory</option>
                    <option value="equipment" {{ request('category') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                    <option value="activities" {{ request('category') == 'activities' ? 'selected' : '' }}>Activities</option>
                    <option value="facilities" {{ request('category') == 'facilities' ? 'selected' : '' }}>Facilities</option>
                </select>
                
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Published</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Draft</option>
                </select>
                
                <select name="featured" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Images</option>
                    <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                    <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                </select>
                
                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('super-admin.gallery.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-center transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Gallery Images</h3>
                    <p class="text-sm text-gray-600 mt-1">Manage your laboratory gallery collection</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="toggleView()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg transition-colors">
                        <span id="view-toggle-text">List View</span>
                    </button>
                </div>
            </div>
            
            @if($gallery->count() > 0)
                <!-- Grid View -->
                <div id="grid-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($gallery as $image)
                    <div class="group relative bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200">
                        <!-- Image Container -->
                        <div class="relative aspect-video bg-gray-100 overflow-hidden">
                            @if($image->image_path)
                                <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onclick="openLightbox('{{ Storage::url($image->image_path) }}', '{{ $image->title }}', '{{ $image->description }}')">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay Actions -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300">
                                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button onclick="toggleFeatured({{ $image->id }}, {{ $image->is_featured ? 'false' : 'true' }})"
                                            class="bg-white/20 backdrop-blur-sm text-white p-2 rounded-full hover:bg-white/30 transition-colors">
                                        <i class="fas fa-star {{ $image->is_featured ? 'text-yellow-400' : 'text-white' }}"></i>
                                    </button>
                                </div>
                                <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('super-admin.gallery.edit', $image) }}" 
                                           class="bg-white/20 backdrop-blur-sm text-white p-2 rounded-full hover:bg-white/30 transition-colors">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button onclick="deleteImage({{ $image->id }})" 
                                                class="bg-red-500/80 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600/80 transition-colors">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Info -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-medium text-gray-900 text-sm line-clamp-2">{{ $image->title }}</h4>
                                <div class="flex space-x-1 ml-2">
                                    @if($image->is_featured)
                                        <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full" title="Featured"></span>
                                    @endif
                                    <span class="inline-block w-2 h-2 {{ $image->is_active ? 'bg-green-500' : 'bg-gray-400' }} rounded-full" 
                                          title="{{ $image->is_active ? 'Published' : 'Draft' }}"></span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 line-clamp-2 mb-2">{{ $image->description }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span class="bg-gray-100 px-2 py-1 rounded-full">{{ ucfirst($image->category) }}</span>
                                <span>{{ $image->created_at->format('M d') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- List View (Hidden by default) -->
                <div id="list-view" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($gallery as $image)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                @if($image->image_path)
                                                    <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->title }}" 
                                                         class="w-16 h-16 rounded-lg object-cover shadow-md">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $image->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($image->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ ucfirst($image->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $image->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $image->is_active ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleFeatured({{ $image->id }}, {{ $image->is_featured ? 'false' : 'true' }})"
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full cursor-pointer transition-colors
                                                    {{ $image->is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $image->is_featured ? 'Featured' : 'Not Featured' }}
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('super-admin.gallery.edit', $image) }}" 
                                               class="text-amber-600 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 px-3 py-1 rounded-lg transition-colors">
                                                Edit
                                            </a>
                                            <button onclick="deleteImage({{ $image->id }})" 
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
                </div>
                
                <div class="mt-6">
                    {{ $gallery->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No images found</h3>
                    <p class="text-gray-500 mb-6">Get started by uploading your first image.</p>
                    <a href="{{ route('super-admin.gallery.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Upload First Image
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
    <div class="max-w-4xl max-h-full relative">
        <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white p-4 rounded-b-lg">
            <h3 id="lightbox-title" class="text-xl font-semibold mb-2"></h3>
            <p id="lightbox-description" class="text-gray-300"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleView() {
    const gridView = document.getElementById('grid-view');
    const listView = document.getElementById('list-view');
    const toggleText = document.getElementById('view-toggle-text');
    
    if (gridView.classList.contains('hidden')) {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        toggleText.textContent = 'List View';
    } else {
        gridView.classList.add('hidden');
        listView.classList.remove('hidden');
        toggleText.textContent = 'Grid View';
    }
}

function openLightbox(imageSrc, title, description) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');
    
    lightboxImage.src = imageSrc;
    lightboxTitle.textContent = title;
    lightboxDescription.textContent = description;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function toggleFeatured(imageId, featured) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PATCH');
    formData.append('is_featured', featured);

    fetch(`/super-admin/gallery/${imageId}/toggle-featured`, {
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

function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/super-admin/gallery/${imageId}`;
        
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

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Close lightbox with escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>
@endpush
@endsection 