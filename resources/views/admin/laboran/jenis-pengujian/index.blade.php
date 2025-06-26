@extends('layouts.admin')

@section('title', 'Jenis Pengujian')
@section('subtitle', 'Kelola Layanan dan Tarif Pengujian Laboratorium')

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
    
    /* Service Card Enhancements */
    .service-card {
        min-height: 420px;
        display: flex;
        flex-direction: column;
    }
    
    .service-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .service-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .price-display {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 1px solid rgba(16, 185, 129, 0.2);
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
                    Manajemen Jenis Pengujian
                </h1>
                <p class="text-white/90 text-lg">Kelola layanan dan tarif pengujian laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $jenisPengujian->count() }}</div>
                <div class="text-white/80 text-sm">Jenis Layanan</div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4">
            <button onclick="openCreateModal()" 
                    class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Layanan Baru
            </button>
            <div class="dropdown-container relative group">
                <button id="exportDropdown" class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg flex items-center">
                <i class="fas fa-download mr-2"></i>Export Tarif
                    <i class="fas fa-chevron-down ml-2 text-sm"></i>
                </button>
                <div id="exportMenu" class="dropdown-menu rounded-xl min-w-48 hidden">
                    <div class="py-1">
                        <button onclick="exportData('csv')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 first:rounded-t-xl">
                            <i class="fas fa-file-csv text-green-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export CSV</div>
                                <div class="text-xs text-gray-500">Data tarif dalam format spreadsheet</div>
                            </div>
                        </button>
                        <div class="border-t border-gray-100 mx-2"></div>
                        <button onclick="exportData('pdf')" class="w-full text-left px-4 py-3 hover:bg-gray-50 hover:bg-opacity-80 flex items-center text-gray-700 font-medium transition-all duration-200 last:rounded-b-xl">
                            <i class="fas fa-file-pdf text-red-600 mr-3 text-sm"></i>
                            <div class="flex-1">
                                <div class="font-semibold text-sm">Export PDF</div>
                                <div class="text-xs text-gray-500">Laporan tarif dalam format dokumen</div>
                            </div>
            </button>
                    </div>
                </div>
            </div>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-chart-bar mr-2"></i>Statistik Layanan
            </button>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6 min-h-[120px]">
            <div class="flex items-center justify-between h-full">
                <div class="flex-1 pr-4">
                    <div class="text-3xl font-bold text-gray-800 mb-1">{{ $jenisPengujian->count() }}</div>
                    <div class="text-gray-600 text-sm font-medium leading-tight">Total Layanan</div>
                    </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-microscope text-2xl text-blue-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6 min-h-[120px]">
            <div class="flex items-center justify-between h-full">
                <div class="flex-1 pr-4">
                    <div class="text-3xl font-bold text-gray-800 mb-1">{{ $jenisPengujian->where('isAvailable', true)->count() }}</div>
                    <div class="text-gray-600 text-sm font-medium leading-tight">Tersedia</div>
                    </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6 min-h-[120px]">
            <div class="flex items-center justify-between h-full">
                <div class="flex-1 pr-4">
                    <div class="text-2xl font-bold text-gray-800 mb-1 leading-tight">
                        Rp {{ number_format($jenisPengujian->avg('hargaPerSampel') ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="text-gray-600 text-sm font-medium leading-tight">Rata-rata Tarif</div>
                </div>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-dollar-sign text-2xl text-yellow-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6 min-h-[120px]">
            <div class="flex items-center justify-between h-full">
                <div class="flex-1 pr-4">
                    <div class="text-2xl font-bold text-gray-800 mb-1 leading-tight">
                        Rp {{ number_format($jenisPengujian->max('hargaPerSampel') ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="text-gray-600 text-sm font-medium leading-tight">Tarif Tertinggi</div>
                </div>
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-arrow-up text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="glass-container rounded-2xl p-6">
        <form method="GET" class="space-y-4">
            <!-- Search Input -->
            <div class="w-full">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama layanan pengujian..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-sm">
                </div>
            </div>
            
            <!-- Filter Controls -->
            <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                <div class="flex flex-col sm:flex-row gap-3 flex-1">
                    <select name="status" class="glass-input px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 text-sm flex-1 min-w-0">
                        <option value="">Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    
                    <select name="sort" class="glass-input px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 text-sm flex-1 min-w-0">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        <option value="namaPengujian" {{ request('sort') == 'namaPengujian' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="hargaPerSampel" {{ request('sort') == 'hargaPerSampel' ? 'selected' : '' }}>Harga Terendah</option>
                    </select>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg text-sm whitespace-nowrap">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jenisPengujian as $item)
            <div class="glass-card rounded-2xl overflow-hidden service-card hover:scale-105 transition-all duration-300">
                <!-- Service Header -->
                <div class="service-header h-32 relative flex items-center justify-center">
                    <div class="text-center text-white z-10">
                        <i class="fas fa-flask text-4xl mb-2 opacity-80"></i>
                        <div class="text-lg font-bold">{{ Str::limit($item->namaPengujian, 25) }}</div>
                    </div>
                    <div class="absolute top-4 right-4 z-10">
                        @if($item->isAvailable)
                            <span class="status-badge bg-green-500/20 backdrop-blur text-green-100 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check mr-1"></i>Tersedia
                            </span>
                        @else
                            <span class="status-badge bg-red-500/20 backdrop-blur text-red-100 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-times mr-1"></i>Tidak Tersedia
                            </span>
                        @endif
                    </div>
                    <!-- Decorative pattern -->
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full -translate-x-16 -translate-y-16"></div>
                        <div class="absolute bottom-0 right-0 w-24 h-24 bg-white rounded-full translate-x-12 translate-y-12"></div>
                    </div>
                </div>
                
                <!-- Service Content -->
                <div class="service-content p-6">
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->namaPengujian }}</h3>
                        
                        @if($item->deskripsi)
                            <p class="text-gray-600 text-sm leading-relaxed mb-3">
                                {{ Str::limit($item->deskripsi, 100) }}
                            </p>
                        @endif
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($item->kategori)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-lg text-xs font-medium">
                                    <i class="fas fa-tag mr-1"></i>{{ $item->kategori }}
                                </span>
                            @endif
                            @if($item->estimasiWaktu)
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-lg text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i>{{ $item->estimasiWaktu }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Price Display -->
                    <div class="price-display rounded-xl p-4 mb-4 text-center">
                        <div class="text-2xl font-bold text-green-600 mb-1">
                                Rp {{ number_format($item->hargaPerSampel, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-gray-600">per sampel</div>
                        </div>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                        <span><i class="fas fa-calendar mr-1"></i>{{ $item->created_at->format('d M Y') }}</span>
                        <span><i class="fas fa-clock mr-1"></i>{{ $item->updated_at->diffForHumans() }}</span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-3 gap-2">
                        <button onclick="showDetail({{ json_encode($item) }})" 
                                class="bg-blue-50 text-blue-700 px-3 py-3 rounded-xl hover:bg-blue-100 transition-colors text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </button>
                        <button onclick="openEditModal({{ json_encode($item) }})" 
                                class="bg-green-50 text-green-700 px-3 py-3 rounded-xl hover:bg-green-100 transition-colors text-sm font-medium">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <button onclick="toggleAvailability('{{ $item->id }}', {{ $item->isAvailable ? 'false' : 'true' }})" 
                                class="bg-{{ $item->isAvailable ? 'orange' : 'blue' }}-50 text-{{ $item->isAvailable ? 'orange' : 'blue' }}-700 px-3 py-3 rounded-xl hover:bg-{{ $item->isAvailable ? 'orange' : 'blue' }}-100 transition-colors text-sm font-medium">
                            <i class="fas fa-{{ $item->isAvailable ? 'pause' : 'play' }} mr-1"></i>{{ $item->isAvailable ? 'Nonaktif' : 'Aktif' }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="glass-card rounded-2xl p-12 text-center">
                    <i class="fas fa-microscope text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada layanan pengujian</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan layanan pengujian pertama</p>
                    <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Tambah Layanan Pertama
                    </button>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($jenisPengujian->hasPages())
        <div class="glass-container rounded-2xl p-6">
        <div class="flex justify-center">
            {{ $jenisPengujian->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Create/Edit Modal -->
<div id="formModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeFormModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl max-w-3xl w-full relative">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6 p-6 pb-0">
                <div>
                    <h3 id="modalTitle" class="text-2xl font-bold text-gray-800">Tambah Jenis Pengujian</h3>
                    <p class="text-gray-600 text-sm">Isi informasi layanan pengujian laboratorium</p>
                </div>
                <button type="button" onclick="closeFormModal()" class="text-gray-500 hover:text-gray-700 text-2xl p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="serviceForm" method="POST" action="{{ route('admin.laboran.jenis-pengujian.store') }}">
                @csrf
                <div class="p-6 pt-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="namaPengujian" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-flask mr-2 text-blue-500"></i>Nama Pengujian *
                            </label>
                            <input type="text" id="namaPengujian" name="namaPengujian" required 
                                   placeholder="Contoh: Analisis Spektroskopi UV-Vis"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        
                        <div>
                            <label for="hargaPerSampel" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Harga per Sampel (Rp) *
                            </label>
                            <input type="number" id="hargaPerSampel" name="hargaPerSampel" required min="0" 
                                   placeholder="150000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        
                        <div>
                            <label for="estimasiWaktu" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-yellow-500"></i>Estimasi Waktu
                            </label>
                            <input type="text" id="estimasiWaktu" name="estimasiWaktu" 
                                   placeholder="2-3 hari kerja"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        
                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag mr-2 text-purple-500"></i>Kategori
                            </label>
                            <select id="kategori" name="kategori" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="">Pilih Kategori</option>
                                <option value="Spektroskopi">Spektroskopi</option>
                                <option value="Karakterisasi Material">Karakterisasi Material</option>
                                <option value="Analisis Termal">Analisis Termal</option>
                                <option value="Simulasi Komputasi">Simulasi Komputasi</option>
                                <option value="Pengujian Listrik">Pengujian Listrik</option>
                                <option value="Analisis Data">Analisis Data</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-indigo-500"></i>Deskripsi Layanan
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" 
                                      placeholder="Deskripsi detail tentang layanan pengujian ini..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" id="isAvailable" name="isAvailable" value="1" checked 
                                       class="mr-3 w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-semibold text-gray-700">
                                    <i class="fas fa-check-circle mr-2 text-green-500"></i>Layanan tersedia untuk digunakan
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 pt-6 mt-6 border-t border-gray-200">
                        <button type="button" onclick="closeFormModal()" 
                                class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all shadow-md">
                            <i class="fas fa-times mr-2"></i>Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all shadow-md">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeDetailModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl max-w-4xl w-full relative max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6 p-6 pb-0">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>Detail Jenis Pengujian
                    </h3>
                    <p class="text-gray-600 text-sm">Informasi lengkap layanan pengujian laboratorium</p>
                </div>
                <button type="button" onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700 text-2xl p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-6 pt-0">
                <div id="detailContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
                
                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <button onclick="closeDetailModal()" class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all shadow-md">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Ensure functions are available globally
window.closeFormModal = function() {
    const modal = document.getElementById('formModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset form
    const form = document.getElementById('serviceForm');
    form.reset();
    
    // Remove method input if exists
    const methodInput = document.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }
};

window.closeDetailModal = function() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

// Modal Management
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Jenis Pengujian';
    document.getElementById('serviceForm').action = '{{ route("admin.laboran.jenis-pengujian.store") }}';
    document.getElementById('serviceForm').reset();
    
    // Set checkbox to checked by default
    document.getElementById('isAvailable').checked = true;
    
    document.getElementById('formModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function openEditModal(service) {
    document.getElementById('modalTitle').textContent = 'Edit Jenis Pengujian: ' + service.namaPengujian;
    document.getElementById('serviceForm').action = `{{ route('admin.laboran.jenis-pengujian.index') }}/${service.id}`;
    
    // Add method spoofing for PUT request
    let methodInput = document.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('serviceForm').appendChild(methodInput);
    }
    
    // Fill form
    document.getElementById('namaPengujian').value = service.namaPengujian;
    document.getElementById('hargaPerSampel').value = service.hargaPerSampel;
    document.getElementById('deskripsi').value = service.deskripsi || '';
    document.getElementById('estimasiWaktu').value = service.estimasiWaktu || '';
    document.getElementById('kategori').value = service.kategori || '';
    document.getElementById('isAvailable').checked = service.isAvailable;
    
    document.getElementById('formModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function showDetail(service) {
    const statusBadge = service.isAvailable 
        ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800"><i class="fas fa-check mr-1"></i>Tersedia</span>'
        : '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800"><i class="fas fa-times mr-1"></i>Tidak Tersedia</span>';
    
    const content = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-info-circle text-blue-500 mr-3"></i>Informasi Dasar
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-start">
                            <span class="text-gray-600 font-medium">Nama Pengujian:</span> 
                            <span class="font-bold text-gray-900 text-right">${service.namaPengujian}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Kategori:</span> 
                            <span class="font-medium text-gray-900">${service.kategori || '-'}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Estimasi Waktu:</span> 
                            <span class="font-medium text-gray-900">${service.estimasiWaktu || '-'}</span>
                        </div>
                    </div>
            </div>
            
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-calendar text-green-500 mr-3"></i>Informasi Waktu
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Dibuat:</span> 
                            <span class="font-medium text-gray-900">${new Date(service.created_at).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Terakhir Update:</span> 
                            <span class="font-medium text-gray-900">${new Date(service.updated_at).toLocaleDateString('id-ID')}</span>
                        </div>
            </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-money-bill-wave text-yellow-500 mr-3"></i>Informasi Tarif
                    </h4>
                    <div class="text-center py-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-xl">
                        <div class="text-3xl font-bold text-green-600 mb-1">Rp ${new Intl.NumberFormat('id-ID').format(service.hargaPerSampel)}</div>
                        <div class="text-sm text-gray-600">per sampel</div>
                    </div>
                </div>
                
                ${service.deskripsi ? `
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-align-left text-purple-500 mr-3"></i>Deskripsi Layanan
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200">
                        <p class="text-gray-700 leading-relaxed text-justify whitespace-pre-wrap">${service.deskripsi}</p>
                    </div>
                </div>
                ` : ''}
            </div>
        </div>
    `;
    
    document.getElementById('detailContent').innerHTML = content;
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function toggleAvailability(id, isAvailable) {
    const action = isAvailable === 'true' ? 'mengaktifkan' : 'menonaktifkan';
    
    Swal.fire({
        title: 'Konfirmasi Perubahan Status',
        text: `Apakah Anda yakin ingin ${action} layanan ini?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Ubah Status',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang mengubah status layanan',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
            form.action = `{{ route('admin.laboran.jenis-pengujian.index') }}/${id}/toggle`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PATCH';
        
        const availableInput = document.createElement('input');
        availableInput.type = 'hidden';
        availableInput.name = 'isAvailable';
        availableInput.value = isAvailable;
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        form.appendChild(availableInput);
        
        document.body.appendChild(form);
        form.submit();
    }
    });
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
    const baseUrl = '{{ route("admin.laboran.jenis-pengujian.index") }}';
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
    const formModalContent = document.querySelector('#formModal .glass-modal');
    if (formModalContent) {
        formModalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    const detailModalContent = document.querySelector('#detailModal .glass-modal');
    if (detailModalContent) {
        detailModalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});

// Close modals when clicking outside or pressing Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // Check which modal is open and close it
        const formModal = document.getElementById('formModal');
        const detailModal = document.getElementById('detailModal');
        
        if (formModal && !formModal.classList.contains('hidden')) {
            closeFormModal();
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