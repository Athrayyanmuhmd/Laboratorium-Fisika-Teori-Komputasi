<!-- Galeri Laboratorium Section -->
<section id="galeri" class="py-16 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8">Galeri Laboratorium</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Dokumentasi fasilitas dan aktivitas di Lab Fisika Teori dan Komputasi dengan 28 PC workstations
            </p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($featuredGallery as $gallery)
                <div class="group cursor-pointer" onclick="openLightbox('{{ Storage::url($gallery->image_path) }}', '{{ $gallery->title }}', '{{ $gallery->description }}')">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        @if($gallery->image_path)
                            <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->title }}" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                                <i class="fas fa-{{ $gallery->icon ?? 'image' }} text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <i class="fas fa-expand-alt text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">{{ $gallery->title }}</h3>
                        <p class="text-gray-600 text-sm">{{ $gallery->description }}</p>
                        @if($gallery->category)
                            <span class="inline-block mt-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                {{ ucfirst($gallery->category) }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Default placeholder gallery items -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-desktop text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">PC Workstation Setup</h3>
                        <p class="text-gray-600 text-sm">Konfigurasi 28 unit PC untuk komputasi dan simulasi</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-code text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Software Development</h3>
                        <p class="text-gray-600 text-sm">Area pengembangan aplikasi dan web design</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Data Analysis Station</h3>
                        <p class="text-gray-600 text-sm">Workstation khusus untuk analisis data geofisika</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-camera text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Digital Photography Lab</h3>
                        <p class="text-gray-600 text-sm">Studio fotografi digital dan editing</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-users text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Collaborative Workspace</h3>
                        <p class="text-gray-600 text-sm">Area kolaborasi untuk project tim</p>
                    </div>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-2xl bg-slate-200 aspect-video shadow-xl group-hover:shadow-2xl transition-all duration-600">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center">
                            <i class="fas fa-server text-white text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Server & Networking</h3>
                        <p class="text-gray-600 text-sm">Infrastruktur jaringan dan server laboratorium</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Lightbox Modal -->
        <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
            <div class="max-w-4xl max-h-full relative">
                <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
                <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white p-4 rounded-b-lg">
                    <h3 id="lightbox-title" class="text-xl font-semibold mb-2"></h3>
                    <p id="lightbox-description" class="text-gray-300"></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function openLightbox(imageSrc, title, description) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');
    
    lightboxImage.src = imageSrc;
    lightboxTitle.textContent = title;
    lightboxDescription.textContent = description;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Close lightbox with escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>