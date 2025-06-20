<!-- Mobile Toast Notifications -->
<div id="mobile-toast-container" class="fixed top-4 left-4 right-4 z-50 pointer-events-none">
    <!-- Toast messages will appear here -->
</div>

<!-- Mobile Bottom Navigation -->
<nav id="mobile-bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40 transform translate-y-full transition-transform duration-300 lg:hidden">
    <div class="flex justify-around items-center py-2">
        <a href="#hero" class="mobile-nav-item flex flex-col items-center p-2 text-gray-600">
            <i class="fas fa-home text-lg mb-1"></i>
            <span class="text-xs">Home</span>
        </a>
        <a href="#layanan" class="mobile-nav-item flex flex-col items-center p-2 text-gray-600">
            <i class="fas fa-rocket text-lg mb-1"></i>
            <span class="text-xs">Services</span>
        </a>
        <a href="#fasilitas" class="mobile-nav-item flex flex-col items-center p-2 text-gray-600">
            <i class="fas fa-flask text-lg mb-1"></i>
            <span class="text-xs">Labs</span>
        </a>
        <a href="#kontak" class="mobile-nav-item flex flex-col items-center p-2 text-gray-600">
            <i class="fas fa-envelope text-lg mb-1"></i>
            <span class="text-xs">Contact</span>
        </a>
    </div>
</nav>

