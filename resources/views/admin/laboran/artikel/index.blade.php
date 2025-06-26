@extends('layouts.admin')

@section('title', 'Artikel & Berita')
@section('subtitle', 'Kelola Konten Website Laboratorium')

@section('content')
<style>
    /* Glassmorphism Styles */
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
    
    .glass-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: #374151;
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
    
    /* Dropdown Z-Index Fix */
    .dropdown-container {
        position: relative;
        z-index: 9999 !important;
    }
    
    .dropdown-menu {
        position: absolute;
        z-index: 10000 !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    #exportMenu {
        position: fixed !important;
        z-index: 99999 !important;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95) !important;
    }
    
    /* Article Card Enhancements */
    .article-card {
        min-height: 420px;
        display: flex;
        flex-direction: column;
    }
    
    .article-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .category-tag {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 1px solid rgba(16, 185, 129, 0.2);
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
                    Manajemen Artikel & Berita
                </h1>
                <p class="text-white/90 text-lg">Kelola konten website dan informasi laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $artikel->total() ?? 0 }}</div>
                <div class="text-white/80 text-sm">Total Artikel</div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4">
            <button onclick="openCreateModal()" 
                    class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Artikel Baru
            </button>
            <div class="dropdown-container relative group">
                <button id="exportDropdown" class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg flex items-center">
                <i class="fas fa-download mr-2"></i>Export Data
                    <i class="fas fa-chevron-down ml-2 text-sm"></i>
                </button>
                <div id="exportMenu" class="dropdown-menu rounded-xl min-w-48 hidden">
                    <div class="py-1">
                        <button onclick="exportData('csv')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 first:rounded-t-xl">
                            <i class="fas fa-file-csv text-green-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export CSV</div>
                                <div class="text-xs text-gray-500">Data artikel dalam format spreadsheet</div>
                            </div>
                        </button>
                        <div class="border-t border-gray-100 mx-2"></div>
                        <button onclick="exportData('pdf')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 last:rounded-b-xl">
                            <i class="fas fa-file-pdf text-red-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export PDF</div>
                                <div class="text-xs text-gray-500">Laporan artikel dalam format dokumen</div>
                            </div>
            </button>
                    </div>
                </div>
            </div>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-chart-bar mr-2"></i>Analytics
            </button>
        </div>
    </div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $artikel->count() }}</div>
                    <div class="text-gray-600 text-sm">Total Artikel</div>
                    </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $artikel->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                    <div class="text-gray-600 text-sm">Bulan Ini</div>
                    </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-2xl text-green-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $artikel->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                    <div class="text-gray-600 text-sm">Minggu Ini</div>
                    </div>
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-purple-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $artikel->filter(function($item) { return $item->gambar && $item->gambar->isNotEmpty(); })->count() }}</div>
                    <div class="text-gray-600 text-sm">Dengan Gambar</div>
                    </div>
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-image text-2xl text-orange-600"></i>
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
                           placeholder="Cari judul artikel, penulis, atau konten..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                </div>
            </div>
            
            <div class="flex gap-3">
                <select name="status" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 min-w-40">
                    <option value="">Semua Status</option>
                    <option value="with_image" {{ request('status') == 'with_image' ? 'selected' : '' }}>Dengan Gambar</option>
                    <option value="without_image" {{ request('status') == 'without_image' ? 'selected' : '' }}>Tanpa Gambar</option>
                </select>
                
                <select name="sort" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 min-w-40">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                    <option value="namaAcara" {{ request('sort') == 'namaAcara' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="tanggalAcara" {{ request('sort') == 'tanggalAcara' ? 'selected' : '' }}>Tanggal Acara</option>
                </select>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($artikel as $item)
            <div class="glass-card rounded-2xl overflow-hidden article-card hover:scale-105 transition-all duration-300">
                <!-- Article Image -->
                <div class="h-48 bg-gradient-to-r from-blue-400 to-indigo-500 relative overflow-hidden">
                    @if($item->gambar && $item->gambar->isNotEmpty())
                                                            <img src="{{ asset('storage/' . $item->gambar->first()->url) }}" 
                             alt="{{ $item->namaAcara }}" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                             onclick="showDetail({{ json_encode($item) }})"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white bg-gradient-to-br from-gray-400 to-gray-600">
                            <i class="fas fa-newspaper text-6xl opacity-50"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4">
                        <span class="bg-white/20 backdrop-blur text-white px-3 py-1 rounded-full text-xs font-medium">
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                    </div>
                    @if($item->kategori)
                        <div class="absolute top-4 left-4">
                            <span class="category-tag text-green-700 px-2 py-1 rounded-full text-xs font-medium backdrop-blur">
                                {{ $item->kategori }}
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Article Content -->
                <div class="p-6 article-content">
                    <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $item->namaAcara }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            @if(strlen($item->deskripsi) > 120)
                                {{ Str::limit($item->deskripsi, 120) }}
                                <span class="text-blue-600 font-medium cursor-pointer hover:text-blue-800 transition-colors duration-200" 
                                      onclick="showDetail({{ json_encode($item) }})"
                                      title="Klik untuk membaca selengkapnya">
                                    ... baca selengkapnya
                                </span>
                            @else
                                {{ $item->deskripsi }}
                            @endif
                        </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                                <i class="fas fa-user mr-1 text-blue-500"></i>
                            <span>{{ $item->penulis ?? 'Admin' }}</span>
                        </div>
                        <div class="flex items-center">
                                <i class="fas fa-calendar mr-1 text-green-500"></i>
                            <span>{{ \Carbon\Carbon::parse($item->tanggalAcara)->format('d M Y') }}</span>
                            </div>
                        </div>
                        
                        @if($item->status)
                            <div class="mb-4">
                                <span class="status-badge 
                                    @if($item->status === 'published') bg-green-100 text-green-700
                                    @elseif($item->status === 'draft') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-700
                                    @endif
                                    px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-3 gap-2">
                        <button onclick="showDetail({{ json_encode($item) }})" 
                                class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </button>
                        <button onclick="openEditModal({{ json_encode($item) }})" 
                                class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <button onclick="confirmDelete('{{ $item->id }}', '{{ $item->namaAcara }}')" 
                                class="bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl font-semibold hover:scale-105 transition-all shadow-md text-sm">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="glass-card rounded-2xl p-12 text-center">
                    <i class="fas fa-newspaper text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada artikel</h3>
                    <p class="text-gray-500 mb-6">Mulai berbagi informasi dengan membuat artikel pertama</p>
                    <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 transition-all shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Tambah Artikel Pertama
                    </button>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($artikel->hasPages())
        <div class="flex justify-center">
            {{ $artikel->links() }}
        </div>
    @endif
