@extends('layouts.admin')

@section('title', 'Detail Peminjaman')
@section('subtitle', 'Informasi Lengkap Peminjaman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Peminjaman</h1>
            <p class="text-gray-600">ID: {{ $peminjaman->id }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.laboran.peminjaman.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="flex items-center space-x-4">
        <span class="px-3 py-1 rounded-full text-sm font-medium
            @if($peminjaman->status === 'PENDING') bg-yellow-100 text-yellow-800
            @elseif($peminjaman->status === 'PROCESSING') bg-blue-100 text-blue-800
            @elseif($peminjaman->status === 'COMPLETED') bg-green-100 text-green-800
            @else bg-red-100 text-red-800
            @endif">
            {{ $peminjaman->status }}
        </span>
        <span class="text-sm text-gray-500">
            Dibuat: {{ $peminjaman->created_at->format('d M Y H:i') }}
        </span>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Peminjam Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Peminjam -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-user mr-2 text-blue-600"></i>Informasi Peminjam
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Peminjam</label>
                        <p class="text-gray-900">{{ $peminjaman->namaPeminjam }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <p class="text-gray-900">{{ $peminjaman->noHp }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $peminjaman->email ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                        <p class="text-gray-900">{{ $peminjaman->instansi ?? 'Tidak ada' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Peminjaman -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-calendar mr-2 text-blue-600"></i>Detail Peminjaman
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <p class="text-gray-900">{{ $peminjaman->tanggalMulai ? \Carbon\Carbon::parse($peminjaman->tanggalMulai)->format('d M Y') : 'Belum ditentukan' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <p class="text-gray-900">{{ $peminjaman->tanggalSelesai ? \Carbon\Carbon::parse($peminjaman->tanggalSelesai)->format('d M Y') : 'Belum ditentukan' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Peminjaman</label>
                        <p class="text-gray-900">{{ $peminjaman->tujuanPeminjaman ?? 'Tidak ada keterangan' }}</p>
                    </div>
                </div>
            </div>

            <!-- Alat yang Dipinjam -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-tools mr-2 text-blue-600"></i>Alat yang Dipinjam
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi Pinjam</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($peminjaman->alat as $alat)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $alat->nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $alat->pivot->jumlah ?? 1 }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                        {{ $alat->pivot->kondisi_saat_pinjam ?? 'BAIK' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($alat->pivot->kondisi_saat_kembali)
                                        <span class="px-2 py-1 rounded-full text-xs
                                            @if($alat->pivot->kondisi_saat_kembali === 'BAIK') bg-green-100 text-green-800
                                            @elseif($alat->pivot->kondisi_saat_kembali === 'RUSAK_RINGAN') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $alat->pivot->kondisi_saat_kembali }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">Belum dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada alat yang dipinjam</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                <form action="{{ route('admin.laboran.peminjaman.update-status', $peminjaman) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="PENDING" {{ $peminjaman->status === 'PENDING' ? 'selected' : '' }}>Pending</option>
                                <option value="PROCESSING" {{ $peminjaman->status === 'PROCESSING' ? 'selected' : '' }}>Processing</option>
                                <option value="COMPLETED" {{ $peminjaman->status === 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                                <option value="CANCELLED" {{ $peminjaman->status === 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
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
                    <form action="{{ route('admin.laboran.peminjaman.destroy', $peminjaman) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>Hapus Data
                        </button>
                    </form>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-history mr-2 text-blue-600"></i>Timeline
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-600 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium">Dibuat</p>
                            <p class="text-xs text-gray-500">{{ $peminjaman->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    @if($peminjaman->updated_at != $peminjaman->created_at)
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-600 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium">Terakhir Update</p>
                            <p class="text-xs text-gray-500">{{ $peminjaman->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    .print-only { display: block !important; }
}
</style>
@endsection 