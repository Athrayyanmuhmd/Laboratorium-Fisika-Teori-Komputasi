@extends('layouts.admin')

@section('title', 'Manajemen Staff')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Pengurus Laboratorium</h1>
                <p class="text-gray-600">Kelola informasi staff laboratorium</p>
            </div>
            <button onclick="openCreateModal()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                <i class="fas fa-plus mr-2"></i>Tambah Staff
            </button>
        </div>
    </div>

    <!-- Staff Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pengurus as $item)
            <div class="bg-white shadow-lg overflow-hidden">
                <!-- Photo -->
                @if($item->gambar && $item->gambar->first())
                    <img src="{{ asset('storage/' . $item->gambar->first()->url) }}" 
                         alt="{{ $item->nama }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                        {{ $item->initials }}
                    </div>
                @endif

                <!-- Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $item->nama_singkat }}</h3>
                    <p class="text-blue-600 font-semibold mb-3">{{ $item->jabatan }}</p>
                    
                    @if($item->email)
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-envelope mr-2"></i>{{ $item->email }}
                        </p>
                    @endif
                    
                    <!-- Status -->
                    <div class="flex gap-2 mb-4">
                        @if($item->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Aktif</span>
                        @endif
                        @if($item->show_on_website)
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Website</span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <button onclick="openDetailModal(this)" 
                                class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-jabatan="{{ $item->jabatan }}"
                                data-email="{{ $item->email ?? '' }}"
                                data-phone="{{ $item->phone ?? '' }}"
                                data-bio="{{ $item->bio ?? '' }}">
                            Detail
                        </button>
                        
                        <button onclick="openEditModal(this)" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-jabatan="{{ $item->jabatan }}"
                                data-email="{{ $item->email ?? '' }}"
                                data-phone="{{ $item->phone ?? '' }}"
                                data-specialization="{{ $item->specialization ?? '' }}"
                                data-education="{{ $item->education ?? '' }}"
                                data-bio="{{ $item->bio ?? '' }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}"
                                data-show_on_website="{{ $item->show_on_website ? '1' : '0' }}"
                                data-photo="{{ $item->gambar && $item->gambar->first() ? asset('storage/' . $item->gambar->first()->url) : '' }}">
                            Edit
                        </button>
                        
                        <button onclick="confirmDelete('{{ $item->id }}', '{{ addslashes($item->nama) }}')" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <h3 class="text-xl text-gray-600 mb-4">Belum Ada Data Staff</h3>
                <button onclick="openCreateModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    Tambah Staff Pertama
                </button>
            </div>
        @endforelse
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-blue-600 text-white p-6">
                <h3 id="modalTitle" class="text-xl font-bold">Tambah Staff</h3>
            </div>
            
            <form id="staffForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama" id="nama" required 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Jabatan *</label>
                            <input type="text" name="jabatan" id="jabatan" required 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email" 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Telepon</label>
                            <input type="text" name="phone" id="phone" 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Spesialisasi</label>
                            <input type="text" name="specialization" id="specialization" 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Pendidikan</label>
                            <input type="text" name="education" id="education" 
                                   class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Foto Profil</label>
                            <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(this)"
                                   class="w-full px-4 py-3 border">
                            <div id="photoPreview" class="mt-4 hidden">
                                <img id="previewImg" src="" alt="Preview" class="w-32 h-32 object-cover">
                            </div>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Biodata</label>
                            <textarea name="bio" id="bio" rows="3" 
                                      class="w-full px-4 py-3 border focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div class="md:col-span-2">
                            <div class="flex gap-6">
                                <label class="flex items-center">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                                           class="mr-2">
                                    <span class="text-sm">Staff Aktif</span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input type="hidden" name="show_on_website" value="0">
                                    <input type="checkbox" name="show_on_website" id="show_on_website" value="1" checked
                                           class="mr-2">
                                    <span class="text-sm">Tampilkan di Website</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6 pt-6 border-t">
                        <button type="button" onclick="closeModal()" 
                                class="px-6 py-3 bg-gray-600 text-white hover:bg-gray-700">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gray-600 text-white p-6">
                <h3 class="text-xl font-bold">Detail Staff</h3>
            </div>
            
            <div class="p-6">
                <div id="detailContent"></div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeDetailModal()" 
                            class="px-6 py-3 bg-gray-600 text-white hover:bg-gray-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Staff';
    document.getElementById('staffForm').action = '{{ route("admin.laboran.pengurus.store") }}';
    document.getElementById('staffForm').reset();
    
    // Remove method input if exists
    const methodInput = document.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }
    
    document.getElementById('photoPreview').classList.add('hidden');
    document.getElementById('formModal').classList.remove('hidden');
}

