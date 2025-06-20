<!-- Enhanced Glassmorphism Navigation -->
<nav id="navbar" class="fixed w-full z-50 top-0 navbar-glassmorphism nav-glass-reflection">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 navbar-border-glow">
            <!-- Logo - Left -->
            <div class="flex-shrink-0">
                <a href="/" class="navbar-logo-container">
                    <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Lab Fisika Komputasi" class="navbar-logo">
                </a>
            </div>
            
            <!-- Navigation Menu - Center (shifted left) -->
            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 -translate-x-8">
                <div class="flex items-center space-x-6">
                    <a href="#beranda" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Beranda</a>
                    <a href="#staf" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Staf Ahli</a>
                    <a href="#layanan" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Layanan</a>
                    <a href="#fasilitas" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Fasilitas</a>
                    <a href="#kontak" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Kontak</a>
                </div>
            </div>
            
            <!-- Dark Mode Toggle - Right -->
            <div class="hidden md:flex flex-shrink-0">
                <button id="darkModeToggle" class="navbar-dark-toggle px-4 py-2.5 rounded-xl text-white border border-white/20 hover:bg-white/10 transition-all duration-300" onclick="toggleDarkMode()" title="Toggle Dark Mode">
                    <i class="fas fa-moon text-base" id="darkModeIcon"></i>
                </button>
            </div>
            
            <!-- Mobile menu button - Right (only visible on mobile) -->
            <div class="md:hidden flex justify-end">
                <button id="mobile-menu-button" class="mobile-menu-button-enhanced text-white">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
        
        <!-- Enhanced Mobile menu -->
        <div id="mobile-menu" class="md:hidden mobile-menu-enhanced mobile-menu-slide">
            <div class="px-3 pt-3 pb-4 space-y-2">
                <a href="#beranda" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Beranda</a>
                <a href="#staf" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Staf Ahli</a>
                <a href="#layanan" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Layanan</a>
                <a href="#fasilitas" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Fasilitas</a>
                <a href="#kontak" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Kontak</a>
                
                <!-- Dark Mode Toggle for Mobile -->
                <button class="mobile-dark-toggle flex items-center px-4 py-3 rounded-xl text-base font-semibold text-white hover:bg-white/10 transition-all duration-300 w-full" onclick="toggleDarkMode()">
                    <i class="fas fa-moon mr-3"></i>
                    <span>Dark Mode</span>
                </button>
            </div>
        </div>
    </div>
</nav> 