@extends('layouts.admin')

@section('title', 'Manajemen Alat')
@section('subtitle', 'Kelola Inventaris Peralatan Laboratorium')

@section('content')
<style>
    /* Subtle Glassmorphism Styles */
    .glass-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.1);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(59, 130, 246, 0.15);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.25);
    }
    
    /* Ensure equal height cards */
    .card-grid {
        display: grid;
        grid-template-rows: 1fr;
    }
    
    .card-content {
        display: grid;
        grid-template-rows: auto auto 1fr auto auto;
        height: 100%;
        min-height: 420px;
        gap: 0.5rem;
    }
    
    .card-header {
        grid-row: 1;
    }
    
    .card-description {
        grid-row: 2;
        min-height: 60px;
    }
    
    .card-info-grid {
        grid-row: 4;
        align-self: end;
        margin-bottom: 0.5rem;
    }
    
    .card-buttons {
        grid-row: 5;
        align-self: end;
        margin-top: 1rem;
    }
    
    .glass-header {
        background: linear-gradient(135deg, 
            rgba(59, 130, 246, 0.8) 0%, 
            rgba(79, 70, 229, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .glass-modal {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .glass-button {
        background: linear-gradient(135deg, 
            rgba(59, 130, 246, 0.15) 0%, 
            rgba(79, 70, 229, 0.15) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: #3b82f6;
        transition: all 0.3s ease;
    }
    
    .glass-button:hover {
        background: linear-gradient(135deg, 
            rgba(59, 130, 246, 0.25) 0%, 
            rgba(79, 70, 229, 0.25) 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.2);
        color: #2563eb;
    }
    
    .glass-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: #374151;
    }
    
    .glass-input::placeholder {
        color: rgba(107, 114, 128, 0.7);
    }
    
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .status-badge {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .modal-overlay {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.3);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.5);
    }
    
    /* Dropdown Z-Index Fix - Using very high z-index values */
    .glass-header {
        position: relative;
        z-index: 10;
    }
    
    .dropdown-container {
        position: relative;
        z-index: 9999 !important;
    }
    
    .dropdown-menu {
        position: absolute;
        z-index: 10000 !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: translateY(0);
    }
    
    /* Ensure statistics cards don't overlap dropdown */
    .statistics-grid {
        position: relative;
        z-index: 1;
    }
    
    .glass-card {
        position: relative;
        z-index: 1;
    }
    
    /* Additional fix for header buttons container */
    .header-buttons-container {
        position: relative;
        z-index: 9999;
    }
    
    /* Force dropdown to appear above everything */
    #exportMenu {
        position: fixed !important;
        z-index: 99999 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95) !important;
    }
    
    /* Override any conflicting z-index from other elements */
    .min-h-screen > * {
        position: relative;
    }
    
    .min-h-screen > .glass-header {
        z-index: 10;
    }
    
    .min-h-screen > .statistics-grid {
        z-index: 1;
    }
</style>

<!-- Clean White Background -->
<div class="fixed inset-0 -z-10 bg-gray-50"></div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="min-h-screen p-6 space-y-8">
    <!-- Header Section -->
    <div class="glass-header rounded-3xl p-8 text-white shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-4xl font-bold mb-2 text-white">
                    Manajemen Alat Laboratorium
                </h1>
                <p class="text-white/90 text-lg">Sistem manajemen peralatan laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $alat->count() }}</div>
                <div class="text-white/80 text-sm">Total Peralatan</div>
            </div>
        </div>
        
        <div class="header-buttons-container flex flex-wrap gap-4">
            <button onclick="openCreateModal()" 
                    class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Alat Baru
            </button>
            <div class="dropdown-container relative group" style="z-index: 9999 !important;">
                <button id="exportDropdown" class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg flex items-center">
                    <i class="fas fa-download mr-2"></i>Export Data
                    <i class="fas fa-chevron-down ml-2 text-sm"></i>
                </button>
                <div id="exportMenu" class="dropdown-menu rounded-xl min-w-48 hidden" style="z-index: 99999 !important; position: fixed;">
                    <div class="py-1">
                        <button onclick="exportData('csv')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 first:rounded-t-xl">
                            <i class="fas fa-file-csv text-green-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export CSV</div>
                                <div class="text-xs text-gray-500">Data dalam format spreadsheet</div>
                            </div>
                        </button>
                        <div class="border-t border-gray-100 mx-2"></div>
                        <button onclick="exportData('pdf')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 last:rounded-b-xl">
                            <i class="fas fa-file-pdf text-red-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export PDF</div>
                                <div class="text-xs text-gray-500">Laporan dalam format dokumen</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-chart-line mr-2"></i>Analytics
            </button>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="statistics-grid grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $alat->where('isBroken', false)->count() }}</div>
                    <div class="text-gray-600 text-sm">Alat Berfungsi</div>
                    </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $alat->where('isBroken', true)->count() }}</div>
                    <div class="text-gray-600 text-sm">Alat Rusak</div>
                    </div>
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $alat->sum('stok') }}</div>
                    <div class="text-gray-600 text-sm">Total Stok</div>
                    </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-boxes text-2xl text-blue-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $alat->where('stok', '<=', 5)->count() }}</div>
                    <div class="text-gray-600 text-sm">Stok Menipis</div>
                    </div>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-2xl text-yellow-600"></i>
                </div>
                </div>
            </div>
        </div>

    <!-- Search & Filter Section -->
    <div class="glass-container rounded-2xl p-6">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                    <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama alat atau deskripsi..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                    </div>
                </div>
                
                <div class="flex gap-3">
                <select name="status" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 min-w-40">
                        <option value="">Semua Status</option>
                        <option value="baik" {{ request('status') == 'baik' ? 'selected' : '' }}>Berfungsi</option>
                        <option value="rusak" {{ request('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                    <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </form>
    </div>

    <!-- Equipment Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 card-grid">
        @foreach($alat as $item)
                <div class="glass-card rounded-2xl p-6 hover:scale-105 transition-all duration-300 card-content">
            <!-- Card Header -->
            <div class="flex items-start justify-between card-header">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->nama }}</h3>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs text-gray-500 font-mono bg-gray-100 px-2 py-1 rounded-lg">
                            ID: {{ substr($item->id, 0, 8) }}
                        </span>
                        @if($item->isBroken)
                            <span class="status-badge bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Rusak
                            </span>
                        @else
                            <span class="status-badge bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>Berfungsi
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Equipment Image -->
            <div class="mb-4">
                @if($item->gambar)
                    <div class="relative overflow-hidden rounded-xl">
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->nama }}" 
                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                             onclick="openDetailModal({{ json_encode($item) }})"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500 text-sm font-medium">Tidak ada gambar</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="card-description">
                <p class="text-gray-600 text-sm leading-relaxed">
                    @if(strlen($item->deskripsi) > 80)
                        {{ Str::limit($item->deskripsi, 80) }}
                        <span class="text-blue-600 font-medium cursor-pointer hover:text-blue-800 transition-colors duration-200 inline-flex items-center gap-1" 
                              onclick="openDetailModal({{ json_encode($item) }})"
                              title="Klik untuk melihat deskripsi lengkap">
                            ... <i class="fas fa-external-link-alt text-xs"></i>
                        </span>
                    @else
                        {{ $item->deskripsi }}
                    @endif
                </p>
            </div>

            <!-- Stock and Price Info Grid -->
            <div class="grid grid-cols-2 gap-3 card-info-grid">
                <!-- Stock Info -->
                <div class="glass-container rounded-xl p-4 h-28 flex flex-col justify-between">
                    <div class="text-center flex-1 flex flex-col justify-center">
                        <div class="flex items-center justify-center mb-1">
                            <i class="fas fa-boxes text-blue-600 text-sm mr-1"></i>
                            <span class="text-xs text-gray-600 font-medium">Stok</span>
                                </div>
                        <div class="text-2xl font-bold text-gray-800 mb-1">{{ $item->stok }}</div>
                                @if($item->stok <= 5)
                            <div class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">
                                Menipis
                            </div>
                        @else
                            <div class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                Tersedia
                            </div>
                                @endif
                    </div>
                </div>

                <!-- Price Info -->
                <div class="glass-container rounded-xl p-4 h-28 flex flex-col justify-between">
                    <div class="text-center flex-1 flex flex-col justify-center">
                        <div class="flex items-center justify-center mb-1">
                            <i class="fas fa-tag text-green-600 text-sm mr-1"></i>
                            <span class="text-xs text-gray-600 font-medium">Harga</span>
                        </div>
                                    @if($item->harga)
                            <div class="text-sm font-bold text-green-600 leading-tight">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                                    @else
                            <div class="text-xs text-gray-500 mt-2">
                                Belum ditetapkan
                            </div>
                                    @endif
                                </div>
                </div>
            </div>

            <!-- Action Buttons - Always at bottom -->
            <div class="grid grid-cols-3 gap-2 card-buttons">
                                    <button onclick="openEditModal({{ json_encode($item) }})" 
                        class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
                <button onclick="openDetailModal({{ json_encode($item) }})" 
                        class="bg-gray-600 hover:bg-gray-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                    <i class="fas fa-eye mr-1"></i>Detail
                                    </button>
                <button onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama }}')" 
                        class="bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                    <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
        </div>
        @endforeach
        </div>
        
        <!-- Pagination -->
        @if($alat->hasPages())
    <div class="glass-container rounded-2xl p-6">
        <div class="flex justify-center">
            {{ $alat->links() }}
            </div>
    </div>
    @endif
