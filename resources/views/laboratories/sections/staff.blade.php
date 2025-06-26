<!-- Staff & Tenaga Ahli Section -->
<section id="staf" class="py-20 bg-gradient-to-br from-slate-50 via-white to-slate-50 relative">
    <!-- Refined Background decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-16 right-16 w-40 h-40 bg-slate-200/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-16 left-16 w-48 h-48 bg-slate-300/15 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 left-1/4 w-32 h-32 bg-slate-100/30 rounded-full blur-2xl"></div>
        <div class="absolute bottom-1/3 right-1/4 w-28 h-28 bg-slate-200/25 rounded-full blur-2xl"></div>
    </div>

    <div class="max-w-full mx-auto px-12 md:px-16 lg:px-20 xl:px-24 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">
                <span class="bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
                    Staff dan Tenaga Ahli
                </span>
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                Tim ahli berpengalaman di bidang fisika komputasi dan teknologi canggih
            </p>
            
            <!-- Navigation arrows -->
            <div id="navigationButtons" class="flex gap-3 justify-center mt-8">
                <button id="prevBtn" class="w-12 h-12 bg-slate-800 hover:bg-slate-900 text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="nextBtn" class="w-12 h-12 bg-slate-800 hover:bg-slate-900 text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <!-- Staff Grid - Auto-centered Horizontal Scrolling -->
        <div class="relative overflow-hidden">
            <div id="staffContainer" class="flex gap-6 overflow-x-auto scroll-smooth py-8 justify-center" style="scrollbar-width: none; -ms-overflow-style: none;">
            @forelse ($pengurus as $staff)
                            <!-- Regular staff cards - Full photo with hover overlay -->
                            <div class="flex-shrink-0 w-72 h-96 bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 group relative">
                                    <!-- Full photo background -->
                                    <div class="relative w-full h-full overflow-hidden">
                            @if($staff->gambar && $staff->gambar->first())
                                            <img src="{{ asset('storage/' . $staff->gambar->first()->url) }}" 
                                                 alt="{{ $staff->nama }}" 
                                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        @endif
                                        <div class="w-full h-full bg-gradient-to-br from-slate-600 via-slate-700 to-slate-800 flex items-center justify-center {{ $staff->gambar && $staff->gambar->first() ? 'hidden' : '' }}">
                                            <div class="text-center">
                                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto">
                                                    {{ $staff->initials ?? substr($staff->nama, 0, 2) }}
                                                </div>
                                            </div>
                                </div>
                                        
                                        <!-- Slate overlay that appears on hover with info -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700/95 to-slate-800/95 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center p-6 text-white">
                                            <!-- Background pattern -->
                                            <div class="absolute inset-0 opacity-10">
                                                <div class="absolute top-4 right-4 w-24 h-24 border border-white/20 rounded-full"></div>
                                                <div class="absolute bottom-4 left-4 w-16 h-16 border border-white/20 rounded-full"></div>
                        </div>
                                            
                                            <!-- Content -->
                                            <div class="relative z-10 text-center">
                                                <h3 class="text-xl font-bold mb-4">{{ $staff->nama_singkat ?? $staff->nama }}</h3>
                                                <p class="text-slate-200 font-medium text-lg">{{ $staff->jabatan }}</p>
                                            </div>
                                        </div>
                    </div>
                            </div>
                @empty
                        <!-- Placeholder cards when no staff data -->
                        
                        <!-- Regular staff cards -->
                        @for ($i = 0; $i < 3; $i++)
                            <div class="flex-shrink-0 w-72 h-96 bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 group relative">
                                    <!-- Full photo background -->
                                    <div class="relative w-full h-full overflow-hidden">
                                        <div class="w-full h-full bg-gradient-to-br from-slate-500 via-slate-600 to-slate-700 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto">
                                                    {{ chr(65 + $i) }}{{ chr(66 + $i) }}
                                                </div>
                    </div>
                </div>
                                        
                                        <!-- Slate overlay that appears on hover with info -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700/95 to-slate-800/95 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center p-6 text-white">
                                            <!-- Background pattern -->
                                            <div class="absolute inset-0 opacity-10">
                                                <div class="absolute top-4 right-4 w-24 h-24 border border-white/20 rounded-full"></div>
                                                <div class="absolute bottom-4 left-4 w-16 h-16 border border-white/20 rounded-full"></div>
                            </div>
                                            
                                            <!-- Content -->
                                            <div class="relative z-10 text-center">
                                                <h3 class="text-xl font-bold mb-4">
                                                    @if($i === 0) Carter Botosh
                                                    @elseif($i === 1) Philip Ekstrom
                                                    @else Abram Culhane
                                                    @endif
                                                </h3>
                                                <p class="text-slate-200 font-medium text-lg">
                                                    @if($i === 0) Chief Financial Officer
                                                    @elseif($i === 1) Head of Technology
                                                    @else Head of Technology
                                                    @endif
                                                </p>
                        </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
            </div>
        </div>
    </div>
