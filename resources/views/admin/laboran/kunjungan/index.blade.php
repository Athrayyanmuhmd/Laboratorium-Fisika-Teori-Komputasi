@extends('layouts.admin')

@section('title', 'Kunjungan Lab')
@section('subtitle', 'Kelola Permintaan Kunjungan Laboratorium')

@section('content')
<style>
    /* Enhanced Glassmorphism Styles */
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
    
    .glass-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #374151;
    }
    
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(16, 185, 129, 0.5);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    /* Card Layout System */
    .card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 400px;
    }
    
    .card-header {
        height: 100px;
        flex-shrink: 0;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9));
    }
    
    .card-body {
        flex: 1;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .card-info-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .card-buttons {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(16, 185, 129, 0.1);
    }
    
    /* Info Row Components */
    .info-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 0.75rem;
        background: rgba(16, 185, 129, 0.02);
        border: 1px solid rgba(16, 185, 129, 0.08);
        transition: all 0.2s ease;
    }
    
    .info-row:hover {
        background: rgba(16, 185, 129, 0.05);
        border-color: rgba(16, 185, 129, 0.15);
        transform: translateX(2px);
    }
    
    .info-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        flex-shrink: 0;
    }
    
    .info-content {
        flex: 1;
        min-width: 0;
    }
    
    .info-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.125rem;
    }
    
    .info-value {
        font-size: 0.875rem;
        color: #374151;
        font-weight: 600;
        word-break: break-word;
    }
    
    /* Status Badges */
    .status-badge-pending {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
        animation: pulse-yellow 2s infinite;
    }
    
    .status-badge-processing {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        animation: pulse-blue 2s infinite;
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
    
    @keyframes pulse-yellow {
        0%, 100% { box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3); }
        50% { box-shadow: 0 4px 16px rgba(251, 191, 36, 0.5); }
    }
    
    @keyframes pulse-blue {
        0%, 100% { box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); }
        50% { box-shadow: 0 4px 16px rgba(59, 130, 246, 0.5); }
    }
    
    /* Grid Layout */
    .kunjungan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 2rem;
        align-items: start;
    }
    
    @media (max-width: 640px) {
        .kunjungan-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .card-content {
            min-height: 380px;
        }
        
        .info-row {
            padding: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
    }
    
    /* Dropdown Positioning */
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
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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
                    Kunjungan Laboratorium
                </h1>
                <p class="text-white/90 text-lg">Kelola permintaan kunjungan dan tour laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $kunjungan->total() ?? 0 }}</div>
                <div class="text-white/80 text-sm">Total Kunjungan</div>
            </div>
        </div>
        
        <div class="header-buttons-container flex flex-wrap gap-4">
            <div class="dropdown-container relative group" style="z-index: 9999 !important;">
                <button id="exportDropdown" class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg flex items-center">
                <i class="fas fa-download mr-2"></i>Export Data
                    <i class="fas fa-chevron-down ml-2 text-sm"></i>
                </button>
                <div id="exportMenu" class="dropdown-menu rounded-xl min-w-48 hidden" style="z-index: 99999 !important;">
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
                <i class="fas fa-chart-bar mr-2"></i>Laporan Kunjungan
            </button>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-calendar mr-2"></i>Jadwal Tour
            </button>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="statistics-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $kunjungan->total() ?? 0 }}</div>
                    <div class="text-gray-600 text-sm">Total Kunjungan</div>
                    </div>
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-emerald-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $kunjungan->where('status', 'PENDING')->count() }}</div>
                    <div class="text-gray-600 text-sm">Menunggu</div>
                </div>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                                </div>
                            </div>
                        </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $kunjungan->where('status', 'PROCESSING')->count() }}</div>
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
                    <div class="text-3xl font-bold text-gray-800">{{ $kunjungan->where('status', 'COMPLETED')->count() }}</div>
                    <div class="text-gray-600 text-sm">Selesai</div>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                                </div>
                            </div>
                        </div>
            
    <!-- Visitor Summary Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-teal-500/10"></div>
        <div class="relative z-10">
                <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user-friends text-xl text-white"></i>
                        </div>
                    <div>
                            <div class="text-sm text-gray-600 font-medium">Total Pengunjung</div>
                            <div class="text-xs text-gray-500">Dari semua kunjungan</div>
                        </div>
                    </div>
                    <div class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        {{ $kunjungan->sum('jumlahPengunjung') }} Orang
                    </div>
                    <div class="text-sm text-gray-600 mt-2">
                        <i class="fas fa-chart-line mr-1 text-emerald-500"></i>
                        Akumulasi seluruh pengunjung laboratorium
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-24 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-building text-3xl text-emerald-600"></i>
                    </div>
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
                           placeholder="Cari nama pengunjung, instansi, atau tujuan..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50 transition-all">
                                            </div>
                                        </div>
                
                <div class="flex gap-3">
                <select name="status" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50 min-w-40">
                                                    <option value="">Semua Status</option>
                                                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                                    <option value="PROCESSING" {{ request('status') == 'PROCESSING' ? 'selected' : '' }}>Processing</option>
                                                    <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                                                    <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                    
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                    <i class="fas fa-filter mr-2"></i>Filter
                                            </button>
                                        </div>
                                    </form>
                            </div>

    <!-- Kunjungan Cards Grid -->
    <div class="kunjungan-grid">
        @forelse($kunjungan as $item)
            <div class="glass-card rounded-2xl overflow-hidden card-content group">
                <!-- Card Header -->
                <div class="card-header relative flex items-center px-6">
                    <div class="flex items-center justify-between w-full z-10">
                        <div class="text-white flex-1 min-w-0">
                            <div class="text-lg font-bold mb-1 truncate" title="{{ $item->namaPengunjung }}">
                                {{ $item->namaPengunjung }}
                            </div>
                            <div class="text-sm opacity-90 flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                {{ $item->tanggalKunjungan ? $item->tanggalKunjungan->format('d M Y') : 'Tanggal belum ditentukan' }}
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0 ml-4">
                            @switch($item->status)
                                @case('PENDING')
                                    <span class="status-badge-pending px-3 py-2 rounded-lg text-xs font-semibold whitespace-nowrap">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @break
                                @case('PROCESSING')
                                    <span class="status-badge-processing px-3 py-2 rounded-lg text-xs font-semibold whitespace-nowrap">
                                            <i class="fas fa-cogs mr-1"></i>Processing
                                        </span>
                                    @break
                                @case('COMPLETED')
                                    <span class="status-badge-completed px-3 py-2 rounded-lg text-xs font-semibold whitespace-nowrap">
                                            <i class="fas fa-check-circle mr-1"></i>Completed
                                        </span>
                                    @break
                                @case('CANCELLED')
                                    <span class="status-badge-cancelled px-3 py-2 rounded-lg text-xs font-semibold whitespace-nowrap">
                                        <i class="fas fa-times-circle mr-1"></i>Cancelled
                                </span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Information Section -->
                    <div class="card-info-section">
                        <!-- Institution Info -->
                        <div class="info-row">
                            <div class="info-icon bg-emerald-100 text-emerald-600">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Instansi Asal</div>
                                <div class="info-value">{{ $item->instansiAsal }}</div>
                            </div>
                        </div>
                        
                        <!-- Visitor Count Info -->
                        <div class="info-row">
                            <div class="info-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Jumlah Pengunjung</div>
                                <div class="info-value">{{ $item->jumlahPengunjung }} pengunjung</div>
                            </div>
                        </div>
                        
                        <!-- Purpose Info -->
                        <div class="info-row">
                            <div class="info-icon bg-purple-100 text-purple-600">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Tujuan Kunjungan</div>
                                <div class="info-value">{{ Str::limit($item->tujuanKunjungan, 60) }}</div>
                            </div>
                        </div>
                        
                        <!-- Created Date Info -->
                        <div class="info-row">
                            <div class="info-icon bg-gray-100 text-gray-600">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Dibuat</div>
                                <div class="info-value">{{ $item->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="card-buttons">
                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="openDetailModal({{ json_encode($item) }})" 
                                    class="action-btn bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-xl font-semibold text-sm">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </button>
                            <div class="relative">
                                <button onclick="toggleStatusDropdown('{{ $item->id }}')" 
                                        class="action-btn bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl font-semibold text-sm w-full">
                                    <i class="fas fa-edit mr-2"></i>Status
                                </button>
                                <div id="statusDropdown-{{ $item->id }}" class="absolute bottom-full mb-2 left-0 right-0 bg-white rounded-lg shadow-lg border hidden z-50">
                                    <div class="py-1">
                                        <button onclick="updateStatus('{{ $item->id }}', 'PENDING')" class="w-full text-left px-3 py-2 hover:bg-gray-50 text-sm">
                                            <i class="fas fa-clock text-yellow-500 mr-2"></i>Pending
                                        </button>
                                        <button onclick="updateStatus('{{ $item->id }}', 'PROCESSING')" class="w-full text-left px-3 py-2 hover:bg-gray-50 text-sm">
                                            <i class="fas fa-cogs text-blue-500 mr-2"></i>Processing
                                            </button>
                                        <button onclick="updateStatus('{{ $item->id }}', 'COMPLETED')" class="w-full text-left px-3 py-2 hover:bg-gray-50 text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>Completed
                                                </button>
                                        <button onclick="updateStatus('{{ $item->id }}', 'CANCELLED')" class="w-full text-left px-3 py-2 hover:bg-gray-50 text-sm">
                                            <i class="fas fa-times-circle text-red-500 mr-2"></i>Cancelled
                                                </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>
                                </div>
                                @empty
            <div class="col-span-full">
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada kunjungan</h3>
                    <p class="text-gray-600">Data kunjungan akan muncul di sini setelah ada yang mendaftar</p>
                </div>
            </div>
                                @endforelse
                    </div>
                    
    <!-- Pagination -->
                    @if($kunjungan->hasPages())
        <div class="glass-container rounded-2xl p-6">
        <div class="flex justify-center">
                            {{ $kunjungan->links() }}
            </div>
                        </div>
    @endif
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-overlay absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-card rounded-3xl p-8 w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-info-circle mr-2 text-emerald-500"></i>Detail Kunjungan
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
// Modal Management
function openDetailModal(kunjungan) {
    const statusBadge = getStatusBadge(kunjungan.status);
    
    document.getElementById('detailContent').innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-user text-emerald-500 mr-3"></i>Informasi Pengunjung
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Nama Pengunjung:</span> 
                            <span class="font-bold text-gray-900">${kunjungan.namaPengunjung}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Instansi Asal:</span> 
                            <span class="font-bold text-gray-900">${kunjungan.instansiAsal}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>
                    </div>
            </div>
            
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-calendar text-blue-500 mr-3"></i>Jadwal Kunjungan
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Kunjungan:</span> 
                            <span class="font-bold text-2xl text-blue-600">${kunjungan.tanggalKunjungan ? new Date(kunjungan.tanggalKunjungan).toLocaleDateString('id-ID') : 'Belum ditentukan'}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Jumlah Pengunjung:</span> 
                            <div class="flex items-center">
                                <span class="font-bold text-2xl text-blue-600">${kunjungan.jumlahPengunjung}</span>
                                <span class="text-gray-600 ml-1">orang</span>
                            </div>
            </div>
            </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-bullseye text-purple-500 mr-3"></i>Tujuan Kunjungan
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200">
                        <p class="text-gray-700 leading-relaxed text-justify whitespace-pre-wrap">${kunjungan.tujuanKunjungan}</p>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-clock text-gray-500 mr-3"></i>Informasi Waktu
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Dibuat:</span> 
                            <span class="font-medium text-gray-900">${new Date(kunjungan.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Terakhir Update:</span> 
                            <span class="font-medium text-gray-900">${new Date(kunjungan.updated_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function getStatusBadge(status) {
    const badges = {
        'PENDING': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Pending</span>',
        'PROCESSING': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800"><i class="fas fa-cogs mr-1"></i>Processing</span>',
        'COMPLETED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Completed</span>',
        'CANCELLED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Cancelled</span>'
    };
    return badges[status] || `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">${status}</span>`;
}

// Status Update Functions
function toggleStatusDropdown(id) {
    // Close all other dropdowns
    document.querySelectorAll('[id^="statusDropdown-"]').forEach(dropdown => {
        if (dropdown.id !== `statusDropdown-${id}`) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Toggle current dropdown
    const dropdown = document.getElementById(`statusDropdown-${id}`);
    dropdown.classList.toggle('hidden');
}

function updateStatus(id, status) {
    console.log('updateStatus called with:', id, status);
    
    Swal.fire({
        title: 'Konfirmasi Perubahan Status',
        text: `Apakah Anda yakin ingin mengubah status menjadi ${status}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Ubah Status',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('User confirmed status update');
            
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang mengubah status kunjungan',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Create form for status update
            const form = document.createElement('form');
            form.method = 'POST';
            const actionUrl = `{{ route('admin.laboran.kunjungan.index') }}/${id}/status`;
            form.action = actionUrl;
            form.style.display = 'none';
            
            console.log('Form action URL:', actionUrl);
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            // Add PATCH method override
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            
            // Add status field
            const statusField = document.createElement('input');
            statusField.type = 'hidden';
            statusField.name = 'status';
            statusField.value = status;
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            form.appendChild(statusField);
            document.body.appendChild(form);
            
            console.log('Form created, submitting...');
            
            // Submit form
            form.submit();
        }
    });
    
    // Hide dropdown
    document.getElementById(`statusDropdown-${id}`).classList.add('hidden');
}

// Export functionality
function exportData(format) {
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

    const searchParams = new URLSearchParams(window.location.search);
    const baseUrl = '{{ route("admin.laboran.kunjungan.index") }}';
    const exportUrl = `${baseUrl}/export/${format}?${searchParams.toString()}`;
    
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = exportUrl;
    form.style.display = 'none';
    document.body.appendChild(form);
    
    form.submit();
    document.body.removeChild(form);
    
    setTimeout(() => {
        Swal.close();
        Swal.fire({
            title: '✅ Export Berhasil!',
            text: `File ${format.toUpperCase()} sedang diunduh`,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    }, 1000);
}

// Export dropdown functionality
document.getElementById('exportDropdown').addEventListener('click', function(e) {
    e.stopPropagation();
    const menu = document.getElementById('exportMenu');
    const button = this;
    
    if (menu.classList.contains('hidden')) {
        const buttonRect = button.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        
        let topPosition = buttonRect.bottom + scrollTop + 8;
        let leftPosition = buttonRect.left + scrollLeft;
        
        const menuWidth = Math.max(buttonRect.width, 200);
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        
        if (leftPosition + menuWidth > viewportWidth) {
            leftPosition = viewportWidth - menuWidth - 10;
        }
        
        if (topPosition + 120 > viewportHeight + scrollTop) {
            topPosition = buttonRect.top + scrollTop - 120 - 8;
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

// Close dropdowns when clicking outside
document.addEventListener('click', function(e) {
    const exportDropdown = document.getElementById('exportDropdown');
    const exportMenu = document.getElementById('exportMenu');
    
    if (!exportDropdown.contains(e.target) && !exportMenu.contains(e.target)) {
        exportMenu.classList.add('hidden');
    }
    
    // Close status dropdowns
    if (!e.target.closest('[id^="statusDropdown-"]') && !e.target.closest('button[onclick*="toggleStatusDropdown"]')) {
        document.querySelectorAll('[id^="statusDropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});

// Close modals on escape key
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
        confirmButtonText: 'OK'
    });
@endif

@if(session('error'))
    Swal.fire({
        title: '❌ Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endsection