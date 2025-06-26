@extends('layouts.admin')

@section('title', 'Dashboard Laboran')
@section('subtitle', 'Pusat Kendali Laboratorium Fisika Teori dan Komputasi')

@section('content')
<style>
    .glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(59, 130, 246, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(59, 130, 246, 0.12);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }
    
    .glass-header {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.95));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .glass-stat {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.1);
        transition: all 0.3s ease;
    }
    
    .glass-stat:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
    }
    
    .corporate-bg {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: -1;
    }
    
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        z-index: -1;
    }
    
    .element {
        position: absolute;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.03);
        animation: subtle-float 8s ease-in-out infinite;
    }
    
    .element:nth-child(1) {
        width: 200px;
        height: 200px;
        top: -100px;
        right: -100px;
        animation-delay: -2s;
    }
    
    .element:nth-child(2) {
        width: 150px;
        height: 150px;
        bottom: -75px;
        left: -75px;
        animation-delay: -4s;
    }
    
    @keyframes subtle-float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(3deg); }
    }
    
    .icon-wrapper {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.05));
        backdrop-filter: blur(5px);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }
    
    .btn-corporate {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }
    
    .btn-corporate:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .text-overflow-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .container-fit {
        max-width: 100%;
        overflow: hidden;
    }
</style>

<div class="corporate-bg"></div>
<div class="floating-elements">
    <div class="element"></div>
    <div class="element"></div>
</div>

