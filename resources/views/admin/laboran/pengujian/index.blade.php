@extends('layouts.admin')

@section('title', 'Layanan Pengujian')
@section('subtitle', 'Kelola Permintaan Pengujian Laboratorium')

@section('content')
<style>
    /* Glassmorphism Styles - Consistent with Peminjaman Page */
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
    
    .card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 480px;
    }
    
    .card-header {
        flex-shrink: 0;
    }
    
    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.5rem;
        gap: 1rem;
    }
    
    .card-info-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .card-actions {
        flex-shrink: 0;
        margin-top: auto;
    }
    
    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(6, 182, 212, 0.1);
    }
    
    .info-row:hover {
        background: rgba(6, 182, 212, 0.05);
        border-color: rgba(6, 182, 212, 0.2);
        transform: translateX(4px);
    }
    
    .info-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.75rem;
    }
    
    .info-content {
        flex: 1;
        min-width: 0;
    }
    
    .info-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .info-value {
        font-size: 0.875rem;
        color: #374151;
        font-weight: 600;
        word-wrap: break-word;
        line-height: 1.4;
    }
    
    .price-section {
        background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
        border: 1px solid #bbf7d0;
        border-radius: 1rem;
        padding: 1rem;
        text-align: center;
    }
    
    .price-amount {
        font-size: 1.25rem;
        font-weight: 700;
        color: #059669;
        margin-bottom: 0.25rem;
    }
    
    .price-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .card-header-bg {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
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
    
    /* Enhanced card hover effects */
    .glass-card {
        position: relative;
        overflow: hidden;
    }
    
    .glass-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(6, 182, 212, 0.02), rgba(59, 130, 246, 0.02));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    
    .glass-card:hover::after {
        opacity: 1;
    }
    
    /* Info icon enhancements */
    .info-icon {
        transition: all 0.3s ease;
    }
    
    .info-row:hover .info-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .glass-header {
        background: linear-gradient(135deg, 
            rgba(6, 182, 212, 0.8) 0%, 
            rgba(8, 145, 178, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
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
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .action-btn:active {
        transform: translateY(0);
    }
    
    /* Enhanced card grid for better responsiveness */
    .pengujian-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 2rem;
        align-items: start;
    }
    
    @media (max-width: 640px) {
        .pengujian-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .card-content {
            min-height: 420px;
        }
        
        .info-row {
            padding: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .info-label {
            font-size: 0.6875rem;
        }
        
        .info-value {
            font-size: 0.8125rem;
        }
    }
    
    /* Status indicator animations */
    .status-badge-pending {
        animation: pulse-yellow 2s infinite;
    }
    
    .status-badge-processing {
        animation: pulse-blue 2s infinite;
    }
    
    @keyframes pulse-yellow {
        0%, 100% { box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3); }
        50% { box-shadow: 0 4px 16px rgba(251, 191, 36, 0.5); }
    }
    
    @keyframes pulse-blue {
        0%, 100% { box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); }
        50% { box-shadow: 0 4px 16px rgba(59, 130, 246, 0.5); }
    }
    
    /* Enhanced price section */
    .price-section {
        position: relative;
        overflow: hidden;
    }
    
    .price-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transform: rotate(45deg);
        transition: transform 0.5s ease;
    }
    
    .glass-card:hover .price-section::before {
        transform: rotate(45deg) translate(50%, 50%);
    }
    
    .info-item {
        transition: all 0.2s ease;
        padding: 0.5rem;
        border-radius: 0.5rem;
        margin: -0.5rem;
    }
    
    .info-item:hover {
        background: rgba(6, 182, 212, 0.05);
        transform: translateX(4px);
    }
    
    .glass-input {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(6, 182, 212, 0.2);
        color: #374151;
    }
    
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(6, 182, 212, 0.5);
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }
    
    .modal-overlay {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
    }
    
    .glass-modal {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(6, 182, 212, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Export Dropdown Positioning */
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
                    Layanan Pengujian
                </h1>
                <p class="text-white/90 text-lg">Kelola permintaan pengujian dan analisis sampel</p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-white">{{ $pengujian->total() ?? 0 }}</div>
                <div class="text-white/80 text-sm">Total Pengujian</div>
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
                <i class="fas fa-chart-bar mr-2"></i>Laporan Pengujian
            </button>
            <button class="bg-white/20 hover:bg-white/30 border border-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 backdrop-blur-lg">
                <i class="fas fa-calendar mr-2"></i>Jadwal Pengujian
            </button>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="statistics-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-card rounded-2xl p-6 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $pengujian->total() ?? 0 }}</div>
                    <div class="text-gray-600 text-sm">Total Pengujian</div>
                    </div>
                <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-microscope text-2xl text-cyan-600"></i>
                </div>
                </div>
            </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $pengujian->where('status', 'PENDING')->count() }}</div>
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
                    <div class="text-3xl font-bold text-gray-800">{{ $pengujian->where('status', 'PROCESSING')->count() }}</div>
                    <div class="text-gray-600 text-sm">Processing</div>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-cogs text-2xl text-blue-600"></i>
                                </div>
                            </div>
                        </div>
            
        <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $pengujian->where('status', 'COMPLETED')->count() }}</div>
                    <div class="text-gray-600 text-sm">Completed</div>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                                </div>
                            </div>
                        </div>
            
    <!-- Revenue Card - Separate Row for Better Proportion -->
    <div class="statistics-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="glass-card rounded-2xl p-8 lg:col-span-2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-money-bill-wave text-xl text-white"></i>
                            </div>
                    <div>
                                <div class="text-sm text-gray-600 font-medium">Total Revenue</div>
                                <div class="text-xs text-gray-500">Dari semua pengujian</div>
                            </div>
                        </div>
                        <div class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Rp {{ number_format($pengujian->sum('totalHarga'), 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-600 mt-2">
                            <i class="fas fa-chart-line mr-1 text-green-500"></i>
                            Total pendapatan pengujian
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-coins text-3xl text-purple-600"></i>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>

        <div class="glass-card rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-gray-800">{{ $pengujian->where('status', 'CANCELLED')->count() }}</div>
                    <div class="text-gray-600 text-sm">Cancelled</div>
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
                                                       placeholder="Cari nama penguji atau nomor HP..." 
                           class="glass-input w-full pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-cyan-500/50 transition-all">
                                            </div>
                                        </div>
                
                <div class="flex gap-3">
                <select name="status" class="glass-input px-4 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-cyan-500/50 min-w-40">
                                                    <option value="">Semua Status</option>
                                                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                                    <option value="PROCESSING" {{ request('status') == 'PROCESSING' ? 'selected' : '' }}>Processing</option>
                                                    <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                                                    <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                    
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-4 rounded-2xl font-semibold hover:scale-105 transition-all shadow-lg">
                    <i class="fas fa-filter mr-2"></i>Filter
                                            </button>
                                        </div>
                                    </form>
                            </div>

    <!-- Pengujian Cards Grid -->
    <div class="pengujian-grid">
        @forelse($pengujian as $item)
            <div class="glass-card rounded-2xl overflow-hidden card-content group">
                <!-- Card Header -->
                <div class="h-28 card-header-bg relative flex items-center px-6 card-header">
                    <div class="flex items-center justify-between w-full z-10">
                        <div class="text-white flex-1 min-w-0">
                            <div class="text-lg font-bold mb-1 truncate" title="{{ $item->namaPenguji }}">
                                {{ $item->namaPenguji }}
                            </div>
                            <div class="text-sm opacity-90 flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                {{ $item->created_at->format('d M Y') }}
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
                        <!-- Contact Info -->
                        <div class="info-row">
                            <div class="info-icon bg-cyan-100 text-cyan-600">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Nomor Telepon</div>
                                <div class="info-value">{{ $item->noHpPenguji }}</div>
                            </div>
                        </div>
                        
                        <!-- Schedule Info -->
                        <div class="info-row">
                            <div class="info-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Jadwal Pengujian</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($item->tanggalPengujian)->format('d M Y') }}
                                    <span class="text-xs text-gray-500 font-normal">
                                ({{ \Carbon\Carbon::parse($item->tanggalPengujian)->diffForHumans() }})
                            </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Items Info -->
                        <div class="info-row">
                            <div class="info-icon bg-purple-100 text-purple-600">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Item Pengujian</div>
                                <div class="info-value">
                                    @if($item->item_count > 0)
                                        <span class="text-cyan-600 font-bold">{{ $item->item_count }} item</span>
                                        @if($item->jenis_names)
                                            <div class="text-xs text-gray-500 mt-1 font-normal">
                                                {{ Str::limit($item->jenis_names, 50) }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-gray-500 italic font-normal">Tidak ada item pengujian</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Price Section -->
                        <div class="price-section">
                            <div class="price-label">Total Biaya</div>
                            <div class="price-amount">Rp {{ number_format($item->totalHarga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="card-actions">
                        <div class="grid grid-cols-3 gap-3">
                            <button onclick="viewDetail({{ json_encode($item) }})" 
                                    class="action-btn bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 text-white py-3 px-3 rounded-xl font-semibold shadow-lg text-sm transition-all duration-200">
                                <i class="fas fa-eye mr-1"></i>
                                <span class="hidden sm:inline">Detail</span>
                                            </button>
                                            
                            @if($item->status === 'PENDING')
                                <button onclick="updateStatus('{{ $item->id }}', 'PROCESSING')" 
                                        class="action-btn bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 px-3 rounded-xl font-semibold shadow-lg text-sm transition-all duration-200">
                                    <i class="fas fa-check mr-1"></i>
                                    <span class="hidden sm:inline">Approve</span>
                                                </button>
                                <button onclick="updateStatus('{{ $item->id }}', 'CANCELLED')" 
                                        class="action-btn bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-3 px-3 rounded-xl font-semibold shadow-lg text-sm transition-all duration-200">
                                                    <i class="fas fa-times"></i>
                                                </button>
                            @elseif($item->status === 'PROCESSING')
                                <button onclick="updateStatus('{{ $item->id }}', 'COMPLETED')" 
                                        class="action-btn bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-3 px-3 rounded-xl font-semibold shadow-lg text-sm col-span-2 transition-all duration-200">
                                    <i class="fas fa-check-double mr-1"></i>
                                    <span class="hidden sm:inline">Complete</span>
                                                </button>
                            @else
                                <div class="col-span-2 flex items-center justify-center text-gray-400 text-sm bg-gray-50 rounded-xl py-3 border border-gray-200">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <span class="italic text-xs">Tidak ada aksi tersedia</span>
                                </div>
                                            @endif
                        </div>
                                        </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="glass-card rounded-2xl p-12 text-center">
                    <i class="fas fa-microscope text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengujian</h3>
                    <p class="text-gray-500 mb-6">Permintaan pengujian akan muncul di sini</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($pengujian->hasPages())
        <div class="glass-container rounded-2xl p-6">
        <div class="flex justify-center">
            {{ $pengujian->links() }}
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
                    <i class="fas fa-microscope mr-2 text-cyan-500"></i>Detail Pengujian
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

function viewDetail(pengujian) {
    const statusBadge = getStatusBadge(pengujian.status);
    const itemCount = pengujian.item_count || 0;
    const jenisNames = pengujian.jenis_names || '';
    
    let itemList = '<li class="text-gray-500 italic">Tidak ada item pengujian</li>';
    if (itemCount > 0 && jenisNames) {
        const jenisArray = jenisNames.split(', ');
        itemList = jenisArray.map(nama => 
            `<li class="flex items-center py-2 border-b border-gray-100 last:border-0">
                <i class="fas fa-flask text-cyan-500 mr-2"></i>
                <span>${nama}</span>
            </li>`
        ).join('');
    }
    
    document.getElementById('detailContent').innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-user text-cyan-500 mr-3"></i>Informasi Penguji
                    </h4>
                <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Nama Penguji:</span> 
                            <span class="font-bold text-gray-900">${pengujian.namaPenguji}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">No HP:</span> 
                            <span class="font-medium text-gray-900">${pengujian.noHpPenguji}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Status:</span> 
                            ${statusBadge}
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-calendar text-green-500 mr-3"></i>Jadwal & Waktu
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Tanggal Pengujian:</span> 
                            <span class="font-medium text-gray-900">${new Date(pengujian.tanggalPengujian).toLocaleDateString('id-ID')}</span>
                                </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Dibuat:</span> 
                            <span class="font-medium text-gray-900">${new Date(pengujian.created_at).toLocaleDateString('id-ID')}</span>
                    </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-medium">Update Terakhir:</span> 
                            <span class="font-medium text-gray-900">${new Date(pengujian.updated_at).toLocaleDateString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-flask text-purple-500 mr-3"></i>Item Pengujian
                    </h4>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-purple-200">
                        <ul class="space-y-2">
                            ${itemList}
                        </ul>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-money-bill-wave text-yellow-500 mr-3"></i>Informasi Biaya
                    </h4>
                    <div class="text-center py-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-xl">
                        <div class="text-2xl font-bold text-green-600">Rp ${new Intl.NumberFormat('id-ID').format(pengujian.totalHarga)}</div>
                        <div class="text-sm text-gray-600 mt-1">Total Biaya Pengujian</div>
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
        'PROCESSING': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800"><i class="fas fa-cogs mr-1"></i>Processing</span>',
        'COMPLETED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Completed</span>',
        'CANCELLED': '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Cancelled</span>'
    };
    return badges[status] || `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">${status}</span>`;
}

function updateStatus(pengujianId, newStatus) {
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
                <p class="text-gray-600 mb-4">Apakah Anda yakin ingin <strong>${statusText[newStatus]}</strong> pengujian ini?</p>
                <div class="bg-cyan-50 border-l-4 border-cyan-400 p-4 rounded">
                    <p class="text-sm text-cyan-700">
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
                html: 'Sedang mengubah status pengujian',
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
            form.action = `/admin/pengujian/${pengujianId}/status`;
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
    const baseUrl = '{{ route("admin.laboran.pengujian.index") }}';
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

// Export dropdown toggle
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

// Close export dropdown when clicking outside
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('exportDropdown');
    const menu = document.getElementById('exportMenu');
    
    if (!dropdown.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        if (e.target.parentElement.id === 'detailModal') {
            closeDetailModal();
        }
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