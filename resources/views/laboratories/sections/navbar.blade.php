<!-- Enhanced Glassmorphism Navigation -->
<nav id="navbar" class="fixed w-full z-50 top-0 bg-black/30 backdrop-blur-lg border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo - Left -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo-fisika-putih.png') }}" 
                         alt="Lab Fisika Komputasi" 
                         class="h-12 w-auto object-contain">
                </a>
            </div>
            
            <!-- Navigation Menu - Center -->
            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
                <div class="flex items-center space-x-2">
                    <a href="#beranda" class="px-4 py-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-sm font-medium">Beranda</a>
                    <a href="#staf" class="px-4 py-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-sm font-medium">Staf Ahli</a>
                    <a href="#layanan" class="px-4 py-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-sm font-medium">Layanan</a>
                    <a href="#fasilitas" class="px-4 py-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-sm font-medium">Fasilitas</a>
                    <a href="#artikel" class="px-4 py-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-sm font-medium">Artikel</a>
                </div>
            </div>
            
            <!-- Placeholder for Right Side (maintain layout) -->
            <div class="hidden md:flex flex-shrink-0">
                <!-- Button removed but container preserved for layout balance -->
            </div>
            
            <!-- Mobile menu button - Right -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="p-2 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-black/40 backdrop-blur-lg border-t border-white/10">
            <div class="px-4 py-4 space-y-2">
                <a href="#beranda" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-base font-medium">Beranda</a>
                <a href="#staf" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-base font-medium">Staf Ahli</a>
                <a href="#layanan" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-base font-medium">Layanan</a>
                <a href="#fasilitas" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-base font-medium">Fasilitas</a>
                <a href="#artikel" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-base font-medium">Artikel</a>
            </div>
        </div>
    </div>
</nav> 

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking on a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }
});
</script> 