<div class="space-y-6 relative z-10 p-4">
    <!-- Corporate Header -->
    <div class="glass-header rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 text-overflow-ellipsis">
                        Dashboard Laboran
                    </h1>
                    <p class="text-blue-100 text-base md:text-lg mb-3">Laboratorium Fisika Teori dan Komputasi - 28 PC Workstations</p>
                    <div class="flex items-center text-sm text-blue-200">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-overflow-ellipsis">{{ now()->format('l, d F Y') }}</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock mr-1"></i>
                        <span id="current-time"></span>
                    </div>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <div class="glass rounded-xl p-3 text-center">
                        <div class="text-3xl opacity-60 mb-1">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="text-xs text-blue-200">Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Corporate Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Total Alat -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-tools text-blue-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-green-50 text-green-600 rounded-full border border-green-200">
                    Stabil
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['alat']['total'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Total Alat</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Inventaris lab</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <!-- Peminjaman Pending -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-clock text-amber-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-amber-50 text-amber-600 rounded-full border border-amber-200">
                    Pending
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['peminjaman']['pending'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Peminjaman</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Menunggu persetujuan</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500 rounded-full" style="width: 60%"></div>
            </div>
        </div>
        
        <!-- Pengujian Pending -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-microscope text-indigo-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-indigo-50 text-indigo-600 rounded-full border border-indigo-200">
                    Queue
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['pengujian']['pending'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Pengujian</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Dalam antrian</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full" style="width: 45%"></div>
            </div>
        </div>
        
        <!-- Kunjungan Pending -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-users text-emerald-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-emerald-50 text-emerald-600 rounded-full border border-emerald-200">
                    Ready
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['kunjungan']['pending'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Kunjungan</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Siap dijadwalkan</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full" style="width: 80%"></div>
            </div>
        </div>
        
        <!-- Alat Rusak -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded-full border border-red-200">
                    Alert
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['alat']['rusak'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Alat Rusak</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Perlu maintenance</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full" style="width: 25%"></div>
            </div>
        </div>
        
        <!-- Maintenance Terjadwal -->
        <div class="glass-stat rounded-xl p-4 group cursor-pointer container-fit">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fas fa-tools text-orange-600 text-sm"></i>
                </div>
                <div class="text-xs px-2 py-1 bg-orange-50 text-orange-600 rounded-full border border-orange-200">
                    Scheduled
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['maintenance']['dijadwalkan'] ?? 0 }}</div>
            <div class="text-sm font-medium text-gray-700 text-overflow-ellipsis">Maintenance</div>
            <div class="text-xs text-gray-500 text-overflow-ellipsis">Terjadwal</div>
            <div class="mt-3 h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-orange-500 to-orange-600 rounded-full" style="width: 65%"></div>
            </div>
        </div>
    </div>
    
    <!-- Alert Cards for Critical Items -->
    @if(($stats['alat']['perlu_kalibrasi'] ?? 0) > 0 || ($stats['alat']['kalibrasi_segera'] ?? 0) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        @if(($stats['alat']['perlu_kalibrasi'] ?? 0) > 0)
        <div class="glass-card rounded-2xl p-6 border-l-4 border-red-500">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-red-800 mb-2">Kalibrasi Expired</h3>
                    <p class="text-red-700 mb-2">{{ $stats['alat']['perlu_kalibrasi'] }} alat memerlukan kalibrasi segera</p>
                    <a href="{{ route('admin.laboran.maintenance.index') }}?jenis=KALIBRASI" 
                       class="inline-flex items-center text-sm text-red-600 hover:text-red-800 font-medium">
                        <i class="fas fa-arrow-right mr-1"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endif
        
        @if(($stats['alat']['kalibrasi_segera'] ?? 0) > 0)
        <div class="glass-card rounded-2xl p-6 border-l-4 border-yellow-500">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-2">Kalibrasi Segera</h3>
                    <p class="text-yellow-700 mb-2">{{ $stats['alat']['kalibrasi_segera'] }} alat perlu kalibrasi dalam 30 hari</p>
                    <a href="{{ route('admin.laboran.maintenance.index') }}" 
                       class="inline-flex items-center text-sm text-yellow-600 hover:text-yellow-800 font-medium">
                        <i class="fas fa-arrow-right mr-1"></i>
                        Jadwalkan Sekarang
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
    
    <!-- Corporate Management Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Manajemen Alat -->
        <div class="glass-card rounded-xl p-6 group hover:scale-[1.02] transition-all duration-300 container-fit">
            <div class="flex items-center justify-between mb-4">
                <div class="icon-wrapper w-12 h-12 rounded-xl flex items-center justify-center group-hover:rotate-3 transition-transform duration-300">
                    <i class="fas fa-tools text-blue-600 text-lg"></i>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-gray-900">{{ $stats['alat']['total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Items</div>
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 text-overflow-ellipsis">Manajemen Alat</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Kelola inventaris peralatan laboratorium</p>
            <a href="{{ route('admin.laboran.alat.index') }}" class="btn-corporate w-full py-2.5 px-4 rounded-lg text-white font-medium text-center block text-sm">
                <i class="fas fa-arrow-right mr-2"></i>
                Kelola Alat
            </a>
        </div>
        
        <!-- Peminjaman Alat -->
        <div class="glass-card rounded-xl p-6 group hover:scale-[1.02] transition-all duration-300 container-fit">
            <div class="flex items-center justify-between mb-4">
                <div class="icon-wrapper w-12 h-12 rounded-xl flex items-center justify-center group-hover:rotate-3 transition-transform duration-300">
                    <i class="fas fa-handshake text-indigo-600 text-lg"></i>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-gray-900">{{ $stats['peminjaman']['total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Requests</div>
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 text-overflow-ellipsis">Peminjaman Alat</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Monitor dan kelola permintaan peminjaman</p>
            <a href="{{ route('admin.laboran.peminjaman.index') }}" class="btn-corporate w-full py-2.5 px-4 rounded-lg text-white font-medium text-center block text-sm">
                <i class="fas fa-arrow-right mr-2"></i>
                Kelola Peminjaman
            </a>
        </div>
        
        <!-- Layanan Pengujian -->
        <div class="glass-card rounded-xl p-6 group hover:scale-[1.02] transition-all duration-300 container-fit">
            <div class="flex items-center justify-between mb-4">
                <div class="icon-wrapper w-12 h-12 rounded-xl flex items-center justify-center group-hover:rotate-3 transition-transform duration-300">
                    <i class="fas fa-microscope text-emerald-600 text-lg"></i>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-gray-900">{{ $stats['pengujian']['total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Tests</div>
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 text-overflow-ellipsis">Layanan Pengujian</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Kelola permintaan pengujian sampel</p>
            <a href="{{ route('admin.laboran.pengujian.index') }}" class="btn-corporate w-full py-2.5 px-4 rounded-lg text-white font-medium text-center block text-sm">
                <i class="fas fa-arrow-right mr-2"></i>
                Kelola Pengujian
            </a>
        </div>
        
        <!-- Kunjungan Lab -->
        <div class="glass-card rounded-xl p-6 group hover:scale-[1.02] transition-all duration-300 container-fit">
            <div class="flex items-center justify-between mb-4">
                <div class="icon-wrapper w-12 h-12 rounded-xl flex items-center justify-center group-hover:rotate-3 transition-transform duration-300">
                    <i class="fas fa-users text-amber-600 text-lg"></i>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-gray-900">{{ $stats['kunjungan']['total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Visits</div>
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 text-overflow-ellipsis">Kunjungan Lab</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Monitor kunjungan dan tour laboratorium</p>
            <a href="{{ route('admin.laboran.kunjungan.index') }}" class="btn-corporate w-full py-2.5 px-4 rounded-lg text-white font-medium text-center block text-sm">
                <i class="fas fa-arrow-right mr-2"></i>
                Kelola Kunjungan
            </a>
        </div>
    </div>
    
    <!-- Corporate Activity Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Peminjaman -->
        <div class="glass-card rounded-xl overflow-hidden">
            <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-handshake text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Peminjaman Terbaru</h3>
                            <p class="text-sm text-gray-600">Aktivitas peminjaman terkini</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.laboran.peminjaman.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium px-3 py-1 rounded-lg hover:bg-blue-50 transition-colors">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($recentPeminjaman ?? [] as $peminjaman)
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0 flex-1">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3 flex-shrink-0">
                                        {{ substr($peminjaman->namaPeminjam, 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="font-semibold text-gray-900 text-overflow-ellipsis">{{ $peminjaman->namaPeminjam }}</div>
                                        <div class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            <span class="text-overflow-ellipsis">{{ $peminjaman->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full ml-2 flex-shrink-0
                                    @if($peminjaman->status == 'PENDING') bg-amber-100 text-amber-700 border border-amber-200
                                    @elseif($peminjaman->status == 'PROCESSING') bg-blue-100 text-blue-700 border border-blue-200
                                    @elseif($peminjaman->status == 'COMPLETED') bg-green-100 text-green-700 border border-green-200
                                    @else bg-gray-100 text-gray-700 border border-gray-200
                                    @endif
                                ">
                                    {{ $peminjaman->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="icon-wrapper w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-handshake text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-gray-500 font-medium">Belum ada peminjaman</div>
                            <div class="text-sm text-gray-400 mt-1">Data akan muncul di sini</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Recent Pengujian -->
        <div class="glass-card rounded-xl overflow-hidden">
            <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-microscope text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Pengujian Terbaru</h3>
                            <p class="text-sm text-gray-600">Aktivitas pengujian terkini</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.laboran.pengujian.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium px-3 py-1 rounded-lg hover:bg-indigo-50 transition-colors">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($recentPengujian ?? [] as $pengujian)
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0 flex-1">
                                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3 flex-shrink-0">
                                        {{ substr($pengujian->namaPenguji, 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="font-semibold text-gray-900 text-overflow-ellipsis">{{ $pengujian->namaPenguji }}</div>
                                        <div class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                            <span class="text-overflow-ellipsis">Rp {{ number_format($pengujian->totalHarga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full ml-2 flex-shrink-0
                                    @if($pengujian->status == 'PENDING') bg-amber-100 text-amber-700 border border-amber-200
                                    @elseif($pengujian->status == 'PROCESSING') bg-blue-100 text-blue-700 border border-blue-200
                                    @elseif($pengujian->status == 'COMPLETED') bg-green-100 text-green-700 border border-green-200
                                    @else bg-gray-100 text-gray-700 border border-gray-200
                                    @endif
                                ">
                                    {{ $pengujian->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="icon-wrapper w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-microscope text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-gray-500 font-medium">Belum ada pengujian</div>
                            <div class="text-sm text-gray-400 mt-1">Data akan muncul di sini</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Corporate Quick Actions -->
    <div class="glass-card rounded-xl overflow-hidden">
        <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
            <div class="flex items-center">
                <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-bolt text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                    <p class="text-sm text-gray-600">Akses langsung ke fungsi manajemen</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Jenis Pengujian -->
                <a href="{{ route('admin.laboran.jenis-pengujian.index') }}" class="bg-gray-50 rounded-lg p-4 group hover:bg-gray-100 transition-all duration-300 hover:scale-[1.02] block">
                    <div class="flex items-center">
                        <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3 group-hover:rotate-3 transition-transform">
                            <i class="fas fa-flask text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-bold text-gray-900 group-hover:text-blue-700 transition-colors text-overflow-ellipsis">Jenis Pengujian</div>
                            <div class="text-sm text-gray-600">Kelola layanan testing</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                    </div>
                </a>
                
                <!-- Artikel & Berita -->
                <a href="{{ route('admin.laboran.artikel.index') }}" class="bg-gray-50 rounded-lg p-4 group hover:bg-gray-100 transition-all duration-300 hover:scale-[1.02] block">
                    <div class="flex items-center">
                        <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3 group-hover:rotate-3 transition-transform">
                            <i class="fas fa-newspaper text-emerald-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition-colors text-overflow-ellipsis">Artikel & Berita</div>
                            <div class="text-sm text-gray-600">Management konten</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-emerald-600 transition-colors"></i>
                    </div>
                </a>
                
                <!-- Data Pengurus -->
                <a href="{{ route('admin.laboran.pengurus.index') }}" class="bg-gray-50 rounded-lg p-4 group hover:bg-gray-100 transition-all duration-300 hover:scale-[1.02] block">
                    <div class="flex items-center">
                        <div class="icon-wrapper w-10 h-10 rounded-lg flex items-center justify-center mr-3 group-hover:rotate-3 transition-transform">
                            <i class="fas fa-user-tie text-indigo-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-bold text-gray-900 group-hover:text-indigo-700 transition-colors text-overflow-ellipsis">Data Pengurus</div>
                            <div class="text-sm text-gray-600">Kelola staff profile</div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-indigo-600 transition-colors"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Corporate JavaScript -->
<script>
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('current-time').textContent = timeString;
}

// Update time immediately and then every second
updateTime();
setInterval(updateTime, 1000);

// Clean entrance animations
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.glass-stat, .glass-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Add responsive text handling
window.addEventListener('resize', function() {
    // Force reflow for text overflow calculations
    const elements = document.querySelectorAll('.text-overflow-ellipsis');
    elements.forEach(el => {
        el.style.display = 'none';
        el.offsetHeight; // trigger reflow
        el.style.display = '';
    });
});
</script>
@endsection 