</div>

<!-- Create/Edit Modal -->
<div id="formModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl p-8 w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 id="modalTitle" class="text-2xl font-bold text-gray-800">Tambah Artikel Baru</h3>
                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times"></i>
                    </button>
            </div>

            <!-- Modal Form -->
            <form id="artikelForm" method="POST" action="{{ route('admin.laboran.artikel.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">
                <input type="hidden" id="artikelId" name="id">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div>
                            <label for="namaAcara" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading mr-2 text-blue-500"></i>Judul Artikel
                            </label>
                            <input type="text" id="namaAcara" name="namaAcara" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="Masukkan judul artikel yang menarik">
                        </div>
                        
                        <div>
                            <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-edit mr-2 text-blue-500"></i>Penulis
                            </label>
                            <input type="text" id="penulis" name="penulis"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="Nama penulis artikel">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggalAcara" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-2 text-blue-500"></i>Tanggal Acara
                                </label>
                                <input type="date" id="tanggalAcara" name="tanggalAcara" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                            
                            <div>
                                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>Kategori
                                </label>
                                <input type="text" id="kategori" name="kategori"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       placeholder="Workshop, Seminar, Pelatihan">
                            </div>
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-toggle-on mr-2 text-blue-500"></i>Status Publikasi
                            </label>
                            <select id="status" name="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="published">Published (Dipublikasikan)</option>
                                <option value="draft">Draft (Konsep)</option>
                                <option value="archived">Archived (Diarsipkan)</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Konten Artikel
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="8" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                      placeholder="Tulis konten artikel lengkap di sini..."></textarea>
                        </div>
                        
                        <div>
                            <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-hashtag mr-2 text-blue-500"></i>Tags (Opsional)
                            </label>
                            <input type="text" id="tags" name="tags"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   placeholder="fisika, komputasi, penelitian (pisahkan dengan koma)">
                        </div>
                        
                        <!-- Upload Gambar -->
                        <div>
                            <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-blue-500"></i>Gambar Artikel (Opsional)
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
                            <i class="fas fa-save mr-2"></i>Simpan Artikel
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-card rounded-2xl max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="glass-header rounded-t-2xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold">Detail Artikel</h3>
                    <button onclick="closeDetailModal()" class="text-white hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div id="detailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Ensure functions are available globally