</div>

<!-- Create/Edit Modal -->
<div id="alatModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl p-8 w-full max-w-2xl relative">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 id="modalTitle" class="text-2xl font-bold text-gray-800"></h3>
                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="alatForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">
                <input type="hidden" id="alatId" name="id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-blue-500"></i>Nama Alat
                        </label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div id="statusField" class="hidden">
                        <label for="isBroken" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>Status
                        </label>
                        <select id="isBroken" name="isBroken" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="0">Berfungsi</option>
                            <option value="1">Rusak</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2 text-blue-500"></i>Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image mr-2 text-blue-500"></i>Gambar Alat (Opsional)
                    </label>
                    <div class="relative">
                        <input type="file" id="gambar" name="gambar" accept="image/*" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: JPG, PNG, GIF. Maksimal 2MB.
                        </div>
                    </div>
                    <!-- Preview gambar -->
                    <div id="imagePreview" class="mt-3 hidden">
                        <div class="relative inline-block">
                            <img id="previewImg" src="" alt="Preview" class="w-32 h-32 object-cover rounded-xl border-2 border-gray-200">
                            <button type="button" onclick="removeImagePreview()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Current image for edit mode -->
                    <div id="currentImage" class="mt-3 hidden">
                        <div class="text-sm text-gray-600 mb-2">Gambar saat ini:</div>
                        <div class="relative inline-block">
                            <img id="currentImg" src="" alt="Current" class="w-32 h-32 object-cover rounded-xl border-2 border-gray-200">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-boxes mr-2 text-blue-500"></i>Stok
                        </label>
                        <input type="number" id="stok" name="stok" min="0" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave mr-2 text-blue-500"></i>Harga (Opsional)
                        </label>
                        <input type="number" id="harga" name="harga" min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="flex gap-4 pt-6">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all shadow-md">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all shadow-md">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeDetailModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl p-8 w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>Detail Alat
                </h3>
                <button type="button" onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700 text-2xl p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Detail Content -->
            <div id="detailContent" class="space-y-6"></div>
        </div>
    </div>
