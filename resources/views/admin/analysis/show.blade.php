@extends('layouts.admin')

@section('title', 'Detail Analisis & Simulasi')
@section('subtitle', 'Informasi Lengkap Request Analisis')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail Request Analisis</h2>
                <p class="text-gray-600">{{ $analysis->request_code }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.analysis-requests.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        
        <!-- Status Badge -->
        <div class="mb-4">
            @switch($analysisRequest->status)
                @case('pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-2"></i>Pending
                    </span>
                    @break
                @case('approved')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>Approved
                    </span>
                    @break
                @case('in_progress')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-play-circle mr-2"></i>In Progress
                    </span>
                    @break
                @case('completed')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-check-double mr-2"></i>Completed
                    </span>
                    @break
                @case('rejected')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <i class="fas fa-times-circle mr-2"></i>Rejected
                    </span>
                    @break
            @endswitch
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Peneliti -->
        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-user-graduate text-purple-600 mr-2"></i>Informasi Peneliti
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Peneliti</label>
                    <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $analysisRequest->researcher_name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Afiliasi</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $analysisRequest->affiliation }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">
                        <a href="mailto:{{ $analysisRequest->email }}" class="text-purple-600 hover:text-purple-800">
                            {{ $analysisRequest->email }}
                        </a>
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Request</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $analysisRequest->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Analisis -->
        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-chart-line text-purple-600 mr-2"></i>Detail Analisis
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Analisis</label>
                    <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $analysisRequest->getAnalysisTypeLabel() }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Parameter yang Dianalisis</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $analysisRequest->analysis_parameters }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Target Deadline</label>
                    <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $analysisRequest->target_deadline->format('d F Y') }}</p>
                    @php
                        $daysLeft = now()->diffInDays($analysisRequest->target_deadline, false);
                    @endphp
                    @if($daysLeft > 7)
                        <span class="text-xs text-green-600 font-medium">{{ $daysLeft }} hari lagi</span>
                    @elseif($daysLeft > 0)
                        <span class="text-xs text-yellow-600 font-medium">{{ $daysLeft }} hari lagi</span>
                    @else
                        <span class="text-xs text-red-600 font-medium">Terlewat {{ abs($daysLeft) }} hari</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Deskripsi Data/Problem -->
    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-file-alt text-purple-600 mr-2"></i>Deskripsi Data/Problem
        </h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-700 leading-relaxed">{{ $analysisRequest->data_description }}</p>
        </div>
    </div>

    <!-- Catatan Admin & Hasil -->
    @if($analysisRequest->admin_notes || $analysisRequest->results)
        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-sticky-note text-purple-600 mr-2"></i>Catatan Admin & Hasil
            </h3>
            
            @if($analysisRequest->admin_notes)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $analysisRequest->admin_notes }}</p>
                    </div>
                </div>
            @endif
            
            @if($analysisRequest->results)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil Analisis</label>
                    <div class="bg-green-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $analysisRequest->results }}</p>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-cogs text-purple-600 mr-2"></i>Aksi
        </h3>
        
        <div class="flex flex-wrap gap-3">
            @if($analysisRequest->status === 'pending')
                <button onclick="openApprovalModal({{ $analysisRequest->id }})" 
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i>Setujui Request
                </button>
                <button onclick="openRejectionModal({{ $analysisRequest->id }})" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-times mr-2"></i>Tolak Request
                </button>
            @elseif($analysisRequest->status === 'approved')
                <button onclick="openStartModal({{ $analysisRequest->id }})" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-play mr-2"></i>Mulai Analisis
                </button>
            @elseif($analysisRequest->status === 'in_progress')
                <button onclick="openCompleteModal({{ $analysisRequest->id }})" 
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-check-double mr-2"></i>Selesaikan Analisis
                </button>
            @endif
            
            <!-- Contact via Email -->
            <a href="mailto:{{ $analysisRequest->email }}?subject=Regarding Analysis Request {{ $analysisRequest->request_code }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-envelope mr-2"></i>Hubungi via Email
            </a>
        </div>
    </div>
</div>

<!-- Include the same modals from index.blade.php -->
<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Setujui Request Analisis</h3>
            <form id="approvalForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <textarea name="admin_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Tambahkan catatan untuk request ini..."></textarea>
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
            <h3 class="text-xl font-bold text-gray-900 mb-4">Tolak Request Analisis</h3>
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

<!-- Start Progress Modal -->
<div id="startModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Mulai Analisis</h3>
            <form id="startForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Mulai Analisis</label>
                    <textarea name="admin_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Catatan mengenai dimulainya analisis..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-play mr-2"></i>Mulai
                    </button>
                    <button type="button" onclick="closeModal('startModal')" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
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
            <h3 class="text-xl font-bold text-gray-900 mb-4">Selesaikan Analisis</h3>
            <form id="completeForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil Analisis</label>
                    <textarea name="results" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Ringkasan hasil analisis dan file yang dihasilkan..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Penyelesaian</label>
                    <textarea name="admin_notes" rows="2" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Catatan tambahan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors">
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
function openApprovalModal(analysisId) {
    const modal = document.getElementById('approvalModal');
    const form = document.getElementById('approvalForm');
    form.action = `/admin/analysis-requests/${analysisId}/approve`;
    modal.classList.remove('hidden');
}

function openRejectionModal(analysisId) {
    const modal = document.getElementById('rejectionModal');
    const form = document.getElementById('rejectionForm');
    form.action = `/admin/analysis-requests/${analysisId}/reject`;
    modal.classList.remove('hidden');
}

function openStartModal(analysisId) {
    const modal = document.getElementById('startModal');
    const form = document.getElementById('startForm');
    form.action = `/admin/analysis-requests/${analysisId}/start`;
    modal.classList.remove('hidden');
}

function openCompleteModal(analysisId) {
    const modal = document.getElementById('completeModal');
    const form = document.getElementById('completeForm');
    form.action = `/admin/analysis-requests/${analysisId}/complete`;
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
