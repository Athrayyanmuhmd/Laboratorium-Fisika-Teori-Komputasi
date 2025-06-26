@extends('layouts.admin')

@section('title', 'Detail Kunjungan')
@section('subtitle', 'Informasi Lengkap Kunjungan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Kunjungan</h1>
            <p class="text-gray-600">ID: {{ $kunjungan->id }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.laboran.kunjungan.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="flex items-center space-x-4">
        <span class="px-3 py-1 rounded-full text-sm font-medium
            @if($kunjungan->status === 'PENDING') bg-yellow-100 text-yellow-800
            @elseif($kunjungan->status === 'PROCESSING') bg-blue-100 text-blue-800
            @elseif($kunjungan->status === 'COMPLETED') bg-green-100 text-green-800
            @else bg-red-100 text-red-800
            @endif">
            {{ $kunjungan->status }}
        </span>
        <span class="text-sm text-gray-500">
            Dibuat: {{ $kunjungan->created_at->format('d M Y H:i') }}
        </span>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Visitor Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pengunjung -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-users mr-2 text-blue-600"></i>Informasi Pengunjung
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengunjung</label>
                        <p class="text-gray-900">{{ $kunjungan->namaPengunjung }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <p class="text-gray-900">{{ $kunjungan->noHpPengunjung }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $kunjungan->emailPengunjung ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                        <p class="text-gray-900">{{ $kunjungan->instansiPengunjung ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pengunjung</label>
                        <p class="text-gray-900">{{ $kunjungan->jumlahPengunjung ?? 1 }} orang</p>
                    </div>
                    @if($kunjungan->jenis_kunjungan)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kunjungan</label>
                        <p class="text-gray-900">{{ $kunjungan->jenis_kunjungan }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Detail Kunjungan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-calendar mr-2 text-blue-600"></i>Detail Kunjungan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan</label>
                        <p class="text-gray-900">
                            {{ $kunjungan->tanggal_kunjungan ? \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d M Y') : 'Belum ditentukan' }}
                        </p>
                    </div>
                    @if($kunjungan->waktu_mulai && $kunjungan->waktu_selesai)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Kunjungan</label>
                        <p class="text-gray-900">
                            {{ \Carbon\Carbon::parse($kunjungan->waktu_mulai)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($kunjungan->waktu_selesai)->format('H:i') }} WIB
                        </p>
                    </div>
                    @endif
                    @if($kunjungan->petugas_pemandu)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Petugas Pemandu</label>
                        <p class="text-gray-900">{{ $kunjungan->petugas_pemandu }}</p>
                    </div>
                    @endif
                </div>
                
                @if($kunjungan->tujuanKunjungan)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Kunjungan</label>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $kunjungan->tujuanKunjungan }}</p>
                </div>
                @endif

                @if($kunjungan->catatan_kunjungan)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kunjungan</label>
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                        <p class="text-gray-900">{{ $kunjungan->catatan_kunjungan }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Fasilitas yang Dikunjungi -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-building mr-2 text-blue-600"></i>Fasilitas Laboratorium
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">28 PC Workstations</h4>
                        <p class="text-sm text-gray-600">Komputer untuk komputasi dan simulasi fisika</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Software Komputasi</h4>
                        <p class="text-sm text-gray-600">MATLAB, Python, Software Geofisika</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Fotografi Digital</h4>
                        <p class="text-sm text-gray-600">Peralatan dan software editing foto</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Web Development</h4>
                        <p class="text-sm text-gray-600">Tools untuk pengembangan web</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions & Status -->
        <div class="space-y-6">
            <!-- Status Update -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-cog mr-2 text-blue-600"></i>Update Status
                </h3>
                <form action="{{ route('admin.laboran.kunjungan.update-status', $kunjungan) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="PENDING" {{ $kunjungan->status === 'PENDING' ? 'selected' : '' }}>Pending</option>
                                <option value="PROCESSING" {{ $kunjungan->status === 'PROCESSING' ? 'selected' : '' }}>Processing</option>
                                <option value="COMPLETED" {{ $kunjungan->status === 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                                <option value="CANCELLED" {{ $kunjungan->status === 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-bolt mr-2 text-blue-600"></i>Quick Actions
                </h3>
                <div class="space-y-3">
                    <button onclick="window.print()" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-print mr-2"></i>Print Detail
                    </button>
                    <button onclick="generateVisitReport()" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-file-alt mr-2"></i>Laporan Kunjungan
                    </button>
                    <form action="{{ route('admin.laboran.kunjungan.destroy', $kunjungan) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus data kunjungan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>Hapus Data
                        </button>
                    </form>
                </div>
            </div>

            <!-- Visit Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-chart-bar mr-2 text-blue-600"></i>Informasi Kunjungan
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Jumlah Pengunjung</span>
                        <span class="text-sm font-medium">{{ $kunjungan->jumlahPengunjung ?? 1 }} orang</span>
                    </div>
                    @if($kunjungan->tanggal_kunjungan)
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Waktu Tersisa</span>
                        <span class="text-sm font-medium">
                            @php
                                $visitDate = \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan);
                                $now = \Carbon\Carbon::now();
                                $diff = $visitDate->diffInDays($now, false);
                            @endphp
                            @if($diff > 0)
                                {{ $diff }} hari yang lalu
                            @elseif($diff < 0)
                                {{ abs($diff) }} hari lagi
                            @else
                                Hari ini
                            @endif
                        </span>
                    </div>
                    @endif
                    @if($kunjungan->waktu_mulai && $kunjungan->waktu_selesai)
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Durasi</span>
                        <span class="text-sm font-medium">
                            @php
                                $start = \Carbon\Carbon::parse($kunjungan->waktu_mulai);
                                $end = \Carbon\Carbon::parse($kunjungan->waktu_selesai);
                                $duration = $start->diffInMinutes($end);
                            @endphp
                            {{ $duration }} menit
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Info -->
            @if($kunjungan->noHpPengunjung || $kunjungan->emailPengunjung)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-phone mr-2 text-blue-600"></i>Kontak Pengunjung
                </h3>
                <div class="space-y-3">
                    @if($kunjungan->noHpPengunjung)
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 mr-3"></i>
                        <a href="tel:{{ $kunjungan->noHpPengunjung }}" class="text-blue-600 hover:text-blue-800">
                            {{ $kunjungan->noHpPengunjung }}
                        </a>
                    </div>
                    @endif
                    @if($kunjungan->emailPengunjung)
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-gray-400 mr-3"></i>
                        <a href="mailto:{{ $kunjungan->emailPengunjung }}" class="text-blue-600 hover:text-blue-800">
                            {{ $kunjungan->emailPengunjung }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function generateVisitReport() {
    // Implement visit report generation
    alert('Fitur laporan kunjungan akan segera tersedia');
}
</script>

<style>
@media print {
    .no-print { display: none !important; }
    .print-only { display: block !important; }
}
</style>
@endsection 