</div>

<script>
// Ensure functions are available globally
window.closeModal = function() {
    const modal = document.getElementById('alatModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset form
    const form = document.getElementById('alatForm');
    form.reset();
    
    // Reset hidden fields
    document.getElementById('methodField').value = 'POST';
    document.getElementById('alatId').value = '';
    document.getElementById('statusField').classList.add('hidden');
    
    // Reset image previews
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('currentImage').classList.add('hidden');
};

window.closeDetailModal = function() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

// Modal Management
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Alat Baru';
    document.getElementById('alatForm').action = '{{ route('admin.laboran.alat.store') }}';
    document.getElementById('methodField').value = 'POST';
    document.getElementById('statusField').classList.add('hidden');
    
    // Reset form
    document.getElementById('alatForm').reset();
    
    // Reset image previews
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('currentImage').classList.add('hidden');
    
    document.getElementById('alatModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function openEditModal(alat) {
    document.getElementById('modalTitle').textContent = 'Edit Alat: ' + alat.nama;
    document.getElementById('alatForm').action = `{{ route('admin.laboran.alat.index') }}/${alat.id}`;
    document.getElementById('methodField').value = 'PUT';
    document.getElementById('statusField').classList.remove('hidden');
    
    // Fill form
    document.getElementById('alatId').value = alat.id;
    document.getElementById('nama').value = alat.nama;
    document.getElementById('deskripsi').value = alat.deskripsi;
    document.getElementById('stok').value = alat.stok;
    document.getElementById('harga').value = alat.harga || '';
    document.getElementById('isBroken').value = alat.isBroken ? '1' : '0';
    
    // Handle current image
    const currentImageDiv = document.getElementById('currentImage');
    const imagePreviewDiv = document.getElementById('imagePreview');
    
    if (alat.gambar) {
        document.getElementById('currentImg').src = `/storage/${alat.gambar}`;
        currentImageDiv.classList.remove('hidden');
    } else {
        currentImageDiv.classList.add('hidden');
    }
    imagePreviewDiv.classList.add('hidden');
    
    document.getElementById('alatModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}



// Image preview functionality
function removeImagePreview() {
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('gambar').value = '';
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('currentImage').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Prevent modal content from closing modal when clicked
document.addEventListener('DOMContentLoaded', function() {
    const modalContent = document.querySelector('#alatModal .glass-modal');
    if (modalContent) {
        modalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    const detailModalContent = document.querySelector('#detailModal .glass-modal');
    if (detailModalContent) {
        detailModalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Add event listener for image input
    const imageInput = document.getElementById('gambar');
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            previewImage(this);
        });
    }
});

function openDetailModal(alat) {
    const statusBadge = alat.isBroken 
        ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800"><i class="fas fa-exclamation-triangle mr-1"></i>Rusak</span>'
        : '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Berfungsi</span>';
    
    const stockAlert = alat.stok <= 5 
        ? '<span class="ml-2 px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Stok Menipis!</span>'
        : '';
    
    const priceDisplay = alat.harga 
        ? `<div class="text-center py-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-xl"><div class="text-2xl font-bold text-green-600">Rp ${new Intl.NumberFormat('id-ID').format(alat.harga)}</div></div>`
        : '<div class="text-center py-4 bg-gray-50 rounded-xl"><span class="text-gray-500 text-sm font-medium">Harga belum ditetapkan</span></div>';
    
    const imageDisplay = alat.gambar 
        ? `<div class="mb-6">
               <div class="relative overflow-hidden rounded-2xl shadow-lg">
                   <img src="/storage/${alat.gambar}" alt="${alat.nama}" class="w-full h-64 object-cover">
                   <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                   <div class="absolute bottom-4 left-4 text-white">
                       <h5 class="text-lg font-bold">${alat.nama}</h5>
                   </div>
               </div>
           </div>`
        : `<div class="mb-6">
               <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300">
                   <div class="text-center">
                       <i class="fas fa-image text-6xl text-gray-400 mb-4"></i>
                       <p class="text-gray-500 text-lg font-medium">Tidak ada gambar</p>
                   </div>
               </div>
           </div>`;

    document.getElementById('detailContent').innerHTML = `
        ${imageDisplay}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-info-circle text-blue-500 mr-3"></i>Informasi Dasar
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Nama Alat:</span> 
                            <span class="font-bold text-gray-900">${alat.nama}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">ID Alat:</span> 
                            <span class="font-mono text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">${alat.id.substring(0, 8)}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-boxes text-green-500 mr-3"></i>Inventaris
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Stok Tersedia:</span> 
                            <div class="flex items-center">
                                <span class="font-bold text-2xl text-green-600">${alat.stok}</span>
                                ${stockAlert}
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Dibuat:</span> 
                            <span class="font-medium text-gray-900">${new Date(alat.created_at).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Terakhir Update:</span> 
                            <span class="font-medium text-gray-900">${new Date(alat.updated_at).toLocaleDateString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-align-left text-purple-500 mr-3"></i>Deskripsi Lengkap
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200">
                        <p class="text-gray-700 leading-relaxed text-justify whitespace-pre-wrap">${alat.deskripsi}</p>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-money-bill-wave text-yellow-500 mr-3"></i>Informasi Harga
                    </h4>
                    ${priceDisplay}
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}



// Enhanced Delete Function
function confirmDelete(alatId, alatNama) {
    Swal.fire({
        title: '🗑️ Konfirmasi Hapus',
        html: `
            <div class="text-center">
                <div class="mb-4">
                    <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus alat:</p>
                <p class="font-bold text-lg text-gray-900 mb-4">${alatNama}</p>
                <p class="text-sm text-red-600">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus Sekarang',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-2xl shadow-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-semibold',
            cancelButton: 'rounded-xl px-6 py-3 font-semibold'
        },
        buttonsStyling: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang memproses penghapusan alat',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Execute delete
            deleteAlat(alatId);
        }
    });
}

