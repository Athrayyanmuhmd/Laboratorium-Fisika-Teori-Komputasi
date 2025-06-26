@extends('layouts.admin')

@section('title', 'Manajemen Maintenance')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Header Section -->
        <div class="glass-header rounded-2xl p-8 mb-8 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">
                        <i class="fas fa-tools mr-3"></i>
                        Manajemen Maintenance
                    </h1>
                    <p class="text-orange-100">Kelola jadwal maintenance dan kalibrasi peralatan laboratorium</p>
                </div>
                
                <div class="mt-4 lg:mt-0 flex flex-wrap gap-3">
                    <button onclick="openMaintenanceModal()" class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Jadwalkan Maintenance
                    </button>
                    <a href="{{ route('admin.laboran.maintenance.report') }}" class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Laporan
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="glass-card rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-list text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['total'] }}</h3>
                <p class="text-gray-600 text-sm">Total Maintenance</p>
            </div>
            
            <div class="glass-card rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['dijadwalkan'] }}</h3>
                <p class="text-gray-600 text-sm">Dijadwalkan</p>
            </div>
            
            <div class="glass-card rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cog text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['sedang_proses'] }}</h3>
                <p class="text-gray-600 text-sm">Sedang Proses</p>
            </div>
            
            <div class="glass-card rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['selesai'] }}</h3>
                <p class="text-gray-600 text-sm">Selesai</p>
            </div>
            
            <div class="glass-card rounded-2xl p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-pause text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['ditunda'] }}</h3>
                <p class="text-gray-600 text-sm">Ditunda</p>
            </div>
        </div>

        <!-- Alert for Equipment Needing Calibration -->
        @if($alatPerluKalibrasi->count() > 0)
        <div class="glass-card rounded-2xl p-6 mb-8 border-l-4 border-red-500">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-red-800 mb-2">Peringatan Kalibrasi</h3>
                    <p class="text-red-700 mb-4">{{ $alatPerluKalibrasi->count() }} alat memerlukan kalibrasi segera:</p>
                    <div class="space-y-2">
                        @foreach($alatPerluKalibrasi->take(5) as $alat)
                        <div class="flex items-center justify-between bg-red-50 p-3 rounded-lg">
                            <span class="font-medium">{{ $alat->nama }}</span>
                            <span class="text-sm {{ $alat->status_kalibrasi_badge }}">
                                {{ $alat->status_kalibrasi }}
                            </span>
                        </div>
                        @endforeach
                        @if($alatPerluKalibrasi->count() > 5)
                        <p class="text-sm text-red-600">dan {{ $alatPerluKalibrasi->count() - 5 }} alat lainnya...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="glass-card rounded-2xl p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari alat, teknisi..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="DIJADWALKAN" {{ request('status') === 'DIJADWALKAN' ? 'selected' : '' }}>Dijadwalkan</option>
                        <option value="SEDANG_PROSES" {{ request('status') === 'SEDANG_PROSES' ? 'selected' : '' }}>Sedang Proses</option>
                        <option value="SELESAI" {{ request('status') === 'SELESAI' ? 'selected' : '' }}>Selesai</option>
                        <option value="DITUNDA" {{ request('status') === 'DITUNDA' ? 'selected' : '' }}>Ditunda</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                    <select name="jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Semua Jenis</option>
                        <option value="PREVENTIF" {{ request('jenis') === 'PREVENTIF' ? 'selected' : '' }}>Preventif</option>
                        <option value="KOREKTIF" {{ request('jenis') === 'KOREKTIF' ? 'selected' : '' }}>Korektif</option>
                        <option value="KALIBRASI" {{ request('jenis') === 'KALIBRASI' ? 'selected' : '' }}>Kalibrasi</option>
                        <option value="PEMBERSIHAN" {{ request('jenis') === 'PEMBERSIHAN' ? 'selected' : '' }}>Pembersihan</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-2 px-4 rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Maintenance List -->
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Maintenance</h2>
            </div>
            
            @if($maintenanceLogs->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 p-6">
                @foreach($maintenanceLogs as $maintenance)
                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 mb-1">{{ $maintenance->alat->nama }}</h3>
                            <p class="text-sm text-gray-600">{{ $maintenance->alat->kode_alat ?? 'N/A' }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $maintenance->jenis_badge }}">
                            {{ $maintenance->jenis_maintenance }}
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2 text-gray-400"></i>
                            <span>{{ $maintenance->tanggal_maintenance->format('d M Y') }}</span>
                        </div>
                        
                        @if($maintenance->teknisi)
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-user mr-2 text-gray-400"></i>
                            <span>{{ $maintenance->teknisi }}</span>
                        </div>
                        @endif
                        
                        @if($maintenance->biaya)
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-money-bill mr-2 text-gray-400"></i>
                            <span>Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        
                        <div class="text-sm text-gray-600">
                            <p class="line-clamp-2">{{ $maintenance->deskripsi_kegiatan }}</p>
                        </div>
                    </div>
                    
                    <!-- Status & Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $maintenance->status_badge }}">
                            {{ $maintenance->status }}
                        </span>
                        
                        <div class="flex space-x-2">
                            <button onclick="viewMaintenance('{{ $maintenance->id }}')" 
                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="updateMaintenanceStatus('{{ $maintenance->id }}')" 
                                    class="text-green-600 hover:text-green-800 text-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $maintenanceLogs->links() }}
            </div>
            @else
            <div class="p-12 text-center">
                <i class="fas fa-tools text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Maintenance</h3>
                <p class="text-gray-500 mb-6">Mulai jadwalkan maintenance untuk peralatan laboratorium</p>
                <button onclick="openMaintenanceModal()" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Jadwalkan Maintenance
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Maintenance Modal -->
<div id="maintenanceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="glass-card rounded-2xl w-full max-w-2xl">
            <div class="glass-header p-6 text-white rounded-t-2xl">
                <h3 class="text-xl font-bold">Jadwalkan Maintenance</h3>
                <p class="text-orange-100 text-sm">Buat jadwal maintenance untuk peralatan laboratorium</p>
            </div>
            
            <form id="maintenanceForm" method="POST" action="{{ route('admin.laboran.maintenance.store') }}">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alat *</label>
                            <select name="alat_id" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Pilih Alat</option>
                                <!-- Will be populated via AJAX -->
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Maintenance *</label>
                            <select name="jenis_maintenance" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Pilih Jenis</option>
                                <option value="PREVENTIF">Preventif</option>
                                <option value="KOREKTIF">Korektif</option>
                                <option value="KALIBRASI">Kalibrasi</option>
                                <option value="PEMBERSIHAN">Pembersihan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Maintenance *</label>
                            <input type="date" name="tanggal_maintenance" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teknisi</label>
                            <input type="text" name="teknisi" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="Nama teknisi">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kegiatan *</label>
                        <textarea name="deskripsi_kegiatan" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                  placeholder="Jelaskan kegiatan maintenance yang akan dilakukan"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Biaya</label>
                            <input type="number" name="biaya" min="0" step="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="0">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <input type="text" name="catatan" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="Catatan tambahan">
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end gap-4 p-6 border-t border-gray-200">
                    <button type="button" onclick="closeMaintenanceModal()" 
                            class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

