@extends('layouts.admin')

@section('title', 'Tambah Alat Laboratorium')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Alat Laboratorium</h1>
                <p class="text-gray-600 mt-1">Tambahkan alat baru ke inventaris laboratorium</p>
            </div>
            <a href="{{ route('admin.equipment.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.equipment.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Alat *</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name') }}"
                           required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Kode Alat *</label>
                    <input type="text" 
                           name="code" 
                           id="code"
                           value="{{ old('code') }}"
                           required
                           placeholder="Contoh: PC-001, LAB-MIC-001"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('code') border-red-300 @enderror">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="laboratory_id" class="block text-sm font-medium text-gray-700 mb-2">Laboratorium *</label>
                    <select name="laboratory_id" id="laboratory_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('laboratory_id') border-red-300 @enderror">
                        <option value="">Pilih Laboratorium</option>
                        @foreach($laboratories as $lab)
                            <option value="{{ $lab->id }}" {{ old('laboratory_id') == $lab->id ? 'selected' : '' }}>
                                {{ $lab->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('laboratory_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                    <select name="category" id="category" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category') border-red-300 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="komputer" {{ old('category') === 'komputer' ? 'selected' : '' }}>Komputer</option>
                        <option value="software" {{ old('category') === 'software' ? 'selected' : '' }}>Software</option>
                        <option value="elektronik" {{ old('category') === 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="optik" {{ old('category') === 'optik' ? 'selected' : '' }}>Optik</option>
                        <option value="mekanik" {{ old('category') === 'mekanik' ? 'selected' : '' }}>Mekanik</option>
                        <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Jumlah *</label>
                    <input type="number" 
                           name="quantity" 
                           id="quantity"
                           value="{{ old('quantity', 1) }}"
                           min="1"
                           required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('quantity') border-red-300 @enderror">
                    @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" 
                          id="description"
                          rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Technical Details -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Teknis</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand/Merk</label>
                        <input type="text" 
                               name="brand" 
                               id="brand"
                               value="{{ old('brand') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('brand') border-red-300 @enderror">
                        @error('brand')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                        <input type="text" 
                               name="model" 
                               id="model"
                               value="{{ old('model') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('model') border-red-300 @enderror">
                        @error('model')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="purchase_year" class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembelian</label>
                        <input type="number" 
                               name="purchase_year" 
                               id="purchase_year"
                               value="{{ old('purchase_year') }}"
                               min="1900"
                               max="{{ date('Y') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('purchase_year') border-red-300 @enderror">
                        @error('purchase_year')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Pembelian (Rp)</label>
                        <input type="number" 
                               name="purchase_price" 
                               id="purchase_price"
                               value="{{ old('purchase_price') }}"
                               min="0"
                               step="0.01"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('purchase_price') border-red-300 @enderror">
                        @error('purchase_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status & Condition -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Status & Kondisi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">Kondisi *</label>
                        <select name="condition" id="condition" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('condition') border-red-300 @enderror">
                            <option value="">Pilih Kondisi</option>
                            <option value="excellent" {{ old('condition') === 'excellent' ? 'selected' : '' }}>Excellent</option>
                            <option value="good" {{ old('condition') === 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ old('condition') === 'fair' ? 'selected' : '' }}>Fair</option>
                            <option value="poor" {{ old('condition') === 'poor' ? 'selected' : '' }}>Poor</option>
                            <option value="damaged" {{ old('condition') === 'damaged' ? 'selected' : '' }}>Damaged</option>
                        </select>
                        @error('condition')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-300 @enderror">
                            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="retired" {{ old('status') === 'retired' ? 'selected' : '' }}>Retired</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Calibration -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Kalibrasi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="last_calibration" class="block text-sm font-medium text-gray-700 mb-2">Kalibrasi Terakhir</label>
                        <input type="date" 
                               name="last_calibration" 
                               id="last_calibration"
                               value="{{ old('last_calibration') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('last_calibration') border-red-300 @enderror">
                        @error('last_calibration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="next_calibration" class="block text-sm font-medium text-gray-700 mb-2">Kalibrasi Berikutnya</label>
                        <input type="date" 
                               name="next_calibration" 
                               id="next_calibration"
                               value="{{ old('next_calibration') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('next_calibration') border-red-300 @enderror">
                        @error('next_calibration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Gambar Alat</h3>
                
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar</label>
                    <input type="file" 
                           name="images[]" 
                           id="images"
                           multiple
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('images.*') border-red-300 @enderror">
                    <p class="text-sm text-gray-500 mt-1">Pilih satu atau lebih gambar (JPG, PNG, GIF, max 2MB per file)</p>
                    @error('images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Notes -->
            <div class="border-t pt-6">
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                    <textarea name="notes" 
                              id="notes"
                              rows="3"
                              placeholder="Catatan khusus, instruksi penggunaan, dll."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-300 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="border-t pt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.equipment.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Alat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 