window.closeModal = function() {
    const modal = document.getElementById('formModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset form
    const form = document.getElementById('artikelForm');
    form.reset();
    
    // Reset hidden fields
    document.getElementById('methodField').value = 'POST';
    document.getElementById('artikelId').value = '';
    
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
    document.getElementById('modalTitle').textContent = 'Tambah Artikel Baru';
    document.getElementById('artikelForm').action = '{{ route('admin.laboran.artikel.store') }}';
    document.getElementById('methodField').value = 'POST';
    
    // Reset form
    document.getElementById('artikelForm').reset();
    
    // Reset image previews
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('currentImage').classList.add('hidden');
    
    document.getElementById('formModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function openEditModal(artikel) {
    document.getElementById('modalTitle').textContent = 'Edit Artikel: ' + artikel.namaAcara;
    document.getElementById('artikelForm').action = `{{ route('admin.laboran.artikel.index') }}/${artikel.id}`;
    document.getElementById('methodField').value = 'PUT';
    
    // Fill form
    document.getElementById('artikelId').value = artikel.id;
    document.getElementById('namaAcara').value = artikel.namaAcara;
    document.getElementById('deskripsi').value = artikel.deskripsi;
    document.getElementById('penulis').value = artikel.penulis || '';
    document.getElementById('tanggalAcara').value = artikel.tanggalAcara;
    document.getElementById('kategori').value = artikel.kategori || '';
    document.getElementById('tags').value = artikel.tags || '';
    document.getElementById('status').value = artikel.status || 'published';
    
    // Handle current image
    const currentImageDiv = document.getElementById('currentImage');
    const imagePreviewDiv = document.getElementById('imagePreview');
    
    if (artikel.gambar && artikel.gambar.length > 0) {
        document.getElementById('currentImg').src = `/storage/${artikel.gambar[0].url}`;
        currentImageDiv.classList.remove('hidden');
    } else {
        currentImageDiv.classList.add('hidden');
    }
    imagePreviewDiv.classList.add('hidden');
    
    document.getElementById('formModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function showDetail(artikel) {
    const statusBadge = artikel.status 
        ? `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
             ${artikel.status === 'published' ? 'bg-green-100 text-green-800' : 
               artikel.status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 
               'bg-gray-100 text-gray-800'}">
             ${artikel.status.charAt(0).toUpperCase() + artikel.status.slice(1)}
           </span>`
        : '';
    
    const categoryBadge = artikel.kategori 
        ? `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
             <i class="fas fa-tag mr-1"></i>${artikel.kategori}
           </span>`
        : '';
    
    const imageDisplay = artikel.gambar && artikel.gambar.length > 0
        ? `<div class="mb-6">
               <div class="relative overflow-hidden rounded-2xl shadow-lg">
                   <img src="/storage/${artikel.gambar[0].url}" alt="${artikel.namaAcara}" class="w-full h-64 object-cover">
                   <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                   <div class="absolute bottom-4 left-4 text-white">
                       <h5 class="text-lg font-bold">${artikel.namaAcara}</h5>
                   </div>
               </div>
           </div>`
        : `<div class="mb-6">
               <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300">
                   <div class="text-center">
                       <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
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
                        <i class="fas fa-info-circle text-blue-500 mr-3"></i>Informasi Artikel
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Judul:</span> 
                            <span class="font-bold text-gray-900 text-right flex-1 ml-2">${artikel.namaAcara}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Penulis:</span> 
                            <span class="text-gray-900 font-medium">${artikel.penulis || 'Admin'}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Acara:</span> 
                            <span class="text-gray-900 font-medium">${new Date(artikel.tanggalAcara).toLocaleDateString('id-ID')}</span>
                        </div>
                        ${artikel.kategori ? `
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Kategori:</span> 
                            ${categoryBadge}
                        </div>` : ''}
                        ${artikel.status ? `
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>` : ''}
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-clock text-green-500 mr-3"></i>Timeline
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Dibuat:</span> 
                            <span class="text-gray-900 font-medium">${new Date(artikel.created_at).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Terakhir Update:</span> 
                            <span class="text-gray-900 font-medium">${new Date(artikel.updated_at).toLocaleDateString('id-ID')}</span>
                    </div>
                        ${artikel.tags ? `
                        <div class="mt-4">
                            <span class="text-gray-600 font-medium mb-2 block">Tags:</span>
                            <div class="flex flex-wrap gap-1">
                                ${artikel.tags.split(',').map(tag => 
                                    `<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">#${tag.trim()}</span>`
                                ).join('')}
                    </div>
                        </div>` : ''}
                    </div>
                    </div>
                </div>
                
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-align-left text-purple-500 mr-3"></i>Konten Artikel
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200 max-h-96 overflow-y-auto">
                        <p class="text-gray-700 leading-relaxed text-justify whitespace-pre-wrap">${artikel.deskripsi}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Enhanced Delete Function
function confirmDelete(artikelId, artikelNama) {
    Swal.fire({
        title: '🗑️ Konfirmasi Hapus',
        html: `
            <div class="text-center">
                <div class="mb-4">
                    <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus artikel:</p>
                <p class="font-bold text-lg text-gray-900 mb-4">${artikelNama}</p>
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
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang memproses penghapusan artikel',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Execute delete
            deleteArtikel(artikelId);
        }
    });
}

function deleteArtikel(artikelId) {
    // Create form for DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
    form.action = `{{ route('admin.laboran.artikel.index') }}/${artikelId}`;
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
            Swal.fire({
                title: 'File Terlalu Besar!',
                text: 'Ukuran file maksimal 2MB',
                icon: 'error',
                confirmButtonText: 'OK'
            });
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
    const baseUrl = '{{ route("admin.laboran.artikel.index") }}';
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

// Prevent modal content from closing modal when clicked
document.addEventListener('DOMContentLoaded', function() {
    const modalContent = document.querySelector('#formModal .glass-modal');
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

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        if (e.target.parentElement.id === 'formModal') {
            closeModal();
        } else if (e.target.parentElement.id === 'detailModal') {
            closeDetailModal();
        }
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // Check which modal is open and close it
        const mainModal = document.getElementById('formModal');
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