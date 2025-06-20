@extends('layouts.admin')

@section('title', 'Manajemen Alat Laboratorium')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Alat Laboratorium</h1>
            <p class="text-gray-600 mt-1">Kelola inventaris alat laboratorium fisika teori dan komputasi</p>
        </div>
        <a href="{{ route('admin.equipment.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center mt-4 sm:mt-0">
            <i class="fas fa-plus mr-2"></i>
            Tambah Alat
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-microscope text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-600">Total Alat</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $equipment->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-600">Tersedia</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $equipment->where('status', 'available')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-orange-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 rounded-lg">
                    <i class="fas fa-tools text-orange-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-orange-600">Maintenance</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $equipment->where('status', 'maintenance')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-600">Rusak</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $equipment->where('condition', 'damaged')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Nama, kode, brand..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category" id="category" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="condition" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                <select name="condition" id="condition" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Kondisi</option>
                    @foreach($conditions as $condition)
                        <option value="{{ $condition }}" {{ request('condition') === $condition ? 'selected' : '' }}>
                            {{ ucfirst($condition) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex items-end space-x-2">
                <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
                <a href="{{ route('admin.equipment.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Equipment Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($equipment as $item)
            <div class="bg-white rounded-lg shadow-sm border hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="aspect-w-16 aspect-h-12 bg-gray-200 rounded-t-lg overflow-hidden">
                    @if($item->images && count($item->images) > 0)
                        <img src="{{ asset('storage/' . $item->images[0]) }}" 
                             alt="{{ $item->name }}"
                             class="w-full h-48 object-cover"
                             onerror="this.parentElement.innerHTML='<div class=\'w-full h-48 flex items-center justify-center bg-gray-100\'><i class=\'fas fa-microscope text-4xl text-gray-400\'></i></div>'">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                            <i class="fas fa-microscope text-4xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-semibold text-gray-900 text-sm line-clamp-2">{{ $item->name }}</h3>
                        <div class="flex space-x-1 ml-2">
                            <!-- Status Badge -->
                            @if($item->status === 'available')
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Tersedia</span>
                            @elseif($item->status === 'rented')
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Dipinjam</span>
                            @elseif($item->status === 'maintenance')
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Maintenance</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Retired</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="space-y-1 text-sm text-gray-600 mb-3">
                        <p><span class="font-medium">Kode:</span> {{ $item->code }}</p>
                        @if($item->brand)
                            <p><span class="font-medium">Brand:</span> {{ $item->brand }}</p>
                        @endif
                        <p><span class="font-medium">Kategori:</span> {{ ucfirst($item->category) }}</p>
                        <p><span class="font-medium">Kondisi:</span> 
                            <span class="inline-flex items-center">
                                @if($item->condition === 'excellent')
                                    <i class="fas fa-star text-green-500 mr-1"></i>
                                @elseif($item->condition === 'good')
                                    <i class="fas fa-thumbs-up text-blue-500 mr-1"></i>
                                @elseif($item->condition === 'fair')
                                    <i class="fas fa-minus-circle text-yellow-500 mr-1"></i>
                                @elseif($item->condition === 'poor')
                                    <i class="fas fa-exclamation-circle text-orange-500 mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-red-500 mr-1"></i>
                                @endif
                                {{ ucfirst($item->condition) }}
                            </span>
                        </p>
                        <p><span class="font-medium">Jumlah:</span> {{ $item->available_quantity }}/{{ $item->quantity }}</p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.equipment.show', $item) }}" 
                           class="flex-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-3 py-2 rounded-lg text-xs font-medium text-center">
                            Detail
                        </a>
                        <a href="{{ route('admin.equipment.edit', $item) }}" 
                           class="flex-1 bg-orange-50 hover:bg-orange-100 text-orange-600 px-3 py-2 rounded-lg text-xs font-medium text-center">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.equipment.toggle-status', $item) }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-3 py-2 rounded-lg text-xs font-medium {{ $item->status === 'available' ? 'bg-yellow-50 hover:bg-yellow-100 text-yellow-600' : 'bg-green-50 hover:bg-green-100 text-green-600' }}">
                                {{ $item->status === 'available' ? 'Nonaktif' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-microscope text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada alat laboratorium</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan alat laboratorium pertama Anda</p>
                <a href="{{ route('admin.equipment.create') }}" 
                   class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Alat
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($equipment->hasPages())
        <div class="flex justify-center">
            {{ $equipment->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection 