<!-- Artikel Section -->
<section id="artikel" class="py-20 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">Artikel Terbaru</h2>
            <p class="text-slate-600 text-lg max-w-2xl mx-auto leading-relaxed">
                Eksplorasi penelitian, publikasi ilmiah, dan kegiatan terbaru dari Laboratorium Fisika Komputasi
            </p>
        </div>
        
        <!-- Article Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Article Card 1 -->
            <div class="wrap animate pop">
                <div class="overlay">
                    <div class="overlay-content animate slide-left delay-2">
                        <h1 class="animate slide-left pop delay-4">Penelitian</h1>
                        <p class="animate slide-left pop delay-5" style="color: white; margin-bottom: 2.5rem;">Kategori: <em>Komputasi</em></p>
                    </div>
                    <div class="image-content animate slide delay-5" style="background-image: url('{{ asset('images/contoh-dummy.jpg') }}');"></div>
                    <div class="dots animate">
                        <div class="dot animate slide-up delay-6"></div>
                        <div class="dot animate slide-up delay-7"></div>
                        <div class="dot animate slide-up delay-8"></div>
                    </div>
                </div>
                <div class="text">
                    <p>Penelitian terbaru dalam bidang fisika komputasi yang dilakukan di laboratorium kami. Studi ini fokus pada simulasi numerik untuk memahami fenomena fisika kompleks.</p>
                    <p>Metodologi yang digunakan melibatkan algoritma komputasi canggih dan analisis data yang mendalam untuk menghasilkan hasil yang akurat dan dapat diandalkan.</p>
                    <p>Penelitian ini membuka jalan untuk pengembangan teknologi baru dalam bidang fisika terapan.</p>
                </div>
            </div>

            <!-- Article Card 2 -->
            <div class="wrap animate pop">
                <div class="overlay">
                    <div class="overlay-content animate slide-left delay-2">
                        <h1 class="animate slide-left pop delay-4">Publikasi</h1>
                        <p class="animate slide-left pop delay-5" style="color: white; margin-bottom: 2.5rem;">Kategori: <em>Jurnal</em></p>
                    </div>
                    <div class="image-content animate slide delay-5" style="background-image: url('{{ asset('images/contoh-dummy.jpg') }}');"></div>
                    <div class="dots animate">
                        <div class="dot animate slide-up delay-6"></div>
                        <div class="dot animate slide-up delay-7"></div>
                        <div class="dot animate slide-up delay-8"></div>
                    </div>
                </div>
                <div class="text">
                    <p class="article-desc" style="color: #1E293B; background:rgba(255,255,255,0.85); padding:0.75rem 1rem; border-left:4px solid #3B82F6; margin-bottom: 1rem; font-size:1.05rem; box-shadow:0 2px 8px rgba(30,41,59,0.06);">Publikasi ilmiah terbaru yang telah diterbitkan dalam jurnal internasional bereputasi tinggi. Artikel ini membahas temuan penting dalam bidang fisika komputasi.<br><br>Penelitian ini melibatkan kolaborasi dengan berbagai institusi pendidikan dan penelitian di dalam dan luar negeri.<br><br>Hasil penelitian ini memberikan kontribusi signifikan terhadap pengembangan ilmu pengetahuan dan teknologi.</p>
                    <a href="#" class="baca-selengkapnya-btn animate slide-up delay-6">Selengkapnya</a>
                </div>
            </div>

            <!-- Article Card 3 -->
            <div class="wrap animate pop">
                <div class="overlay">
                    <div class="overlay-content animate slide-left delay-2">
                        <h1 class="animate slide-left pop delay-4">Kegiatan</h1>
                        <p class="animate slide-left pop delay-5" style="color: white; margin-bottom: 2.5rem;">Kategori: <em>Event</em></p>
                    </div>
                    <div class="image-content animate slide delay-5" style="background-image: url('{{ asset('images/contoh-dummy.jpg') }}');"></div>
                    <div class="dots animate">
                        <div class="dot animate slide-up delay-6"></div>
                        <div class="dot animate slide-up delay-7"></div>
                        <div class="dot animate slide-up delay-8"></div>
                    </div>
                </div>
                <div class="text">
                    <p class="article-desc" style="color: #1E293B; background:rgba(255,255,255,0.85); padding:0.75rem 1rem; border-left:4px solid #3B82F6; margin-bottom: 1rem; font-size:1.05rem; box-shadow:0 2px 8px rgba(30,41,59,0.06);">Publikasi ilmiah terbaru yang telah diterbitkan dalam jurnal internasional bereputasi tinggi. Artikel ini membahas temuan penting dalam bidang fisika komputasi.<br><br>Penelitian ini melibatkan kolaborasi dengan berbagai institusi pendidikan dan penelitian di dalam dan luar negeri.<br><br>Hasil penelitian ini memberikan kontribusi signifikan terhadap pengembangan ilmu pengetahuan dan teknologi.</p>
                    <a href="#" class="baca-selengkapnya-btn animate slide-up delay-6">Selengkapnya</a>
                </div>
            </div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-16">
            <button class="view-all-btn">
                <span>Lihat Semua Artikel</span>
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.wrap {
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-between;
    width: 100%;
    height: 400px;
    margin: 0 auto;
    border: 6px solid;
    border-image: linear-gradient(
            -50deg,
            #1e293b,
            #334155,
            #475569,
            #1e293b,
            #64748b,
            #334155,
            #1e293b
        )
        1;
    transition: 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
    background: #fff;
    border-radius: 0;
}