</section> 

<style>
/* Hide scrollbar */
#staffContainer::-webkit-scrollbar {
    display: none;
}

/* Smooth scrolling */
#staffContainer {
    scroll-behavior: smooth;
}

/* Auto-center when few cards */
#staffContainer {
    min-width: 100%;
}

/* Card hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

/* Responsive centering adjustments */
@media (max-width: 768px) {
    #staffContainer {
        justify-content: flex-start;
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

@media (min-width: 769px) {
    #staffContainer {
        padding-left: 2rem;
        padding-right: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('staffContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const navigationButtons = document.getElementById('navigationButtons');
    
    if (container && prevBtn && nextBtn) {
        const cardWidth = 320; // Width of card + gap (288px + 24px gap)
        
        // Function to check if scrolling is needed
        function checkScrollNeed() {
            const containerWidth = container.clientWidth;
            const contentWidth = container.scrollWidth;
            const needsScroll = contentWidth > containerWidth;
            
            // Show/hide navigation buttons based on scroll need
            if (needsScroll) {
                navigationButtons.style.display = 'flex';
            } else {
                navigationButtons.style.display = 'none';
                // Ensure content is centered when no scroll needed
                container.style.justifyContent = 'center';
            }
            
            return needsScroll;
        }
        
        // Function to center content when cards fit in container
        function centerContent() {
            const containerWidth = container.clientWidth;
            const contentWidth = container.scrollWidth;
            
            if (contentWidth <= containerWidth) {
                container.style.justifyContent = 'center';
                container.scrollLeft = 0;
            } else {
                container.style.justifyContent = 'flex-start';
            }
        }
        
        prevBtn.addEventListener('click', function() {
            const currentScroll = container.scrollLeft;
            const newScroll = Math.max(0, currentScroll - cardWidth);
            
            container.scrollTo({
                left: newScroll,
                behavior: 'smooth'
            });
        });
        
        nextBtn.addEventListener('click', function() {
            const currentScroll = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            const newScroll = Math.min(maxScroll, currentScroll + cardWidth);
            
            container.scrollTo({
                left: newScroll,
                behavior: 'smooth'
            });
        });
        
        // Update button states based on scroll position
        function updateButtons() {
            if (!checkScrollNeed()) return;
            
            const scrollLeft = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            // Update button opacity and cursor
            if (scrollLeft <= 5) {
                prevBtn.style.opacity = '0.5';
                prevBtn.style.cursor = 'not-allowed';
            } else {
                prevBtn.style.opacity = '1';
                prevBtn.style.cursor = 'pointer';
            }
            
            if (scrollLeft >= maxScroll - 5) {
                nextBtn.style.opacity = '0.5';
                nextBtn.style.cursor = 'not-allowed';
            } else {
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }
        }
        
        // Handle window resize
        function handleResize() {
            centerContent();
            checkScrollNeed();
            updateButtons();
        }
        
        // Event listeners
        container.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', handleResize);
        
        // Initialize
        setTimeout(() => {
            centerContent();
            checkScrollNeed();
            updateButtons();
        }, 100);
    }
});
</script>