<!-- Comprehensive Mobile CSS Fixes -->
<style>
    /* CRITICAL MOBILE FIXES - Override existing styles */
    @media (max-width: 768px) {
        /* Force proper mobile viewport */
        html {
            width: 100% !important;
            overflow-x: hidden !important;
            -webkit-text-size-adjust: 100% !important;
        }
        
        body {
            width: 100% !important;
            overflow-x: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
            min-width: 100% !important;
            -webkit-overflow-scrolling: touch !important;
        }
        
        /* Fix main containers */
        .max-w-7xl, .max-w-6xl, .max-w-5xl, .max-w-4xl {
            max-width: 100% !important;
            width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        /* NAVBAR MOBILE FIXES */
        #navbar {
            width: 100% !important;
            left: 0 !important;
            right: 0 !important;
            padding: 0 !important;
        }
        
        #navbar .max-w-7xl {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 1rem !important;
        }
        
        #navbar .flex {
            width: 100% !important;
            justify-content: space-between !important;
            align-items: center !important;
        }
        
        .navbar-logo-container {
            flex-shrink: 0 !important;
        }
        
        .navbar-logo {
            height: 2.5rem !important;
            width: auto !important;
        }
        
        #mobile-menu-button {
            margin-left: auto !important;
        }
        
        /* MOBILE MENU FIXES */
        #mobile-menu {
            width: 100% !important;
            left: 0 !important;
            right: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        #mobile-menu .px-3 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        #mobile-menu a {
            width: 100% !important;
            display: block !important;
            text-align: left !important;
        }
        
        /* HERO SECTION MOBILE FIXES */
        .hero {
            min-height: 100vh !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .hero .container,
        .hero .max-w-7xl {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 1rem !important;
            margin: 0 !important;
        }
        
        .hero-content {
            width: 100% !important;
            padding: 2rem 1rem !important;
            text-align: center !important;
        }
        
        .hero h1 {
            font-size: 2.5rem !important;
            line-height: 1.2 !important;
            margin-bottom: 1rem !important;
            text-align: center !important;
        }
        
        .hero p {
            font-size: 1.125rem !important;
            text-align: center !important;
            margin-bottom: 2rem !important;
        }
        
        /* GRID LAYOUT FIXES */
        .grid {
            width: 100% !important;
            padding: 0 1rem !important;
        }
        
        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem !important;
        }
        
        .grid-cols-3,
        .grid-cols-4 {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem !important;
        }
        
        @media (max-width: 480px) {
            .grid-cols-2,
            .grid-cols-3,
            .grid-cols-4 {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
        }
        
        /* SECTION SPACING FIXES */
        section {
            width: 100% !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        .py-20 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
        
        .py-16 {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }
        
        .px-4, .px-6, .px-8 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        /* CARD LAYOUT FIXES */
        .card-hover,
        .glass-luxury,
        .glassmorphism {
            width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 1.5rem !important;
        }
        
        /* FOOTER MOBILE FIXES */
        .footer,
        footer {
            width: 100% !important;
            margin: 0 !important;
            padding: 2rem 1rem !important;
        }
        
        .footer-content,
        .footer-main {
            width: 100% !important;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
        }
        
        .footer-links {
            flex-direction: column !important;
            gap: 1rem !important;
            margin-top: 1rem !important;
            width: 100% !important;
        }
        
        .footer-link {
            display: block !important;
            width: 100% !important;
            text-align: center !important;
            padding: 0.5rem !important;
        }
        
        .footer-brand {
            margin-bottom: 1rem !important;
        }
        
        .footer-logo {
            height: 2rem !important;
            width: auto !important;
        }
        
        /* RESPONSIVE TEXT SIZES */
        .text-7xl {
            font-size: 3rem !important;
        }
        
        .text-6xl {
            font-size: 2.5rem !important;
        }
        
        .text-5xl {
            font-size: 2rem !important;
        }
        
        .text-4xl {
            font-size: 1.75rem !important;
        }
        
        .text-3xl {
            font-size: 1.5rem !important;
        }
        
        .text-2xl {
            font-size: 1.25rem !important;
        }
        
        /* BUTTON FIXES */
        .btn-hover,
        .glass-luxury,
        button {
            min-height: 44px !important;
            width: auto !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 1rem !important;
        }
        
        /* FORM ELEMENTS */
        input, select, textarea {
            font-size: 16px !important; /* Prevent iOS zoom */
            width: 100% !important;
            min-height: 44px !important;
        }
        
        /* STATS CARDS FIX */
        .stats-card-mobile {
            min-height: 80px !important;
            padding: 1rem !important;
        }
        
        /* PHYSICS ICONS FIX */
        .physics-icon-container {
            justify-content: center !important;
            margin: 1rem 0 !important;
        }
        
        /* CONTACT SECTION FIX */
        .contact-info {
            flex-direction: column !important;
            gap: 1rem !important;
        }
        
        /* HIDE SCROLLBARS BUT KEEP FUNCTIONALITY */
        ::-webkit-scrollbar {
            width: 0px !important;
            background: transparent !important;
        }
        
        /* PREVENT HORIZONTAL OVERFLOW */
        * {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        
        img {
            max-width: 100% !important;
            height: auto !important;
        }
        
        /* TOUCH IMPROVEMENTS */
        button, a, input, select, textarea {
            min-height: 44px !important;
            min-width: 44px !important;
            touch-action: manipulation !important;
            -webkit-tap-highlight-color: transparent !important;
        }
        
        /* BETTER ACTIVE STATES */
        .card-hover:active {
            transform: scale(0.98) !important;
            transition: transform 0.1s ease !important;
        }
        
        .btn-hover:active {
            transform: scale(0.95) !important;
            transition: transform 0.1s ease !important;
        }
        
        /* FORCE FULL WIDTH FOR ALL CONTAINERS */
        .container,
        .mx-auto {
            width: 100% !important;
            max-width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }
    
    /* Extra small screens */
    @media (max-width: 480px) {
        .hero h1 {
            font-size: 2rem !important;
        }
        
        .text-5xl {
            font-size: 1.75rem !important;
        }
        
        .text-4xl {
            font-size: 1.5rem !important;
        }
        
        .px-4, .px-6, .px-8 {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        
        section {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
    }
    
    /* Mobile navigation styling */
    .mobile-nav-item {
        transition: all 0.2s ease;
        border-radius: 8px;
        min-height: 44px;
        min-width: 44px;
    }
    
    .mobile-nav-item:active,
    .mobile-nav-item.active {
        color: #1e293b;
        background: rgba(30, 41, 59, 0.1);
    }
    
    /* Mobile toast styling */
    .mobile-toast {
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        transform: translateY(-100%);
        transition: transform 0.3s ease;
        margin-bottom: 8px;
    }
    
    .mobile-toast.show {
        transform: translateY(0);
    }
    
    .mobile-toast.success {
        background: rgba(16, 185, 129, 0.9);
    }
    
    .mobile-toast.error {
        background: rgba(239, 68, 68, 0.9);
    }
</style>

<!-- Mobile JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
        initMobileFeatures();
        fixMobileLayout();
    }
    
    function initMobileFeatures() {
        // Show bottom navigation after load
        const bottomNav = document.getElementById('mobile-bottom-nav');
        setTimeout(() => {
            bottomNav.style.transform = 'translateY(0)';
        }, 1000);
        
        // Auto-hide navigation on scroll
        let lastScrollY = window.scrollY;
        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > lastScrollY && currentScrollY > 100) {
                bottomNav.style.transform = 'translateY(100%)';
            } else if (currentScrollY < lastScrollY) {
                bottomNav.style.transform = 'translateY(0)';
            }
            
            lastScrollY = currentScrollY;
        }, { passive: true });
        
        // Navigation click handlers
        document.querySelectorAll('.mobile-nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active from all
                document.querySelectorAll('.mobile-nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });
                
                // Add active to clicked
                this.classList.add('active');
                
                // Smooth scroll
                const targetId = this.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Mobile toast function
        window.showMobileToast = function(message, type = 'default', duration = 3000) {
            const container = document.getElementById('mobile-toast-container');
            const toast = document.createElement('div');
            toast.className = `mobile-toast ${type}`;
            toast.innerHTML = `<span>${message}</span>`;
            
            container.appendChild(toast);
            
            setTimeout(() => toast.classList.add('show'), 100);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (container.contains(toast)) {
                        container.removeChild(toast);
                    }
                }, 300);
            }, duration);
        };
        
        // Welcome message
        if (!localStorage.getItem('mobileWelcome')) {
            setTimeout(() => {
                showMobileToast('Welcome to our mobile site! 📱', 'default', 3000);
                localStorage.setItem('mobileWelcome', 'true');
            }, 2000);
        }
    }
    
    function fixMobileLayout() {
        // Force proper viewport setup
        let viewport = document.querySelector('meta[name="viewport"]');
        if (!viewport) {
            viewport = document.createElement('meta');
            viewport.name = 'viewport';
            document.head.appendChild(viewport);
        }
        viewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover';
        
        // Add mobile body class
        document.body.classList.add('mobile-optimized');
        
        // Fix any remaining layout issues
        setTimeout(() => {
            // Force reflow to fix layout
            document.body.style.display = 'none';
            document.body.offsetHeight; // Trigger reflow
            document.body.style.display = '';
        }, 100);
        
        // Handle mobile menu properly
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                const isHidden = mobileMenu.classList.contains('hidden');
                
                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
            
            // Close menu when clicking menu links
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });
        }
    }
    
    // Handle orientation changes
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            // Force repaint to fix layout issues
            document.body.style.display = 'none';
            document.body.offsetHeight;
            document.body.style.display = '';
            
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }, 300);
    });
});
</script>

