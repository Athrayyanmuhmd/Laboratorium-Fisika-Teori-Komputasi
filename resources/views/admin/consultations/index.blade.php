@extends('layouts.admin')

@section('title', 'Konsultasi')
@section('subtitle', 'Manajemen permintaan konsultasi dan analisis')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Konsultasi</h1>
            <p class="text-gray-600">Kelola permintaan konsultasi dan analisis laboratorium</p>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <!-- Total Konsultasi -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-blue-200 overflow-hidden">
            <div class="flex items-center justify-between relative z-10">
                <div class="flex-1">
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Konsultasi</p>
                    <p class="text-3xl font-bold">{{ $tests->total() }}</p>
                    <p class="text-blue-100 text-xs mt-1">Semua permintaan</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-user-tie text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-3 -right-3 w-24 h-24 bg-blue-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-blue-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Pending -->
        <div class="relative bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-orange-200 overflow-hidden">
            <div class="flex items-center justify-between relative z-10">
                <div class="flex-1">
                    <p class="text-orange-100 text-sm font-medium mb-1">Pending</p>
                    <p class="text-3xl font-bold">{{ $tests->where('status', 'pending')->count() }}</p>
                    <p class="text-orange-100 text-xs mt-1">Menunggu review</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-3 -right-3 w-24 h-24 bg-orange-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-orange-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Disetujui -->
        <div class="relative bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-green-200 overflow-hidden">
            <div class="flex items-center justify-between relative z-10">
                <div class="flex-1">
                    <p class="text-green-100 text-sm font-medium mb-1">Disetujui</p>
                    <p class="text-3xl font-bold">{{ $tests->where('status', 'approved')->count() }}</p>
                    <p class="text-green-100 text-xs mt-1">Siap dikerjakan</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-3 -right-3 w-24 h-24 bg-green-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-green-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Proses -->
        <div class="relative bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-teal-200 overflow-hidden">
            <div class="flex items-center justify-between relative z-10">
                <div class="flex-1">
                    <p class="text-teal-100 text-sm font-medium mb-1">Proses</p>
                    <p class="text-3xl font-bold">{{ $tests->where('status', 'in_progress')->count() }}</p>
                    <p class="text-teal-100 text-xs mt-1">Sedang dikerjakan</p>
                </div>
                <div class="bg-teal-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-cogs text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-3 -right-3 w-24 h-24 bg-teal-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-teal-300 bg-opacity-15 rounded-full"></div>
        </div>

        <!-- Selesai -->
        <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-purple-200 overflow-hidden">
            <div class="flex items-center justify-between relative z-10">
                <div class="flex-1">
                    <p class="text-purple-100 text-sm font-medium mb-1">Selesai</p>
                    <p class="text-3xl font-bold">{{ $tests->where('status', 'completed')->count() }}</p>
                    <p class="text-purple-100 text-xs mt-1">Telah diselesaikan</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-full p-4">
                    <i class="fas fa-check-double text-2xl"></i>
                </div>
            </div>
            <div class="absolute -top-3 -right-3 w-24 h-24 bg-purple-400 bg-opacity-20 rounded-full"></div>
            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-purple-300 bg-opacity-15 rounded-full"></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <form method="GET" action="{{ route('admin.consultations.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Nama, institusi, subjek..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="test_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                <select name="test_type" id="test_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Jenis</option>
                    @foreach($testTypes as $type)
                        <option value="{{ $type }}" {{ request('test_type') === $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
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
                <a href="{{ route('admin.consultations.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tests Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pemohon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subjek/Topik
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Permintaan
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
                    @forelse($tests as $test)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-purple-600 font-medium text-sm">{{ substr($test->requester_name, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $test->requester_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $test->requester_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 font-medium">{{ Str::limit($test->subject, 30) }}</div>
                                <div class="text-sm text-gray-500">{{ $test->institution }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($test->test_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $test->requested_date ? \Carbon\Carbon::parse($test->requested_date)->format('d M Y') : \Carbon\Carbon::parse($test->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($test->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($test->status === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif($test->status === 'in_progress')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                        Proses
                                    </span>
                                @elseif($test->status === 'rejected')
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
                                    <a href="{{ route('admin.consultations.show', $test) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($test->status === 'pending')
                                        <button onclick="openApproveModal({{ $test->id }})" 
                                                class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="openRejectModal({{ $test->id }})" 
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @elseif($test->status === 'approved')
                                        <button onclick="openStartModal({{ $test->id }})" 
                                                class="text-orange-600 hover:text-orange-900">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    @elseif($test->status === 'in_progress')
                                        <button onclick="openCompleteModal({{ $test->id }})" 
                                                class="text-purple-600 hover:text-purple-900">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    @endif
                                    
                                    <button onclick="deleteTest({{ $test->id }})" 
                                            class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-user-tie text-4xl mb-4 text-gray-300"></i>
                                <p>Belum ada permintaan konsultasi</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tests->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $tests->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modern Approve Modal -->
<div id="approveModal" class="fixed inset-0 z-50 flex items-center justify-center modal-backdrop hidden">
    <div class="modal-content max-w-lg w-full mx-4 transform transition-all scale-95 opacity-0">
        <div class="modal-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="confirm-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-900">Setujui Konsultasi</h3>
                        <p class="text-sm text-gray-600">Berikan persetujuan dan estimasi</p>
                    </div>
                </div>
                <button onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
        <form id="approveForm" method="POST">
            <div class="modal-body">
                @csrf
                @method('PATCH')
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="estimated_cost" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Estimasi Biaya (Rp)
                            </label>
                            <input type="number" name="estimated_cost" id="estimated_cost" min="0"
                                   class="form-input-modern" placeholder="0">
                        </div>
                        <div>
                            <label for="estimated_duration" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-blue-500"></i>Estimasi Durasi (hari)
                            </label>
                            <input type="number" name="estimated_duration" id="estimated_duration" min="1"
                                   class="form-input-modern" placeholder="1">
                        </div>
                    </div>
                    <div>
                        <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sticky-note mr-2 text-orange-500"></i>Catatan Admin
                        </label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                                  class="form-input-modern"
                                  placeholder="Catatan atau instruksi tambahan untuk konsultasi..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeApproveModal()" class="btn-modern btn-secondary">
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button type="submit" class="btn-modern btn-success">
                    <i class="fas fa-check mr-2"></i>Setujui Konsultasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Konsultasi</h3>
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

<!-- Start Modal -->
<div id="startModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Mulai Konsultasi</h3>
            <form id="startForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <div>
                        <label for="actual_start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                        <input type="datetime-local" name="actual_start_date" id="actual_start_date" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="analyst_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Analis *</label>
                        <input type="text" name="analyst_name" id="analyst_name" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nama analis/konsultan">
                    </div>
                    <div>
                        <label for="process_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Proses</label>
                        <textarea name="process_notes" id="process_notes" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Catatan awal proses..."></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" onclick="closeStartModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">
                        Mulai
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
            <h3 class="text-lg font-medium text-gray-900 mb-4">Selesaikan Konsultasi</h3>
            <form id="completeForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <div>
                        <label for="results" class="block text-sm font-medium text-gray-700 mb-2">Hasil Konsultasi *</label>
                        <textarea name="results" id="results" rows="3" required
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Hasil dan temuan konsultasi..."></textarea>
                    </div>
                    <div>
                        <label for="final_cost" class="block text-sm font-medium text-gray-700 mb-2">Biaya Final (Rp)</label>
                        <input type="number" name="final_cost" id="final_cost" min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="0">
                    </div>
                    <div>
                        <label for="recommendations" class="block text-sm font-medium text-gray-700 mb-2">Rekomendasi</label>
                        <textarea name="recommendations" id="recommendations" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Rekomendasi untuk klien..."></textarea>
                    </div>
                    <div>
                        <label for="completion_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Penyelesaian</label>
                        <textarea name="completion_notes" id="completion_notes" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Catatan tambahan..."></textarea>
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
function openApproveModal(testId) {
    document.getElementById('approveForm').action = `/admin/consultations/${testId}/approve`;
    const modal = document.getElementById('approveModal');
    modal.classList.remove('hidden');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
    
    // Trigger show animation
    setTimeout(() => {
        const content = modal.querySelector('.modal-content');
        content.style.transform = 'scale(1)';
        content.style.opacity = '1';
    }, 100);
    
    // Add form submit handler with loading state
    const form = document.getElementById('approveForm');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
        
        showToast('Memproses persetujuan konsultasi...', 'info', 0);
    });
}

function closeApproveModal() {
    const modal = document.getElementById('approveModal');
    const content = modal.querySelector('.modal-content');
    content.style.transform = 'scale(0.95)';
    content.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

function openRejectModal(testId) {
    document.getElementById('rejectForm').action = `/admin/consultations/${testId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

function openStartModal(testId) {
    document.getElementById('startForm').action = `/admin/consultations/${testId}/start`;
    document.getElementById('startModal').classList.remove('hidden');
}

function closeStartModal() {
    document.getElementById('startModal').classList.add('hidden');
}

function openCompleteModal(testId) {
    document.getElementById('completeForm').action = `/admin/consultations/${testId}/complete`;
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeCompleteModal() {
    document.getElementById('completeModal').classList.add('hidden');
}

function deleteTest(testId) {
    confirmAction(
        'Apakah Anda yakin ingin menghapus data konsultasi ini? Tindakan ini tidak dapat dibatalkan.',
        () => {
            // Show loading toast
            const toastId = showToast('Menghapus data konsultasi...', 'info', 0);
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/consultations/${testId}`;
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
            title: 'Konfirmasi Penghapusan',
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
    const modals = ['approveModal', 'rejectModal', 'startModal', 'completeModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
}
</script>
@endpush 