.overlay {
    position: relative;
    display: flex;
    width: 100%;
    height: 100%;
    padding: 1rem 0.75rem;
    background: #1e293b;
    transition: 0.4s ease-in-out;
    z-index: 1;
    border-radius: 0;
}

.overlay-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 25%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 0.5rem 0 0 0.5rem;
    border: 3px solid;
    border-image: linear-gradient(
            to bottom,
            #3b82f6 5%,
            #1e293b 35% 65%,
            #3b82f6 95%
        )
        0 0 0 100%;
    transition: none;
    z-index: 3;
    background: rgba(34,48,74,0.95);
}

.overlay-content h1 {
    font-size: 1.5rem;
    text-align: center;
    color: white;
}

.overlay-content p {
    font-size: 0.875rem;
    line-height: 1.4;
    color: white;
    margin-bottom: 1.5rem;
}

.image-content {
    position: absolute;
    top: 0;
    right: 0;
    width: 75%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: 0.3s ease-in-out;
    border-radius: 0;
}

.dots {
    position: absolute;
    bottom: 1rem;
    right: 2rem;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    width: 50px;
    height: 20px;
    transition: 0.3s ease-in-out 0.3s;
}

.dot {
    width: 0.75rem;
    height: 0.75rem;
    background: #3b82f6;
    border: 1px solid #1e293b;
    border-radius: 50%;
    transition: 0.3s ease-in-out 0.3s;
}

.text {
    display: grid;
    position: absolute;
    top: 0;
    right: 0;
    width: 75%;
    height: 100%;
    padding: 1.5rem;
    background: rgba(255,255,255,0.92);
    border-radius: 0;
    box-shadow: none;
    overflow-y: scroll;
}

.text p, .article-desc {
    font-size: 0.97rem;
    line-height: 1.5;
    color: #1e293b;
    margin-bottom: 0.85rem;
    background: none;
    border-left: 3px solid #3B82F6;
    padding-left: 0.75rem;
    box-shadow: none;
}

.wrap:hover .overlay {
    transform: translateX(-75%);
}

.wrap:hover .image-content {
    width: 25%;
}

.wrap:hover .overlay-content {
    border: none;
    transition-delay: 0s;
    transform: none;
    z-index: 3;
    opacity: 1;
    left: 0;
}

.wrap:hover .dots {
    transform: translateX(1rem);
}

.wrap:hover .dots .dot {
    background: white;
}

/* Animations and timing delays */
.animate {
    animation-duration: 0.7s;
    animation-timing-function: cubic-bezier(0.26, 0.53, 0.74, 1.48);
    animation-fill-mode: backwards;
}

/* Pop In */
.pop {
    animation-name: pop;
}

@keyframes pop {
    0% {
        opacity: 0;
        transform: scale(0.5, 0.5);
    }
    100% {
        opacity: 1;
        transform: scale(1, 1);
    }
}

/* Slide In */
.slide {
    animation-name: slide;
}

@keyframes slide {
    0% {
        opacity: 0;
        transform: translate(4em, 0);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0);
    }
}

/* Slide Left */
.slide-left {
    animation-name: slide-left;
}

@keyframes slide-left {
    0% {
        opacity: 0;
        transform: translate(-40px, 0);
    }
    100% {
        opacity: 1;
        transform: translate(0, 0);
    }
}

.slide-up {
    animation-name: slide-up;
}

@keyframes slide-up {
    0% {
        opacity: 0;
        transform: translateY(3em);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.delay-1 {
    animation-delay: 0.3s;
}

.delay-2 {
    animation-delay: 0.6s;
}

.delay-3 {
    animation-delay: 0.9s;
}

.delay-4 {
    animation-delay: 1.2s;
}

.delay-5 {
    animation-delay: 1.5s;
}

.delay-6 {
    animation-delay: 1.8s;
}

.delay-7 {
    animation-delay: 2.1s;
}

.delay-8 {
    animation-delay: 2.4s;
}

/* View All Button */
.view-all-btn {
    background: linear-gradient(135deg, #1e293b, #334155);
    color: white;
    padding: 16px 32px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    border: none;
    cursor: pointer;
    border-radius: 0;
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #334155, #475569);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(30, 41, 59, 0.3);
}

.view-all-btn i {
    transition: transform 0.3s ease;
}

.view-all-btn:hover i {
    transform: translateX(4px);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .wrap {
        height: 350px;
    }
    
    .overlay-content h1 {
        font-size: 1.25rem;
    }
    
    .overlay-content p {
        font-size: 0.75rem;
    }
    
    .text p {
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }
    
    .wrap {
        height: 400px;
        margin: 1rem auto;
    }
    
    .overlay-content {
        width: 30%;
    }
    
    .image-content {
        width: 70%;
    }
    
    .text {
        width: 70%;
    }
    
    .wrap:hover .overlay {
        transform: translateX(-70%);
    }
    
    .wrap:hover .image-content {
        width: 30%;
    }
    
    .wrap:hover .overlay-content {
        transform: translateX(70%);
    }
}

/* --- Ubah tombol menjadi link --- */
.baca-selengkapnya-btn {
    display: inline;
    background: none;
    color: #2563eb;
    padding: 0;
    border: none;
    font-weight: 600;
    font-size: 0.97rem;
    margin-bottom: 1.2rem;
    cursor: pointer;
    text-decoration: underline;
    transition: color 0.2s;
    box-shadow: none;
    border-radius: 0;
    letter-spacing: 0.2px;
}
.baca-selengkapnya-btn:hover {
    color: #1e293b;
    background: none;
    box-shadow: none;
}
</style> 