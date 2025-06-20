@extends('layouts.admin')

@section('title', 'Detail Alat - ' . $equipment->name)

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $equipment->name }}</h1>
                <p class="text-gray-600 mt-1">Kode: {{ $equipment->code }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.equipment.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <a href="{{ route('admin.equipment.edit', $equipment) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Images and Basic Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Gambar Alat</h3>
                @if($equipment->images && count($equipment->images) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($equipment->images as $image)
                            <div class="aspect-w-16 aspect-h-12 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $equipment->name }}"
                                     class="w-full h-64 object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                     onclick="openImageModal('{{ asset('storage/' . $image) }}')"
                                     onerror="this.parentElement.innerHTML='<div class=\'w-full h-64 flex items-center justify-center bg-gray-100\'><i class=\'fas fa-microscope text-4xl text-gray-400\'></i></div>'">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-image text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada gambar untuk alat ini</p>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($equipment->description)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">{{ $equipment->description }}</p>
            </div>
            @endif

            <!-- Specifications -->
            @if($equipment->specifications)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Spesifikasi Teknis</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($equipment->specifications as $key => $value)
                        <div class="bg-gray-50 rounded-lg p-3">
                            <dt class="text-sm font-medium text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Rentals -->
            @if($equipment->rentals->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Penyewaan Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($equipment->rentals()->latest()->take(5)->get() as $rental)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $rental->requester_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $rental->requester_email }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $rental->start_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($rental->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                        @elseif($rental->status === 'approved')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Disetujui</span>
                                        @elseif($rental->status === 'returned')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Dikembalikan</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $rental->duration }} hari
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Details -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Kondisi</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Status</label>
                        <div class="mt-1">
                            @if($equipment->status === 'available')
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Tersedia
                                </span>
                            @elseif($equipment->status === 'rented')
                                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    <i class="fas fa-user mr-2"></i>
                                    Dipinjam
                                </span>
                            @elseif($equipment->status === 'maintenance')
                                <span class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm">
                                    <i class="fas fa-tools mr-2"></i>
                                    Maintenance
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                    <i class="fas fa-archive mr-2"></i>
                                    Tidak Aktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Kondisi</label>
                        <div class="mt-1">
                            @if($equipment->condition === 'excellent')
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                    <i class="fas fa-star mr-2"></i>
                                    Excellent
                                </span>
                            @elseif($equipment->condition === 'good')
                                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    <i class="fas fa-thumbs-up mr-2"></i>
                                    Good
                                </span>
                            @elseif($equipment->condition === 'fair')
                                <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                    <i class="fas fa-minus-circle mr-2"></i>
                                    Fair
                                </span>
                            @elseif($equipment->condition === 'poor')
                                <span class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Poor
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    Damaged
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Ketersediaan</label>
                        <div class="mt-1">
                            <span class="text-lg font-semibold text-gray-900">{{ $equipment->available_quantity }}/{{ $equipment->quantity }}</span>
                            <span class="text-sm text-gray-500 ml-2">unit tersedia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Details -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Teknis</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Laboratorium</label>
                        <p class="text-sm text-gray-900">{{ $equipment->laboratory->name }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-600">Kategori</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($equipment->category) }}</p>
                    </div>

                    @if($equipment->brand)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Brand</label>
                        <p class="text-sm text-gray-900">{{ $equipment->brand }}</p>
                    </div>
                    @endif

                    @if($equipment->model)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Model</label>
                        <p class="text-sm text-gray-900">{{ $equipment->model }}</p>
                    </div>
                    @endif

                    @if($equipment->purchase_year)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Tahun Pembelian</label>
                        <p class="text-sm text-gray-900">{{ $equipment->purchase_year }}</p>
                    </div>
                    @endif

                    @if($equipment->purchase_price)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Harga Pembelian</label>
                        <p class="text-sm text-gray-900">Rp {{ number_format($equipment->purchase_price, 0, ',', '.') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Calibration Info -->
            @if($equipment->last_calibration || $equipment->next_calibration)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kalibrasi</h3>
                <div class="space-y-3">
                    @if($equipment->last_calibration)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Kalibrasi Terakhir</label>
                        <p class="text-sm text-gray-900">{{ $equipment->last_calibration->format('d M Y') }}</p>
                    </div>
                    @endif

                    @if($equipment->next_calibration)
                    <div>
                        <label class="text-sm font-medium text-gray-600">Kalibrasi Berikutnya</label>
                        <p class="text-sm text-gray-900">{{ $equipment->next_calibration->format('d M Y') }}</p>
                        @if($equipment->needsCalibration())
                            <p class="text-xs text-red-600 mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Perlu kalibrasi segera!
                            </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Notes -->
            @if($equipment->notes)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Catatan</h3>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $equipment->notes }}</p>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('admin.equipment.toggle-status', $equipment) }}">
                        @csrf
                        <button type="submit" 
                                class="w-full {{ $equipment->status === 'available' ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg text-sm">
                            {{ $equipment->status === 'available' ? 'Nonaktifkan Alat' : 'Aktifkan Alat' }}
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.equipment.destroy', $equipment) }}" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                            Hapus Alat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" 
                class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
    </div>
</div>

@push('scripts')
<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal when clicking outside the image
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
@endpush
@endsection 