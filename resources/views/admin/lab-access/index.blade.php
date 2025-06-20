@extends('layouts.admin')

@section('title', 'Akses Laboratorium')
@section('subtitle', 'Manajemen permintaan akses laboratorium')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Akses Laboratorium</h1>
            <p class="text-gray-600">Kelola permintaan akses dan kunjungan laboratorium</p>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Kunjungan -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Kunjungan</p>
                    <p class="text-3xl font-bold">{{ $visits->total() }}</p>
                    <p class="text-blue-100 text-xs mt-1">Seluruh permintaan</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-door-open text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-2 -right-2 w-20 h-20 bg-blue-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-blue-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Pending -->
        <div class="relative bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-orange-100 text-sm font-medium mb-1">Pending</p>
                    <p class="text-3xl font-bold">{{ $visits->where('status', 'pending')->count() }}</p>
                    <p class="text-orange-100 text-xs mt-1">Menunggu persetujuan</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-2 -right-2 w-20 h-20 bg-orange-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-orange-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Disetujui -->
        <div class="relative bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-green-100 text-sm font-medium mb-1">Disetujui</p>
                    <p class="text-3xl font-bold">{{ $visits->where('status', 'approved')->count() }}</p>
                    <p class="text-green-100 text-xs mt-1">Siap dikunjungi</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-2 -right-2 w-20 h-20 bg-green-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-green-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Selesai -->
        <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-purple-100 text-sm font-medium mb-1">Selesai</p>
                    <p class="text-3xl font-bold">{{ $visits->where('status', 'completed')->count() }}</p>
                    <p class="text-purple-100 text-xs mt-1">Kunjungan berakhir</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-check-double text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-2 -right-2 w-20 h-20 bg-purple-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-purple-300 bg-opacity-15 rounded-full"></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <form method="GET" action="{{ route('admin.lab-access.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Nama pengunjung, institusi..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" 
                       name="start_date" 
                       id="start_date"
                       value="{{ request('start_date') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" 
                       name="end_date" 
                       id="end_date"
                       value="{{ request('end_date') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-end space-x-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
                <a href="{{ route('admin.lab-access.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Visits Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pengunjung
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Institusi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tujuan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Kunjungan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($visits as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium text-sm">{{ substr($visit->visitor_name, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $visit->visitor_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $visit->visitor_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->institution }}</div>
                                <div class="text-sm text-gray-500">{{ $visit->expected_participants }} orang</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($visit->purpose, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($visit->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($visit->status === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif($visit->status === 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.lab-access.show', $visit) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($visit->status === 'pending')
                                        <button onclick="openApproveModal({{ $visit->id }})" 
                                                class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="openRejectModal({{ $visit->id }})" 
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @elseif($visit->status === 'approved')
                                        <button onclick="openCompleteModal({{ $visit->id }})" 
                                                class="text-purple-600 hover:text-purple-900">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    @endif
                                    
                                    <button onclick="deleteVisit({{ $visit->id }})" 
                                            class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-door-open text-4xl mb-4 text-gray-300"></i>
                                <p>Belum ada permintaan akses laboratorium</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($visits->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $visits->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Setujui Permintaan</h3>
            <form id="approveForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <textarea name="admin_notes" id="admin_notes" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Catatan atau instruksi tambahan..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeApproveModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Permintaan</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan *</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="3" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Selesaikan Kunjungan</h3>
            <form id="completeForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="actual_participants" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta Aktual *</label>
                        <input type="number" name="actual_participants" id="actual_participants" required min="1"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="actual_start_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai *</label>
                        <input type="datetime-local" name="actual_start_time" id="actual_start_time" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="actual_end_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai *</label>
                        <input type="datetime-local" name="actual_end_time" id="actual_end_time" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="visit_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Kunjungan</label>
                        <textarea name="visit_notes" id="visit_notes" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Catatan selama kunjungan..."></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" onclick="closeCompleteModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
                        Selesaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openApproveModal(visitId) {
    document.getElementById('approveForm').action = `/admin/lab-access/${visitId}/approve`;
    document.getElementById('approveModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
}

function openRejectModal(visitId) {
    document.getElementById('rejectForm').action = `/admin/lab-access/${visitId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

function openCompleteModal(visitId) {
    document.getElementById('completeForm').action = `/admin/lab-access/${visitId}/complete`;
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeCompleteModal() {
    document.getElementById('completeModal').classList.add('hidden');
}

function deleteVisit(visitId) {
    confirmAction(
        'Apakah Anda yakin ingin menghapus data kunjungan laboratorium ini? Data yang telah dihapus tidak dapat dikembalikan.',
        () => {
            // Show loading toast
            const toastId = showToast('Menghapus data kunjungan...', 'info', 0);
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/lab-access/${visitId}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
            
            return new Promise((resolve) => {
                setTimeout(() => {
                    removeToast(toastId);
                    resolve();
                }, 1000);
            });
        },
        {
            title: 'Konfirmasi Penghapusan Data',
            confirmText: 'Ya, Hapus Data',
            cancelText: 'Batal',
            confirmClass: 'btn-danger',
            icon: 'fa-trash-alt',
            type: 'danger'
        }
    );
}

// Close modals when clicking outside
window.onclick = function(event) {
    const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');
    const completeModal = document.getElementById('completeModal');
    
    if (event.target === approveModal) {
        closeApproveModal();
    }
    if (event.target === rejectModal) {
        closeRejectModal();
    }
    if (event.target === completeModal) {
        closeCompleteModal();
    }
}
</script>
@endpush 