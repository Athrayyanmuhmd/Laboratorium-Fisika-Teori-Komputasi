@extends('layouts.admin')

@section('title', 'Manajemen Kunjungan Lab')
@section('subtitle', 'Kelola Permintaan Kunjungan Lab')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header & Stats -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-xl p-8 text-white">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-3xl font-bold mb-2">Kunjungan Lab</h2>
                <p class="text-emerald-100 text-lg">Kelola permintaan kunjungan edukatif dan riset ke laboratorium</p>
            </div>
            <div class="text-right">
                <div class="text-4xl font-bold">{{ $stats['total'] ?? 0 }}</div>
                <div class="text-emerald-200 text-sm">Total Permintaan</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="flex flex-wrap gap-3">
            <button class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white text-sm font-medium transition-all backdrop-blur">
                <i class="fas fa-calendar-plus mr-2"></i>Jadwalkan Kunjungan
            </button>
            <button class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white text-sm font-medium transition-all backdrop-blur">
                <i class="fas fa-file-export mr-2"></i>Export Laporan
            </button>
            <button class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white text-sm font-medium transition-all backdrop-blur">
                <i class="fas fa-chart-bar mr-2"></i>Statistik Kunjungan
            </button>
        </div>
    </div>
    
    <!-- Enhanced Statistics Cards -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-chart-pie text-emerald-600 mr-2"></i>
            Overview Status Kunjungan
        </h3>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold">{{ $stats['pending'] ?? 0 }}</div>
                        <div class="text-sm opacity-90">Menunggu</div>
                    </div>
                    <i class="fas fa-clock text-2xl opacity-75"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold">{{ $stats['approved'] ?? 0 }}</div>
                        <div class="text-sm opacity-90">Disetujui</div>
                    </div>
                    <i class="fas fa-check-circle text-2xl opacity-75"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold">{{ $stats['completed'] ?? 0 }}</div>
                        <div class="text-sm opacity-90">Selesai</div>
                    </div>
                    <i class="fas fa-check-double text-2xl opacity-75"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold">{{ $stats['rejected'] ?? 0 }}</div>
                        <div class="text-sm opacity-90">Ditolak</div>
                    </div>
                    <i class="fas fa-times-circle text-2xl opacity-75"></i>
                </div>
            </div>
        </div>

        <!-- Enhanced Filters -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
            <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-filter text-gray-500 mr-2"></i>
                Filter & Pencarian Data
            </h4>
            <form method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-80">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama PIC, institusi, atau kode kunjungan..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <select name="status" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent min-w-32">
                        <option value="">Semua Status</option>
                        @if(isset($statuses))
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    
                    <select name="type" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent min-w-40">
                        <option value="">Semua Jenis</option>
                        @if(isset($types))
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $type)) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all font-medium shadow-lg hover:shadow-xl">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    
                    <a href="{{ route('admin.lab-visits.index') }}" class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Enhanced Lab Visits Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 border-b border-emerald-100">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-table text-emerald-600 mr-2"></i>
                Daftar Kunjungan Lab
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-user-friends mr-1"></i>Kunjungan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-list mr-1"></i>Jenis & Peserta
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-calendar mr-1"></i>Tanggal
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-info-circle mr-1"></i>Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-clock mr-1"></i>Dibuat
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <i class="fas fa-cogs mr-1"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($visits ?? [] as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $visit->pic_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $visit->institution }}</div>
                                        <div class="text-sm text-gray-500">{{ $visit->visit_code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->getVisitTypeLabel() }}</div>
                                <div class="text-sm text-gray-500">{{ $visit->participant_count }} peserta</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->visit_date->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $visit->visit_date->format('l') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($visit->status)
                                    @case('pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Menunggu
                                        </span>
                                        @break
                                    @case('approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Disetujui
                                        </span>
                                        @break
                                    @case('completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-check-double mr-1"></i>Selesai
                                        </span>
                                        @break
                                    @case('rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $visit->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.lab-visits.show', $visit) }}" 
                                       class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($visit->status === 'pending')
                                        <button onclick="openApprovalModal({{ $visit->id }})" 
                                                class="text-green-600 hover:text-green-900" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="openRejectionModal({{ $visit->id }})" 
                                                class="text-red-600 hover:text-red-900" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @elseif($visit->status === 'approved')
                                        <button onclick="openCompleteModal({{ $visit->id }})" 
                                                class="text-blue-600 hover:text-blue-900" title="Selesai">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-2"></i>
                                <div>Belum ada permintaan kunjungan lab</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($visits) && $visits->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $visits->appends(request()->all())->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Setujui Kunjungan Lab</h3>
            <form id="approvalForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <textarea name="admin_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Tambahkan catatan untuk pengajuan ini..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-check mr-2"></i>Setujui
                    </button>
                    <button type="button" onclick="closeModal('approvalModal')" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Tolak Kunjungan Lab</h3>
            <form id="rejectionForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea name="admin_notes" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Berikan alasan penolakan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-times mr-2"></i>Tolak
                    </button>
                    <button type="button" onclick="closeModal('rejectionModal')" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div id="completeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Selesaikan Kunjungan Lab</h3>
            <form id="completeForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Penyelesaian</label>
                    <textarea name="admin_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Catatan mengenai pelaksanaan kunjungan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-check-double mr-2"></i>Selesai
                    </button>
                    <button type="button" onclick="closeModal('completeModal')" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openApprovalModal(visitId) {
    const modal = document.getElementById('approvalModal');
    const form = document.getElementById('approvalForm');
    form.action = `/admin/lab-visits/${visitId}/approve`;
    modal.classList.remove('hidden');
}

function openRejectionModal(visitId) {
    const modal = document.getElementById('rejectionModal');
    const form = document.getElementById('rejectionForm');
    form.action = `/admin/lab-visits/${visitId}/reject`;
    modal.classList.remove('hidden');
}

function openCompleteModal(visitId) {
    const modal = document.getElementById('completeModal');
    const form = document.getElementById('completeForm');
    form.action = `/admin/lab-visits/${visitId}/complete`;
    modal.classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
        e.target.classList.add('hidden');
    }
});
</script>
@endsection
@extends('layouts.admin')
@section('title', 'Kunjungan Lab')
@section('content')
<h1>Lab Visits Admin Page</h1>
@endsection