function openEditModal(button) {
    const id = button.getAttribute('data-id');
    const nama = button.getAttribute('data-nama');
    const jabatan = button.getAttribute('data-jabatan');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const specialization = button.getAttribute('data-specialization');
    const education = button.getAttribute('data-education');
    const bio = button.getAttribute('data-bio');
    const isActive = button.getAttribute('data-is_active') === '1';
    const showOnWebsite = button.getAttribute('data-show_on_website') === '1';
    const photo = button.getAttribute('data-photo');
    
    document.getElementById('modalTitle').textContent = 'Edit Staff';
    document.getElementById('staffForm').action = `/admin/laboran/pengurus/${id}`;
    
    // Remove existing method input first
    const existingMethodInput = document.querySelector('input[name="_method"]');
    if (existingMethodInput) {
        existingMethodInput.remove();
    }
    
    // Add method spoofing for PUT request
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    document.getElementById('staffForm').appendChild(methodInput);
    
    console.log('Edit modal opened for ID:', id);
    console.log('Form action set to:', document.getElementById('staffForm').action);
    console.log('Method input added:', methodInput);
    
    // Fill form fields
    document.getElementById('nama').value = nama;
    document.getElementById('jabatan').value = jabatan;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('specialization').value = specialization;
    document.getElementById('education').value = education;
    document.getElementById('bio').value = bio;
    document.getElementById('is_active').checked = isActive;
    document.getElementById('show_on_website').checked = showOnWebsite;
    
    // Show current photo if exists
    if (photo) {
        document.getElementById('previewImg').src = photo;
        document.getElementById('photoPreview').classList.remove('hidden');
    } else {
        document.getElementById('photoPreview').classList.add('hidden');
    }
    
    document.getElementById('formModal').classList.remove('hidden');
}

function openDetailModal(button) {
    const nama = button.getAttribute('data-nama');
    const jabatan = button.getAttribute('data-jabatan');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const bio = button.getAttribute('data-bio');
    
    const content = `
        <div class="space-y-4">
            <div>
                <h3 class="text-2xl font-bold">${nama}</h3>
                <p class="text-blue-600 font-medium">${jabatan}</p>
            </div>
            
            ${email ? `<p><strong>Email:</strong> ${email}</p>` : ''}
            ${phone ? `<p><strong>Telepon:</strong> ${phone}</p>` : ''}
            ${bio ? `<p><strong>Biodata:</strong> ${bio}</p>` : ''}
        </div>
    `;
    
    document.getElementById('detailContent').innerHTML = content;
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('formModal').classList.add('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('photoPreview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        document.getElementById('photoPreview').classList.add('hidden');
    }
}

function confirmDelete(id, nama) {
    if (confirm(`Apakah Anda yakin ingin menghapus staff "${nama}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/laboran/pengurus/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.id === 'formModal') {
        closeModal();
    }
    if (e.target.id === 'detailModal') {
        closeDetailModal();
    }
});

// Debug form submission
document.getElementById('staffForm').addEventListener('submit', function(e) {
    const formData = new FormData(this);
    console.log('Form submission data:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    console.log('Form action:', this.action);
    console.log('Form method:', this.method);
});
</script>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
<script>alert('{{ session("success") }}');</script>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
<script>alert('{{ session("error") }}');</script>
@endif

@endsection 