function deleteAlat(alatId) {
    // Create form for DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
    form.action = `{{ route('admin.laboran.alat.index') }}/${alatId}`;
    form.style.display = 'none';
        
    // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
    // Add DELETE method
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
    methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
    document.body.appendChild(form);
        
    // Submit form
        form.submit();
}

// Export functionality
function exportData(format) {
    // Show loading
    Swal.fire({
        title: 'Memproses Export...',
        html: `Sedang menyiapkan file ${format.toUpperCase()}`,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Get current search and filter parameters
    const searchParams = new URLSearchParams(window.location.search);
    const baseUrl = '{{ route("admin.laboran.alat.index") }}';
    const exportUrl = `${baseUrl}/export/${format}?${searchParams.toString()}`;
    
    // Create hidden form for export
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = exportUrl;
    form.style.display = 'none';
    document.body.appendChild(form);
    
    // Submit form
    form.submit();
    
    // Remove form
    document.body.removeChild(form);
    
    // Close loading after a short delay
    setTimeout(() => {
        Swal.close();
        Swal.fire({
            title: '✅ Export Berhasil!',
            text: `File ${format.toUpperCase()} sedang diunduh`,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-2xl shadow-2xl'
            }
        });
    }, 1000);
}

// Export dropdown toggle with precise position calculation
document.getElementById('exportDropdown').addEventListener('click', function(e) {
    e.stopPropagation();
    const menu = document.getElementById('exportMenu');
    const button = this;
    
    if (menu.classList.contains('hidden')) {
        // Calculate precise position relative to button
        const buttonRect = button.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        
        // Position dropdown exactly below the button
        let topPosition = buttonRect.bottom + scrollTop + 8;
        let leftPosition = buttonRect.left + scrollLeft;
        
        // Ensure dropdown doesn't go off-screen
        const menuWidth = Math.max(buttonRect.width, 200);
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        
        // Adjust horizontal position if dropdown would go off-screen
        if (leftPosition + menuWidth > viewportWidth) {
            leftPosition = viewportWidth - menuWidth - 10;
        }
        
        // Adjust vertical position if dropdown would go off-screen
        if (topPosition + 120 > viewportHeight + scrollTop) {
            topPosition = buttonRect.top + scrollTop - 120 - 8; // Show above button
        }
        
        menu.style.top = topPosition + 'px';
        menu.style.left = leftPosition + 'px';
        menu.style.minWidth = buttonRect.width + 'px';
        menu.style.maxWidth = '250px';
        
        menu.classList.remove('hidden');
    } else {
        menu.classList.add('hidden');
    }
});

// Close export dropdown when clicking outside
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('exportDropdown');
    const menu = document.getElementById('exportMenu');
    
    if (!dropdown.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});

