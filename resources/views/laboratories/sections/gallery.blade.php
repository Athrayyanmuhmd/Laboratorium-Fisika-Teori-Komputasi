<!-- Galeri Laboratorium Section -->
<section id="galeri" class="py-12 relative overflow-hidden min-h-screen flex flex-col justify-center" style="background-image: url('/images/background_admin_gedung_fmipa.jpeg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <!-- Dark overlay for readability -->
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Galeri Laboratorium
            </h2>
            <p class="text-gray-300 text-lg max-w-3xl mx-auto leading-relaxed">
                Dokumentasi fasilitas dan aktivitas di Lab Fisika Teori dan Komputasi dengan 28 PC workstations
            </p>
        </div>
        
        <!-- Gallery Container -->
        <div class="gallery-container">
            <div class="card" onclick="openLightbox('/images/contoh.jpeg', 'Laboratorium Komputer', 'Fasilitas komputer modern dengan 28 workstations untuk pembelajaran dan penelitian')">
                <img src="/images/contoh.jpeg" alt="Laboratorium Komputer">
                <div class="card__head">Laboratorium Komputer</div>
                </div>

            <div class="card" onclick="openLightbox('/images/contoh.jpeg', 'Ruang Kerja Mahasiswa', 'Area kerja kolaboratif untuk mahasiswa mengerjakan proyek dan tugas')">
                <img src="/images/contoh.jpeg" alt="Ruang Kerja Mahasiswa">
                <div class="card__head">Ruang Kerja Mahasiswa</div>
                </div>

            <div class="card" onclick="openLightbox('/images/contoh.jpeg', 'Peralatan Laboratorium', 'Peralatan dan infrastruktur teknologi terdepan untuk penelitian')">
                <img src="/images/contoh.jpeg" alt="Peralatan Laboratorium">
                <div class="card__head">Peralatan Laboratorium</div>
                </div>

            <div class="card" onclick="openLightbox('/images/contoh.jpeg', 'Aktivitas Penelitian', 'Kegiatan penelitian dan eksperimen mahasiswa dalam bidang fisika komputasi')">
                <img src="/images/contoh.jpeg" alt="Aktivitas Penelitian">
                <div class="card__head">Aktivitas Penelitian</div>
                </div>

            <div class="card" onclick="openLightbox('/images/contoh.jpeg', 'Software Development', 'Area pengembangan software dan aplikasi untuk simulasi fisika')">
                <img src="/images/contoh.jpeg" alt="Software Development">
                <div class="card__head">Software Development</div>
                    </div>
                </div>
        </div>

    <!-- Enhanced Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="max-w-6xl max-h-full relative animate-fade-in">
            <!-- Close Button -->
            <button onclick="closeLightbox()" 
                    class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition-colors duration-300 bg-white/10 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center border border-white/20">
                    <i class="fas fa-times"></i>
                </button>
            
            <!-- Image Container -->
            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
                
                <!-- Info Overlay -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white p-6">
                    <h3 id="lightbox-title" class="text-2xl font-bold mb-2"></h3>
                    <p id="lightbox-description" class="text-gray-200 text-lg"></p>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button onclick="prevImage()" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 transition-colors duration-300 bg-white/10 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center border border-white/20">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button onclick="nextImage()" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 transition-colors duration-300 bg-white/10 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center border border-white/20">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
/* Gallery Styling */
.gallery-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10vmin;
    overflow: hidden;
    transform: skew(5deg);
}

.gallery-container .card {
    flex: 1;
    transition: all 1s ease-in-out;
    height: 75vmin;
    position: relative;
    cursor: pointer;
}

.gallery-container .card .card__head {
    color: white;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    padding: 0.5em;
    transform: rotate(-90deg);
    transform-origin: 0% 0%;
    transition: all 0.5s ease-in-out;
    min-width: 100%;
    text-align: center;
    position: absolute;
    bottom: 0;
    left: 0;
    font-size: 1em;
    white-space: nowrap;
    border-radius: 8px;
}

.gallery-container .card:hover {
    flex-grow: 10;
}

.gallery-container .card:hover img {
    filter: grayscale(0);
}

.gallery-container .card:hover .card__head {
    text-align: center;
    top: calc(100% - 2em);
    color: white;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
    font-size: 2em;
    transform: rotate(0deg) skew(-5deg);
    border-radius: 12px;
}

.gallery-container .card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 1s ease-in-out;
    filter: grayscale(100%);
}

.gallery-container .card:not(:nth-child(5)) {
    margin-right: 1em;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-container {
        flex-direction: column;
        transform: none;
        margin: 5vmin;
    }
    
    .gallery-container .card {
        height: 30vmin;
        width: 100%;
        margin-bottom: 1em;
        margin-right: 0 !important;
    }
    
    .gallery-container .card .card__head {
        transform: none;
        position: relative;
        bottom: auto;
        left: auto;
        font-size: 1.2em;
        min-width: auto;
    }
    
    .gallery-container .card:hover .card__head {
        transform: none;
        top: auto;
        font-size: 1.2em;
    }
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* Close modal when clicking outside */
#lightbox {
    backdrop-filter: blur(10px);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
</style>

<script>
let currentImageIndex = 0;
const images = [
    { src: '/images/contoh.jpeg', title: 'Laboratorium Komputer', desc: 'Fasilitas komputer modern dengan 28 workstations untuk pembelajaran dan penelitian' },
    { src: '/images/contoh.jpeg', title: 'Ruang Kerja Mahasiswa', desc: 'Area kerja kolaboratif untuk mahasiswa mengerjakan proyek dan tugas' },
    { src: '/images/contoh.jpeg', title: 'Peralatan Laboratorium', desc: 'Peralatan dan infrastruktur teknologi terdepan untuk penelitian' },
    { src: '/images/contoh.jpeg', title: 'Aktivitas Penelitian', desc: 'Kegiatan penelitian dan eksperimen mahasiswa dalam bidang fisika komputasi' },
    { src: '/images/contoh.jpeg', title: 'Software Development', desc: 'Area pengembangan software dan aplikasi untuk simulasi fisika' }
];

function openLightbox(src, title, description) {
    currentImageIndex = images.findIndex(img => img.src === src);
    document.getElementById('lightbox-image').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-description').textContent = description;
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    const img = images[currentImageIndex];
    document.getElementById('lightbox-image').src = img.src;
    document.getElementById('lightbox-title').textContent = img.title;
    document.getElementById('lightbox-description').textContent = img.desc;
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    const img = images[currentImageIndex];
    document.getElementById('lightbox-image').src = img.src;
    document.getElementById('lightbox-title').textContent = img.title;
    document.getElementById('lightbox-description').textContent = img.desc;
}

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightbox').classList.contains('flex')) {
    if (e.key === 'Escape') {
        closeLightbox();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        }
    }
});
</script>