<!-- Enhanced Mobile-First Hero Section / Beranda -->
<section id="beranda" class="pt-16 md:pt-20 bg-slate-50 min-h-screen flex items-center luxury-bg section-fade-bottom-gray relative overflow-hidden mobile-safe-top">
    <!-- Advanced Background Effects -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Physics Background Image with Mobile Optimization -->
        <div class="absolute inset-0 opacity-20 md:opacity-30">
            <img src="{{ asset('images/WhatsApp Image 2025-06-17 at 18.12.15.jpeg') }}" 
                 alt="Physics Background" 
                 class="w-full h-full object-cover object-center filter blur-sm"
                 loading="lazy">
            <div class="physics-bg-overlay"></div>
        </div>
        
        <!-- Mobile-Optimized Background Elements -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-gradient-to-r from-slate-600/10 to-slate-700/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 md:w-80 md:h-80 bg-gradient-to-r from-slate-500/8 to-slate-600/8 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Particles Container (Hidden on Small Mobile for Performance) -->
    <div class="particles-container hidden sm:block" id="particles"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative z-20">
        <div class="text-center">
            <!-- Enhanced Mobile-First Main Title -->
            <div class="relative mb-6 md:mb-8 hero-title-container mobile-animate">
                <h1 class="relative text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl reveal-luxury hero-title-enhanced text-center">
                    <div class="simple-title leading-tight mb-2 md:mb-0">Laboratorium</div>
                    <div class="simple-title leading-tight">Fisika Teori dan Komputasi</div>
                </h1>
            </div>
            
            <!-- Mobile-Optimized Subtitle -->
            <div class="relative mb-8 md:mb-12 mobile-animate">
                <p class="text-lg xs:text-xl md:text-2xl lg:text-3xl text-slate-600 font-bold mb-6 md:mb-8 px-2 md:px-4 py-2 leading-tight" style="font-family: 'Montserrat', sans-serif; letter-spacing: 0.02em;">
                    Computational Physics Research Center
                </p>
            </div>
            
            <!-- Enhanced Mobile Description -->
            <div class="relative mb-12 md:mb-20 mobile-animate">
                <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed description-enhanced px-4 md:px-6 py-2 md:py-4">
                    <span class="highlight-text">Pusat unggulan</span> untuk penelitian dan pengembangan 
                    <span class="highlight-text">fisika komputasi</span>, simulasi numerik, dan pemodelan matematis 
                    dengan teknologi <span class="highlight-text">high-performance computing</span> terdepan.
                </p>
            </div>
            
            <!-- Enhanced Mobile-First CTA Buttons -->
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6 justify-center mb-12 md:mb-20 reveal-luxury px-4 md:px-0">
                <!-- Primary CTA with Enhanced Touch Feedback -->
                <a href="/layanan" class="btn-magnetic btn-luxury text-white px-8 py-4 md:px-10 md:py-5 rounded-2xl font-bold text-base md:text-lg inline-flex items-center justify-center w-full sm:w-auto shadow-2xl card-hover group transition-all duration-300">
                    <div class="btn-icon-container mr-3 transition-transform duration-300 group-hover:scale-110">
                        <i class="fas fa-rocket icon-luxury text-lg md:text-xl"></i>
                    </div>
                    <span class="font-semibold">Explore Services</span>
                    <div class="ml-3 arrow-animation transition-transform duration-300 group-hover:translate-x-1">→</div>
                </a>
                
                <!-- Secondary CTA with Glass Effect -->
                <a href="/kontak" class="btn-magnetic glass-luxury border border-slate-200 text-slate-800 px-8 py-4 md:px-10 md:py-5 rounded-2xl font-bold text-base md:text-lg btn-hover inline-flex items-center justify-center w-full sm:w-auto shadow-2xl card-hover group transition-all duration-300">
                    <div class="btn-icon-container mr-3 transition-transform duration-300 group-hover:scale-110">
                        <i class="fas fa-envelope icon-luxury text-lg md:text-xl"></i>
                    </div>
                    <span class="font-semibold">Contact Us</span>
                    <div class="ml-3 arrow-animation transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</div>
                </a>
            </div>
            
            <!-- Mobile Stats Cards (New Addition) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 max-w-4xl mx-auto px-4 md:px-0 mobile-animate">
                <div class="stats-card-mobile glassmorphism p-4 md:p-6 rounded-xl text-center card-hover">
                    <div class="text-2xl md:text-3xl font-bold text-navy mb-2">15+</div>
                    <div class="text-xs md:text-sm text-gray-600 font-medium">Research Areas</div>
                </div>
                <div class="stats-card-mobile glassmorphism p-4 md:p-6 rounded-xl text-center card-hover">
                    <div class="text-2xl md:text-3xl font-bold text-navy mb-2">50+</div>
                    <div class="text-xs md:text-sm text-gray-600 font-medium">Publications</div>
                </div>
                <div class="stats-card-mobile glassmorphism p-4 md:p-6 rounded-xl text-center card-hover">
                    <div class="text-2xl md:text-3xl font-bold text-navy mb-2">100+</div>
                    <div class="text-xs md:text-sm text-gray-600 font-medium">Students</div>
                </div>
                <div class="stats-card-mobile glassmorphism p-4 md:p-6 rounded-xl text-center card-hover">
                    <div class="text-2xl md:text-3xl font-bold text-navy mb-2">24/7</div>
                    <div class="text-xs md:text-sm text-gray-600 font-medium">HPC Access</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Scroll Indicator -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 md:bottom-8 animate-bounce">
        <div class="w-6 h-10 border-2 border-slate-400 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-slate-400 rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Additional Mobile-Specific Styles -->
<style>
    /* Enhanced Mobile Hero Animations */
    .mobile-animate {
        opacity: 0;
        transform: translateY(30px);
        animation: mobileSlideUp 0.8s ease-forwards;
    }
    
    .mobile-animate:nth-child(1) { animation-delay: 0.2s; }
    .mobile-animate:nth-child(2) { animation-delay: 0.4s; }
    .mobile-animate:nth-child(3) { animation-delay: 0.6s; }
    .mobile-animate:nth-child(4) { animation-delay: 0.8s; }
    
    /* Mobile Stats Cards */
    .stats-card-mobile {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }
    
    @media (max-width: 768px) {
        .stats-card-mobile:active {
            transform: scale(0.95);
        }
        
        /* Improved text legibility on mobile */
        .simple-title {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .highlight-text {
            padding: 2px 4px;
            border-radius: 4px;
            background: rgba(30, 41, 59, 0.1);
        }
        
        /* Enhanced button styling for mobile */
        .btn-luxury, .glass-luxury {
            min-height: 52px;
            font-weight: 600;
            letter-spacing: 0.025em;
        }
        
        /* Better touch targets */
        .card-hover {
            min-height: 44px;
            min-width: 44px;
        }
    }
    
    /* iOS-specific optimizations */
    @supports (-webkit-touch-callout: none) {
        .hero-title-enhanced {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    }
</style> 