// Recalculate dropdown position on window resize and scroll
function repositionDropdown() {
    const menu = document.getElementById('exportMenu');
    if (!menu.classList.contains('hidden')) {
        const button = document.getElementById('exportDropdown');
        const buttonRect = button.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        
        menu.style.top = (buttonRect.bottom + scrollTop + 8) + 'px';
        menu.style.left = (buttonRect.left + scrollLeft) + 'px';
        menu.style.minWidth = buttonRect.width + 'px';
        menu.style.maxWidth = '250px';
    }
}

window.addEventListener('resize', repositionDropdown);
window.addEventListener('scroll', repositionDropdown);

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        if (e.target.parentElement.id === 'alatModal') {
            closeModal();
        } else if (e.target.parentElement.id === 'detailModal') {
            closeDetailModal();
        }
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // Check which modal is open and close it
        const mainModal = document.getElementById('alatModal');
        const detailModal = document.getElementById('detailModal');
        
        if (mainModal && !mainModal.classList.contains('hidden')) {
            closeModal();
        }
        
        if (detailModal && !detailModal.classList.contains('hidden')) {
            closeDetailModal();
        }
    }
});

// Success/Error Messages
@if(session('success'))
    Swal.fire({
        title: '✅ Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#059669',
        confirmButtonText: 'OK',
        customClass: {
            popup: 'rounded-2xl shadow-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-semibold'
        }
    });
@endif

@if(session('error'))
    Swal.fire({
        title: '❌ Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'OK',
        customClass: {
            popup: 'rounded-2xl shadow-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-semibold'
        }
    });
@endif
</script>
@endsection