.glass-header {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function openMaintenanceModal() {
    document.getElementById('maintenanceModal').classList.remove('hidden');
    loadAlatOptions();
}

function closeMaintenanceModal() {
    document.getElementById('maintenanceModal').classList.add('hidden');
    document.getElementById('maintenanceForm').reset();
}

function loadAlatOptions() {
    fetch('{{ route("admin.laboran.maintenance.alat-tersedia") }}')
        .then(response => response.json())
        .then(data => {
            const select = document.querySelector('select[name="alat_id"]');
            select.innerHTML = '<option value="">Pilih Alat</option>';
            
            data.forEach(alat => {
                const option = document.createElement('option');
                option.value = alat.id;
                option.textContent = alat.text;
                if (alat.status_kalibrasi === 'EXPIRED') {
                    option.textContent += ' (PERLU KALIBRASI)';
                    option.style.color = 'red';
                }
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error loading alat options:', error));
}

function viewMaintenance(id) {
    window.location.href = `{{ route('admin.laboran.maintenance.index') }}/${id}`;
}

function updateMaintenanceStatus(id) {
    // Implementation for status update modal
    console.log('Update status for maintenance:', id);
}

// Close modal when clicking outside
document.getElementById('maintenanceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMaintenanceModal();
    }
});
</script>
@endsection 