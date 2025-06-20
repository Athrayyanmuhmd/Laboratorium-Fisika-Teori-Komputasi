@extends('layouts.admin')

@section('title', 'Manajemen Simulasi & Komputasi')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Simulasi & Komputasi</h1>
            <p class="text-gray-600 mt-1">Kelola permintaan penggunaan PC dan software simulasi</p>
        </div>
    </div>

    <!-- Modern Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <!-- Total Simulasi -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Simulasi</p>
                    <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
                    <p class="text-blue-100 text-xs mt-1">Semua permintaan</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-laptop-code text-2xl"></i>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-400 bg-opacity-20 rounded-full -mr-10 -mt-10"></div>
        </div>
        
        <!-- Pending -->
        <div class="relative bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Pending</p>
                    <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                    <p class="text-orange-100 text-xs mt-1">Menunggu review</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-20 h-20 bg-orange-400 bg-opacity-20 rounded-full -mr-10 -mt-10"></div>
        </div>
        
        <!-- Disetujui -->
        <div class="relative bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Disetujui</p>
                    <p class="text-3xl font-bold">{{ $stats['approved'] }}</p>
                    <p class="text-green-100 text-xs mt-1">Siap digunakan</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-20 h-20 bg-green-400 bg-opacity-20 rounded-full -mr-10 -mt-10"></div>
        </div>
        
        <!-- Selesai -->
        <div class="relative bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium">Selesai</p>
                    <p class="text-3xl font-bold">{{ $stats['returned'] }}</p>
                    <p class="text-indigo-100 text-xs mt-1">Telah diselesaikan</p>
                </div>
                <div class="bg-indigo-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-check-double text-2xl"></i>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-400 bg-opacity-20 rounded-full -mr-10 -mt-10"></div>
        </div>
        
        <!-- Ditolak -->
        <div class="relative bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Ditolak</p>
                    <p class="text-3xl font-bold">{{ $stats['rejected'] }}</p>
                    <p class="text-red-100 text-xs mt-1">Tidak disetujui</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-times-circle text-2xl"></i>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-20 h-20 bg-red-400 bg-opacity-20 rounded-full -mr-10 -mt-10"></div>
        </div>
    </div>

    <!-- Enhanced Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3">
                <i class="fas fa-filter text-white text-lg"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900">Filter Simulasi & Komputasi</h3>
        </div>
        
        <form method="GET" class="space-y-6">
            <!-- Top Row - Search and Status -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="search" class="form-label-modern">
                        <i class="fas fa-search mr-2 text-gray-500"></i>Pencarian
                    </label>
                    <input type="text" 
                           name="search" 
                           id="search"
                           value="{{ request('search') }}"
                           placeholder="Nama, email, project..."
                           class="form-input-modern w-full">
                    <p class="text-xs text-gray-500 mt-1">Cari berdasarkan nama pemohon, email, atau judul project</p>
                </div>
                
                <div>
                    <label for="status" class="form-label-modern">
                        <i class="fas fa-info-circle mr-2 text-gray-500"></i>Status
                    </label>
                    <select name="status" id="status" class="form-input-modern w-full">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                            🕐 Pending
                        </option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>
                            ✅ Disetujui
                        </option>
                        <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>
                            🏁 Selesai
                        </option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>
                            ❌ Ditolak
                        </option>
                    </select>
                </div>
            </div>
            
            <!-- Bottom Row - Date Range and Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-end">
                <div>
                    <label for="date_from" class="form-label-modern">
                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>Dari Tanggal
                    </label>
                    <input type="date" 
                           name="date_from" 
                           id="date_from"
                           value="{{ request('date_from') }}"
                           class="form-input-modern w-full">
                </div>
                
                <div>
                    <label for="date_to" class="form-label-modern">
                        <i class="fas fa-calendar-check mr-2 text-gray-500"></i>Sampai Tanggal
                    </label>
                    <input type="date" 
                           name="date_to" 
                           id="date_to"
                           value="{{ request('date_to') }}"
                           class="form-input-modern w-full">
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="btn-modern btn-primary flex-1">
                        <i class="fas fa-search mr-2"></i>
                        Filter
                    </button>
                </div>
                
                <div>
                    <a href="{{ route('admin.simulations.index') }}" class="btn-modern btn-secondary w-full">
                        <i class="fas fa-refresh mr-2"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Rentals Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rentals as $rental)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $rental->requester_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $rental->requester_email }}</div>
                                    <div class="text-sm text-gray-500">{{ $rental->requester_phone }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $rental->project_title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($rental->project_description, 60) }}</div>
                                @if($rental->required_software)
                                    <div class="text-xs text-blue-600 mt-1">
                                        <i class="fas fa-desktop mr-1"></i>
                                        {{ $rental->required_software }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $rental->start_date->format('d M Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $rental->duration }} hari
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rental->status === 'pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                @elseif($rental->status === 'approved')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Disetujui</span>
                                @elseif($rental->status === 'returned')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Selesai</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $rental->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.simulations.show', $rental) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    
                                    @if($rental->status === 'pending')
                                        <button onclick="openApproveModal({{ $rental->id }})" 
                                                class="text-green-600 hover:text-green-900">Setujui</button>
                                        <button onclick="openRejectModal({{ $rental->id }})" 
                                                class="text-red-600 hover:text-red-900">Tolak</button>
                                    @elseif($rental->status === 'approved')
                                        <button onclick="openCompleteModal({{ $rental->id }})" 
                                                class="text-blue-600 hover:text-blue-900">Selesai</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-laptop-code text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Belum ada permintaan simulasi</p>
                                    <p class="text-sm">Permintaan simulasi akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($rentals->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $rentals->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Setujui Permintaan Simulasi</h3>
            <form id="approveForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="approved_start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" 
                               name="approved_start_date" 
                               id="approved_start_date"
                               required
                               class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="approved_end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" 
                               name="approved_end_date" 
                               id="approved_end_date"
                               required
                               class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                        <textarea name="admin_notes" 
                                  id="admin_notes"
                                  rows="3"
                                  class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            onclick="closeApproveModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
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
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Permintaan Simulasi</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                        <textarea name="rejection_reason" 
                                  id="rejection_reason"
                                  rows="4"
                                  required
                                  class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
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
<div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Selesaikan Simulasi</h3>
            <form id="completeForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="actual_return_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" 
                               name="actual_return_date" 
                               id="actual_return_date"
                               value="{{ date('Y-m-d') }}"
                               required
                               class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="return_condition" class="block text-sm font-medium text-gray-700">Kondisi Perangkat</label>
                        <select name="return_condition" 
                                id="return_condition"
                                required
                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="good">Baik</option>
                            <option value="damaged">Rusak</option>
                            <option value="missing">Hilang</option>
                        </select>
                    </div>
                    <div>
                        <label for="return_notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="return_notes" 
                                  id="return_notes"
                                  rows="3"
                                  class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            onclick="closeCompleteModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openApproveModal(rentalId) {
        document.getElementById('approveForm').action = `/admin/simulations/${rentalId}/approve`;
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
    }

    function openRejectModal(rentalId) {
        document.getElementById('rejectForm').action = `/admin/simulations/${rentalId}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    function openCompleteModal(rentalId) {
        document.getElementById('completeForm').action = `/admin/simulations/${rentalId}/complete`;
        document.getElementById('completeModal').classList.remove('hidden');
    }

    function closeCompleteModal() {
        document.getElementById('completeModal').classList.add('hidden');
    }
</script>
@endpush
@endsection 