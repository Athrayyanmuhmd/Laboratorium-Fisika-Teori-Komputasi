@extends('layouts.admin')

@section('title', 'Manajemen Peminjaman')
@section('subtitle', 'Kelola Permintaan Peminjaman Alat Laboratorium')

@section('content')
<style>
    /* Modern Glassmorphism Styles */
    .glass-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.1);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(16, 185, 129, 0.15);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(16, 185, 129, 0.15);
        border-color: rgba(16, 185, 129, 0.25);
    }
    
    .glass-header {
        background: linear-gradient(135deg, 
            rgba(16, 185, 129, 0.8) 0%, 
            rgba(5, 150, 105, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .glass-modal {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(16, 185, 129, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .glass-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #374151;
    }
    
    .glass-input::placeholder {
        color: rgba(107, 114, 128, 0.7);
    }
    
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(16, 185, 129, 0.5);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    .status-badge {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .modal-overlay {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
    }
    
    /* Ensure equal height cards */
    .card-grid {
        display: grid;
        grid-template-rows: 1fr;
    }
    
    .card-content {
        display: grid;
        grid-template-rows: auto auto 1fr auto;
        height: 100%;
        min-height: 420px;
        gap: 0.75rem;
    }
    
    .card-header-bg {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        position: relative;
        overflow: hidden;
    }
    
    .card-header-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .glass-card:hover .card-header-bg::before {
        left: 100%;
    }
    
    .status-badge-pending {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
    }
    
    .status-badge-processing {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .status-badge-completed {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    
    .status-badge-cancelled {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }
    
    .action-btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s;
    }
    
    .action-btn:hover::before {
        width: 120%;
        height: 120%;
    }
    
    .info-item {
        transition: all 0.2s ease;
        padding: 0.5rem;
        border-radius: 0.5rem;
        margin: -0.5rem;
    }
    
    .info-item:hover {
        background: rgba(16, 185, 129, 0.05);
        transform: translateX(4px);
    }
    
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #10b981;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .pulse-effect {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
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
    
    .header-buttons-container {
        position: relative;
        z-index: 9999;
    }
    
    #exportMenu {
        position: fixed !important;
        z-index: 99999 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
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
        background: rgba(16, 185, 129, 0.3);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(16, 185, 129, 0.5);
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
                    Manajemen Peminjaman
                </h1>
                <p class="text-white/90 text-lg">Kelola Permintaan Peminjaman Alat Laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $peminjaman->total() ?? 0 }}</div>
                <div class="text-white/80 text-sm">Total Peminjaman</div>
            </div>
        </div>
        
        <div class="header-buttons-container flex flex-wrap gap-4">
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
                <i class="fas fa-chart-bar mr-2"></i>Laporan Peminjaman
            </button>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-calendar mr-2"></i>Jadwal Peminjaman
            </button>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $peminjaman->where('status', 'PENDING')->count() }}</div>
                    <div class="text-gray-600 text-sm">Pending</div>
                    </div>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $peminjaman->where('status', 'PROCESSING')->count() }}</div>
                    <div class="text-gray-600 text-sm">Diproses</div>
                    </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-cogs text-2xl text-blue-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $peminjaman->where('status', 'COMPLETED')->count() }}</div>
                    <div class="text-gray-600 text-sm">Selesai</div>
                    </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $peminjaman->where('status', 'CANCELLED')->count() }}</div>
                    <div class="text-gray-600 text-sm">Dibatalkan</div>
                    </div>
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle text-2xl text-red-600"></i>
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
                           placeholder="Cari nama peminjam, nomor HP, atau tujuan..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50 transition-all">
                </div>
                </div>
                
            <div class="flex flex-wrap gap-3">
                <select name="status" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50 min-w-40">
                        <option value="">Semua Status</option>
                        <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                        <option value="PROCESSING" {{ request('status') == 'PROCESSING' ? 'selected' : '' }}>Diproses</option>
                        <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Selesai</option>
                        <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50"
                       title="Tanggal mulai">
                
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50"
                       title="Tanggal akhir">
                
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                    <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    
                <a href="{{ route('admin.laboran.peminjaman.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
    </div>

    <!-- Peminjaman Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 card-grid">
        @forelse($peminjaman as $item)
            <div class="glass-card rounded-2xl overflow-hidden card-content group">
                <!-- Card Header -->
                <div class="h-24 card-header-bg relative flex items-center px-6">
                    <div class="flex items-center justify-between w-full z-10">
                        <div class="text-white">
                            <div class="text-lg font-bold mb-1">{{ $item->namaPeminjam }}</div>
                            <div class="text-sm opacity-90 flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="text-right">
                            @switch($item->status)
                                @case('PENDING')
                                    <span class="status-badge-pending px-3 py-2 rounded-lg text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                    @break
                                @case('PROCESSING')
                                    <span class="status-badge-processing px-3 py-2 rounded-lg text-xs font-semibold">
                                        <i class="fas fa-cogs mr-1"></i>Diproses
                                    </span>
                                    @break
                                @case('COMPLETED')
                                    <span class="status-badge-completed px-3 py-2 rounded-lg text-xs font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i>Selesai
                                    </span>
                                    @break
                                @case('CANCELLED')
                                    <span class="status-badge-cancelled px-3 py-2 rounded-lg text-xs font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i>Dibatalkan
                                    </span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
                
                <!-- Card Content -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div class="space-y-4 mb-6">
                        <div class="info-item flex items-center text-sm text-gray-700">
                            <i class="fas fa-phone mr-3 text-emerald-600 w-4 text-center"></i>
                            <span class="font-medium">{{ $item->noHp }}</span>
                        </div>
                        
                        <div class="info-item flex items-center text-sm text-gray-700">
                            <i class="fas fa-calendar-range mr-3 text-blue-600 w-4 text-center"></i>
                            <span>{{ $item->tanggal_pinjam->format('d M Y') }} - {{ $item->tanggal_pengembalian->format('d M Y') }}</span>
                        </div>
                        
                        <div class="info-item flex items-center text-sm text-gray-700">
                            <i class="fas fa-tools mr-3 text-purple-600 w-4 text-center"></i>
                            <span class="font-medium">
                                @if($item->alat_count > 0)
                                    <span class="text-emerald-600">{{ $item->alat_count }} item alat</span>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada alat</span>
                                @endif
                            </span>
                        </div>
                        
                        @if($item->tujuanPeminjaman)
                            <div class="info-item">
                                <div class="flex items-start text-sm text-gray-700">
                                    <i class="fas fa-bullseye mr-3 text-orange-600 w-4 text-center mt-0.5"></i>
                                    <span class="leading-relaxed text-justify">{{ Str::limit($item->tujuanPeminjaman, 80) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-3 gap-3 mt-auto">
                        <button onclick="viewDetail({{ json_encode($item) }})" 
                                class="action-btn bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white py-3 px-4 rounded-xl font-semibold shadow-lg text-sm">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </button>
                        
                        @if($item->status === 'PENDING')
                            <button onclick="updateStatus('{{ $item->id }}', 'PROCESSING')" 
                                    class="action-btn bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 px-4 rounded-xl font-semibold shadow-lg text-sm">
                                <i class="fas fa-check mr-1"></i>Approve
                            </button>
                            <button onclick="updateStatus('{{ $item->id }}', 'CANCELLED')" 
                                    class="action-btn bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-3 px-4 rounded-xl font-semibold shadow-lg text-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        @elseif($item->status === 'PROCESSING')
                            <button onclick="updateStatus('{{ $item->id }}', 'COMPLETED')" 
                                    class="action-btn bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-3 px-4 rounded-xl font-semibold shadow-lg text-sm col-span-2">
                                <i class="fas fa-check-double mr-1"></i>Complete
                            </button>
                        @else
                            <div class="col-span-2 flex items-center justify-center text-gray-400 text-sm bg-gray-50 rounded-xl py-3">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span class="italic">Tidak ada aksi tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="glass-card rounded-2xl p-12 text-center">
                    <i class="fas fa-handshake text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada peminjaman</h3>
                    <p class="text-gray-500 mb-6">Permintaan peminjaman akan muncul di sini</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($peminjaman->hasPages())
        <div class="glass-container rounded-2xl p-6">
        <div class="flex justify-center">
            {{ $peminjaman->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0" onclick="closeDetailModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-modal rounded-3xl p-8 w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-info-circle mr-2 text-emerald-500"></i>Detail Peminjaman
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
// Global functions
window.closeDetailModal = function() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

function updateStatus(peminjamanId, newStatus) {
    const statusText = {
        'PROCESSING': 'memproses',
        'COMPLETED': 'menyelesaikan',
        'CANCELLED': 'membatalkan'
    };
    
    const statusColors = {
        'PROCESSING': '#3b82f6',
        'COMPLETED': '#10b981',
        'CANCELLED': '#ef4444'
    };
    
    Swal.fire({
        title: '🔄 Konfirmasi Perubahan Status',
        html: `
            <div class="text-left">
                <p class="text-gray-600 mb-4">Apakah Anda yakin ingin <strong>${statusText[newStatus]}</strong> peminjaman ini?</p>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Status akan berubah dan notifikasi akan dikirim ke sistem.
                    </p>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: statusColors[newStatus],
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Ya, Ubah Status',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
        customClass: {
            popup: 'rounded-2xl shadow-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-semibold',
            cancelButton: 'rounded-xl px-6 py-3 font-semibold'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                html: 'Sedang mengubah status peminjaman',
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
        form.action = `/admin/peminjaman/${peminjamanId}/status`;
            form.style.display = 'none';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PATCH';
        
        const statusField = document.createElement('input');
        statusField.type = 'hidden';
        statusField.name = 'status';
        statusField.value = newStatus;
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        form.appendChild(statusField);
        
        document.body.appendChild(form);
        form.submit();
    }
    });
}

function viewDetail(peminjaman) {
    const statusBadge = getStatusBadge(peminjaman.status);
    const alatCount = peminjaman.alat_count || 0;
    const alatNames = peminjaman.alat_names || '';
    
    let alatList = '<li class="text-gray-500 italic">Tidak ada alat yang dipinjam</li>';
    if (alatCount > 0 && alatNames) {
        const alatArray = alatNames.split(', ');
        alatList = alatArray.map(nama => 
            `<li class="flex items-center py-2 border-b border-gray-100 last:border-0">
                <i class="fas fa-tools text-emerald-500 mr-2"></i>
                <span>${nama}</span>
            </li>`
        ).join('');
    }
    
    document.getElementById('detailContent').innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-user text-emerald-500 mr-3"></i>Informasi Peminjam
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Nama:</span> 
                            <span class="font-bold text-gray-900">${peminjaman.namaPeminjam}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">No HP:</span> 
                            <span class="font-mono text-sm bg-gray-100 text-gray-800 px-2 py-1 rounded">${peminjaman.noHp}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>Jadwal Peminjaman
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Pinjam:</span> 
                            <span class="font-bold text-blue-600">${new Date(peminjaman.tanggal_pinjam).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Kembali:</span> 
                            <span class="font-bold text-blue-600">${new Date(peminjaman.tanggal_pengembalian).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Dibuat:</span> 
                            <span class="font-medium text-gray-900">${new Date(peminjaman.created_at).toLocaleDateString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-bullseye text-purple-500 mr-3"></i>Tujuan Peminjaman
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200">
                        <p class="text-gray-700 leading-relaxed text-justify">${peminjaman.tujuanPeminjaman}</p>
            </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-tools text-green-500 mr-3"></i>Alat yang Dipinjam
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-green-200">
                        <ul class="space-y-1">
                            ${alatList}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function getStatusBadge(status) {
    const badges = {
        'PENDING': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Pending</span>',
        'PROCESSING': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800"><i class="fas fa-cogs mr-1"></i>Diproses</span>',
        'COMPLETED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Selesai</span>',
        'CANCELLED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Dibatalkan</span>'
    };
    return badges[status] || '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Unknown</span>';
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
    const baseUrl = '{{ route("admin.laboran.peminjaman.index") }}';
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

// Export dropdown functionality
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

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('exportDropdown');
    const menu = document.getElementById('exportMenu');
    
    if (!dropdown.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});

// Close modals when clicking outside or pressing escape
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        closeDetailModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const detailModal = document.getElementById('detailModal');
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
        confirmButtonColor: '#10b981',
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