<!-- ADDITIONAL MOBILE LAYOUT FIXES -->
<style>
    /* FORCE MOBILE LAYOUT FIXES - Highest Priority */
    @media (max-width: 768px) {
        /* CRITICAL: Fix container alignment issues */
        .max-w-7xl, .max-w-6xl, .max-w-5xl, .max-w-4xl, .max-w-3xl, .container {
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        /* NAVBAR: Force center alignment */
        #navbar > div {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
        }
        
        /* HERO: Fix alignment and width */
        .hero {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        .hero-content {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            width: 100% !important;
        }
        
        /* SECTIONS: Force proper alignment */
        section {
            display: block !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        
        section > div {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        
        /* FOOTER: Fix alignment */
        .footer {
            display: block !important;
            width: 100% !important;
            text-align: center !important;
        }
        
        .footer-main {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        .footer-links {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 1rem !important;
            width: 100% !important;
        }
        
        /* GRID: Force mobile-friendly grids */
        .grid {
            display: grid !important;
            width: 100% !important;
            margin: 0 auto !important;
        }
        
        /* CARDS: Ensure proper width and centering */
        .card-hover, .glass-luxury, .glassmorphism {
            width: 100% !important;
            margin: 0 auto 1.5rem auto !important;
            display: block !important;
        }
        
        /* TEXT: Force center alignment for headers */
        h1, h2, h3 {
            text-align: center !important;
        }
        
        /* BUTTONS: Center alignment */
        .btn-hover, .glass-luxury {
            display: inline-block !important;
            margin: 0 auto !important;
        }
        
        /* STATS CARDS: Force equal distribution */
        .stats-card-mobile {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        /* PHYSICS ICONS: Center alignment */
        .physics-icon-container {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            margin: 1rem auto !important;
        }
    }
    
    /* EXTRA SMALL SCREENS */
    @media (max-width: 480px) {
        .hero h1 {
            font-size: 2rem !important;
        }
        
        .px-4, .px-6, .px-8 {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
                 }
     }
</style>

<!-- FINAL MOBILE LAYOUT ENFORCEMENT -->
<script>
// Force mobile layout fixes after DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth <= 768) {
        console.log('🔧 Applying final mobile layout fixes...');
        
        // Force all containers to be properly centered
        const containers = document.querySelectorAll('.max-w-7xl, .max-w-6xl, .max-w-5xl, .max-w-4xl, .container');
        containers.forEach(container => {
            container.style.marginLeft = 'auto';
            container.style.marginRight = 'auto';
            container.style.paddingLeft = '1rem';
            container.style.paddingRight = '1rem';
            container.style.width = '100%';
            container.style.maxWidth = '100%';
        });
        
        // Fix navbar alignment
        const navbar = document.getElementById('navbar');
        if (navbar) {
            const navContainer = navbar.querySelector('div');
            if (navContainer) {
                navContainer.style.display = 'flex';
                navContainer.style.justifyContent = 'space-between';
                navContainer.style.alignItems = 'center';
                navContainer.style.width = '100%';
            }
        }
        
        // Fix hero section
        const hero = document.querySelector('.hero');
        if (hero) {
            hero.style.display = 'flex';
            hero.style.alignItems = 'center';
            hero.style.justifyContent = 'center';
            hero.style.textAlign = 'center';
            
            const heroContent = hero.querySelector('.hero-content');
            if (heroContent) {
                heroContent.style.display = 'flex';
                heroContent.style.flexDirection = 'column';
                heroContent.style.alignItems = 'center';
                heroContent.style.justifyContent = 'center';
                heroContent.style.textAlign = 'center';
                heroContent.style.width = '100%';
            }
        }
        
        // Fix all sections
        const sections = document.querySelectorAll('section');
        sections.forEach(section => {
            section.style.width = '100%';
            section.style.paddingLeft = '1rem';
            section.style.paddingRight = '1rem';
            section.style.marginLeft = '0';
            section.style.marginRight = '0';
            section.style.boxSizing = 'border-box';
            
            const sectionChildren = section.children;
            Array.from(sectionChildren).forEach(child => {
                if (child.classList.contains('max-w-7xl') || 
                    child.classList.contains('max-w-6xl') || 
                    child.classList.contains('max-w-5xl') || 
                    child.classList.contains('container')) {
                    child.style.marginLeft = 'auto';
                    child.style.marginRight = 'auto';
                    child.style.width = '100%';
                }
            });
        });
        
        // Fix footer
        const footer = document.querySelector('.footer');
        if (footer) {
            footer.style.width = '100%';
            footer.style.textAlign = 'center';
            
            const footerMain = footer.querySelector('.footer-main');
            if (footerMain) {
                footerMain.style.display = 'flex';
                footerMain.style.flexDirection = 'column';
                footerMain.style.alignItems = 'center';
                footerMain.style.justifyContent = 'center';
                footerMain.style.textAlign = 'center';
            }
            
            const footerLinks = footer.querySelector('.footer-links');
            if (footerLinks) {
                footerLinks.style.display = 'flex';
                footerLinks.style.flexDirection = 'column';
                footerLinks.style.alignItems = 'center';
                footerLinks.style.gap = '1rem';
                footerLinks.style.width = '100%';
            }
        }
        
        // Fix grids
        const grids = document.querySelectorAll('.grid');
        grids.forEach(grid => {
            grid.style.width = '100%';
            grid.style.margin = '0 auto';
        });
        
        // Fix cards
        const cards = document.querySelectorAll('.card-hover, .glass-luxury, .glassmorphism');
        cards.forEach(card => {
            card.style.width = '100%';
            card.style.margin = '0 auto 1.5rem auto';
            card.style.display = 'block';
        });
        
        // Show success message
        setTimeout(() => {
            if (window.showMobileToast) {
                showMobileToast('Mobile layout fixed! 📱✅', 'success', 2000);
            }
        }, 1000);
        
        console.log('✅ Mobile layout fixes completed');
    }
});
</script>

<!-- COMPREHENSIVE DARK MODE STYLING -->
<style>
    /* DARK MODE FOUNDATION */
    .dark {
        color-scheme: dark;
    }
    
    .dark body {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%) !important;
        color: #e2e8f0 !important;
    }
    
    /* NAVBAR DARK MODE */
    .dark #navbar {
        background: rgba(15, 23, 42, 0.95) !important;
        border-bottom: 1px solid rgba(51, 65, 85, 0.3) !important;
        backdrop-filter: blur(25px) !important;
    }
    
    .dark .navbar-logo {
        filter: brightness(1.2) contrast(1.1) !important;
    }
    
    .dark .nav-link-enhanced {
        color: #e2e8f0 !important;
        background: rgba(51, 65, 85, 0.15) !important;
        border: 1px solid rgba(71, 85, 105, 0.3) !important;
    }
    
    .dark .nav-link-enhanced:hover {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        color: #f1f5f9 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2) !important;
    }
    
    .dark .navbar-dark-toggle {
        background: rgba(51, 65, 85, 0.2) !important;
        border: 1px solid rgba(71, 85, 105, 0.3) !important;
        color: #fbbf24 !important;
    }
    
    .dark .navbar-dark-toggle:hover {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        color: #fcd34d !important;
    }
    
    /* MOBILE MENU DARK MODE */
    .dark #mobile-menu {
        background: rgba(15, 23, 42, 0.98) !important;
        border-top: 1px solid rgba(51, 65, 85, 0.4) !important;
        backdrop-filter: blur(30px) !important;
        box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5) !important;
    }
    
    .dark #mobile-menu a {
        color: #e2e8f0 !important;
        background: rgba(51, 65, 85, 0.15) !important;
        border: 1px solid rgba(71, 85, 105, 0.3) !important;
    }
    
    .dark #mobile-menu a:hover,
    .dark #mobile-menu a:active {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        color: #f1f5f9 !important;
        transform: translateX(5px) !important;
    }
    
    .dark .mobile-dark-toggle {
        background: rgba(51, 65, 85, 0.2) !important;
        border: 1px solid rgba(71, 85, 105, 0.3) !important;
        color: #e2e8f0 !important;
    }
    
    .dark .mobile-dark-toggle:hover {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        color: #fcd34d !important;
    }
    
    /* HERO SECTION DARK MODE */
    .dark .hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%) !important;
    }
    
    .dark .hero::before {
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid-dark" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%2364748b" stroke-width="0.5" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23grid-dark)"/></svg>') !important;
    }
    
    .dark .hero h1 {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
    }
    
    .dark .hero p {
        color: #cbd5e1 !important;
    }
    
    .dark .hero-badge {
        background: rgba(51, 65, 85, 0.3) !important;
        border: 1px solid rgba(71, 85, 105, 0.4) !important;
        color: #e2e8f0 !important;
    }
    
    .dark .hero-badge:hover {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3) !important;
    }
    
    /* CARDS DARK MODE */
    .dark .card-hover,
    .dark .glass-luxury,
    .dark .glassmorphism {
        background: rgba(30, 41, 59, 0.8) !important;
        border: 1px solid rgba(51, 65, 85, 0.4) !important;
        backdrop-filter: blur(20px) !important;
        color: #e2e8f0 !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
    }
    
    .dark .card-hover:hover {
        background: rgba(30, 41, 59, 0.95) !important;
        border-color: rgba(59, 130, 246, 0.5) !important;
        transform: translateY(-8px) scale(1.02) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 20px rgba(59, 130, 246, 0.2) !important;
    }
    
    .dark .stats-card-mobile {
        background: rgba(30, 41, 59, 0.8) !important;
        border: 1px solid rgba(51, 65, 85, 0.4) !important;
        color: #e2e8f0 !important;
    }
    
    .dark .stats-card-mobile:hover {
        background: rgba(30, 41, 59, 0.9) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2) !important;
    }
    
    /* BUTTONS DARK MODE */
    .dark .btn-hover {
        background: linear-gradient(135deg, #334155 0%, #475569 100%) !important;
        border: 1px solid rgba(71, 85, 105, 0.5) !important;
        color: #f1f5f9 !important;
        box-shadow: 0 4px 15px rgba(51, 65, 85, 0.3) !important;
    }
    
    .dark .btn-hover:hover {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
        border-color: rgba(59, 130, 246, 0.6) !important;
        transform: translateY(-3px) scale(1.05) !important;
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3) !important;
    }
    
    .dark .btn-hover:active {
        transform: translateY(-1px) scale(1.02) !important;
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%) !important;
    }
    
    /* SECTIONS DARK MODE */
    .dark section {
        background: rgba(15, 23, 42, 0.5) !important;
        color: #e2e8f0 !important;
        border-radius: 16px !important;
        margin: 2rem 0 !important;
        backdrop-filter: blur(10px) !important;
    }
    
    .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
        color: #f8fafc !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
    }
    
    .dark p, .dark span, .dark div {
        color: #cbd5e1 !important;
    }
    
    /* FOOTER DARK MODE */
    .dark .footer {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
        border-top: 1px solid rgba(51, 65, 85, 0.4) !important;
    }
    
    .dark .footer::before {
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="footer-grid-dark" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%2364748b" stroke-width="0.3" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23footer-grid-dark)"/></svg>') !important;
    }
    
    .dark .footer-logo {
        filter: brightness(1.3) contrast(1.1) !important;
    }
    
    .dark .footer-link {
        color: #cbd5e1 !important;
        border: 1px solid rgba(51, 65, 85, 0.3) !important;
        background: rgba(30, 41, 59, 0.4) !important;
    }
    
    .dark .footer-link:hover {
        color: #f1f5f9 !important;
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3) !important;
    }
    
    .dark .footer-copyright {
        color: #94a3b8 !important;
    }
    
    /* MOBILE NAVIGATION DARK MODE */
    .dark #mobile-bottom-nav {
        background: rgba(15, 23, 42, 0.95) !important;
        border-top: 1px solid rgba(51, 65, 85, 0.5) !important;
        backdrop-filter: blur(25px) !important;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.4) !important;
    }
    
    .dark .mobile-nav-item {
        color: #cbd5e1 !important;
        transition: all 0.3s ease !important;
    }
    
    .dark .mobile-nav-item:active,
    .dark .mobile-nav-item.active {
        color: #f1f5f9 !important;
        background: rgba(59, 130, 246, 0.2) !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
    }
    
    .dark .mobile-nav-item:hover {
        background: rgba(51, 65, 85, 0.3) !important;
        color: #e2e8f0 !important;
        border-radius: 8px !important;
    }
    
    /* MOBILE TOAST DARK MODE */
    .dark .mobile-toast {
        background: rgba(30, 41, 59, 0.95) !important;
        color: #e2e8f0 !important;
        border: 1px solid rgba(51, 65, 85, 0.4) !important;
        backdrop-filter: blur(20px) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4) !important;
    }
    
    .dark .mobile-toast.success {
        background: rgba(16, 185, 129, 0.15) !important;
        color: #10b981 !important;
        border-color: rgba(16, 185, 129, 0.4) !important;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2) !important;
    }
    
    .dark .mobile-toast.error {
        background: rgba(239, 68, 68, 0.15) !important;
        color: #ef4444 !important;
        border-color: rgba(239, 68, 68, 0.4) !important;
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2) !important;
    }
    
    .dark .mobile-toast.warning {
        background: rgba(245, 158, 11, 0.15) !important;
        color: #f59e0b !important;
        border-color: rgba(245, 158, 11, 0.4) !important;
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2) !important;
    }
    
    /* FORMS DARK MODE */
    .dark input,
    .dark select,
    .dark textarea {
        background: rgba(30, 41, 59, 0.8) !important;
        border: 1px solid rgba(51, 65, 85, 0.5) !important;
        color: #e2e8f0 !important;
    }
    
    .dark input:focus,
    .dark select:focus,
    .dark textarea:focus {
        background: rgba(30, 41, 59, 0.95) !important;
        border-color: rgba(59, 130, 246, 0.6) !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
    }
    
    .dark input::placeholder,
    .dark textarea::placeholder {
        color: #94a3b8 !important;
    }
    
    /* PHYSICS ICONS DARK MODE */
    .dark .physics-icon-container {
        background: rgba(30, 41, 59, 0.7) !important;
        border: 1px solid rgba(51, 65, 85, 0.4) !important;
        color: #e2e8f0 !important;
    }
    
    .dark .physics-icon-container:hover {
        background: rgba(59, 130, 246, 0.2) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3) !important;
    }
    
    /* MOBILE SPECIFIC DARK MODE */
    @media (max-width: 768px) {
        .dark body {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #334155 100%) !important;
        }
        
        .dark .hero {
            background: linear-gradient(180deg, #1e293b 0%, #334155 100%) !important;
        }
        
        .dark section {
            background: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid rgba(51, 65, 85, 0.3) !important;
            margin: 1rem 0 !important;
            border-radius: 12px !important;
        }
        
        .dark .card-hover:active {
            transform: scale(0.98) !important;
            background: rgba(30, 41, 59, 0.95) !important;
            border-color: rgba(59, 130, 246, 0.6) !important;
        }
        
        .dark .btn-hover:active {
            transform: scale(0.95) !important;
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%) !important;
        }
        
        .dark .glassmorphism {
            border: 2px solid rgba(51, 65, 85, 0.5) !important;
            background: rgba(30, 41, 59, 0.9) !important;
        }
        
        .dark .glass-luxury {
            border: 2px solid rgba(59, 130, 246, 0.4) !important;
            background: linear-gradient(135deg, #334155 0%, #475569 100%) !important;
        }
    }
    
    /* DARK MODE TRANSITIONS */
    .dark * {
        transition: background-color 0.4s ease, border-color 0.4s ease, color 0.4s ease, box-shadow 0.4s ease !important;
    }
    
    /* ACCESSIBILITY DARK MODE */
    .dark [role="button"]:focus,
    .dark button:focus,
    .dark a:focus {
        outline: 2px solid #3b82f6 !important;
        outline-offset: 2px !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2) !important;
    }
    
    /* HIGH CONTRAST DARK MODE */
    @media (prefers-contrast: high) {
        .dark .card-hover,
        .dark .glass-luxury,
        .dark .glassmorphism {
            border: 3px solid #94a3b8 !important;
            background: rgba(15, 23, 42, 0.98) !important;
        }
        
        .dark .btn-hover {
            border: 3px solid #e2e8f0 !important;
            background: #1e40af !important;
        }
        
        .dark h1, .dark h2, .dark h3 {
            color: #ffffff !important;
        }
        
        .dark p, .dark span {
            color: #f1f5f9 !important;
        }
    }
</style>