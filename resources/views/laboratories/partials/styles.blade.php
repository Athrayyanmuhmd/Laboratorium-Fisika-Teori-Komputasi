<style>
    * {
        transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                   color 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                   border-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                   box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
        letter-spacing: -0.01em;
        overflow-x: hidden; /* Prevent horizontal scroll */
    }
    
    /* Mobile-First Responsive Base Styles */
    .glassmorphism {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background: rgba(30, 41, 59, 0.05);
        border: 1px solid rgba(30, 41, 59, 0.1);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Enhanced Mobile Navigation Styles */
    .navbar-glassmorphism {
        background: rgba(30, 41, 59, 0.85) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        box-shadow: 
            0 10px 40px rgba(30, 41, 59, 0.3),
            0 0 0 1px rgba(71, 85, 105, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    /* Mobile-Optimized Logo */
    .navbar-logo {
        height: 32px;
        width: 32px;
        object-fit: contain;
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .navbar-logo {
            height: 28px;
            width: 28px;
        }
    }

    /* Enhanced Mobile Menu Button */
    .mobile-menu-button-enhanced {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        padding: 12px !important;
        border-radius: 12px !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        -webkit-tap-highlight-color: transparent;
        user-select: none;
    }

    .mobile-menu-button-enhanced:hover,
    .mobile-menu-button-enhanced:active {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        transform: scale(1.05);
        box-shadow: 
            0 8px 25px rgba(30, 41, 59, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    /* Touch-Friendly Mobile Menu */
    .mobile-menu-enhanced {
        background: rgba(30, 41, 59, 0.95) !important;
        backdrop-filter: blur(25px) !important;
        -webkit-backdrop-filter: blur(25px) !important;
        border-top: 1px solid rgba(71, 85, 105, 0.3) !important;
        box-shadow: 
            0 -20px 40px rgba(30, 41, 59, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
        transform: translateY(-100%);
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .mobile-menu-enhanced.active {
        transform: translateY(0);
    }

    /* Enhanced Mobile Menu Animation */
    .mobile-menu-slide {
        animation: slideDown 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .nav-link-enhanced {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: rgba(255, 255, 255, 0.9) !important;
        position: relative;
        overflow: hidden;
        white-space: nowrap !important;
        display: inline-block !important;
        text-overflow: ellipsis !important;
        min-width: fit-content !important;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    .nav-link-enhanced:hover,
    .nav-link-enhanced:active {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: rgba(255, 255, 255, 1) !important;
        transform: translateY(-2px);
        box-shadow: 
            0 8px 25px rgba(30, 41, 59, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    /* Mobile-Specific Navigation Spacing */
    @media (max-width: 768px) {
        .nav-link-enhanced {
            padding: 16px 20px !important;
            margin-bottom: 8px;
            font-size: 16px !important;
            width: 100%;
            text-align: left;
        }

        .mobile-menu-enhanced .px-3 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .mobile-menu-enhanced .space-y-2 > * + * {
            margin-top: 8px !important;
        }
    }
    
    /* Enhanced Touch-Friendly Buttons */
    .btn-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
        min-height: 44px; /* iOS touch target minimum */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-hover:hover,
    .btn-hover:active {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Mobile-Optimized Active States */
    @media (max-width: 768px) {
        .btn-hover:active {
            transform: translateY(0) scale(0.98);
            transition: transform 0.1s ease;
        }
    }
    
    .card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }
    
    .card-hover:hover {
        transform: translateY(-8px) scale(1.02);
    }

    /* Mobile Card Optimizations */
    @media (max-width: 768px) {
        .card-hover {
            margin-bottom: 1.5rem;
        }
        
        .card-hover:hover,
        .card-hover:active {
            transform: translateY(-4px) scale(1.01);
        }
    }

    /* Enhanced Mobile Dark Mode Toggle */
    .mobile-dark-toggle {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
        padding: 16px 20px !important;
        margin-top: 8px;
        border-radius: 12px !important;
    }

    .mobile-dark-toggle:hover,
    .mobile-dark-toggle:active {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        transform: scale(1.02);
    }

    /* Responsive Typography */
    @media (max-width: 768px) {
        .text-4xl { font-size: 2.25rem !important; }
        .text-5xl { font-size: 2.5rem !important; }
        .text-6xl { font-size: 3rem !important; }
        .text-7xl { font-size: 3.5rem !important; }
        
        .px-6 { padding-left: 1rem !important; padding-right: 1rem !important; }
        .px-8 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
        .py-20 { padding-top: 5rem !important; padding-bottom: 5rem !important; }
        .py-16 { padding-top: 4rem !important; padding-bottom: 4rem !important; }
    }

    /* Mobile Gesture Support */
    .swipe-container {
        touch-action: pan-y;
        overscroll-behavior-x: none;
    }

    /* Smooth Scroll for Mobile */
    html {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    /* Mobile Pull-to-Refresh Prevention */
    body {
        overscroll-behavior-y: contain;
    }

    /* Enhanced Mobile Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.8s ease forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease forwards;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s ease forwards;
    }

    /* Mobile Intersection Observer Animations */
    .mobile-animate {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Mobile-Optimized Form Elements */
    @media (max-width: 768px) {
        input, textarea, select {
            font-size: 16px !important; /* Prevent zoom on iOS */
            padding: 12px 16px !important;
            min-height: 44px !important;
        }
        
        button {
            min-height: 44px !important;
            padding: 12px 24px !important;
        }
    }

    /* Mobile Safe Areas (iPhone X+ support) */
    @supports (padding: max(0px)) {
        .mobile-safe-top {
            padding-top: max(env(safe-area-inset-top), 1rem);
        }
        
        .mobile-safe-bottom {
            padding-bottom: max(env(safe-area-inset-bottom), 1rem);
        }
        
        .mobile-safe-left {
            padding-left: max(env(safe-area-inset-left), 1rem);
        }
        
        .mobile-safe-right {
            padding-right: max(env(safe-area-inset-right), 1rem);
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {
        .glassmorphism {
            background: rgba(30, 41, 59, 0.95);
            border: 2px solid rgba(30, 41, 59, 0.8);
        }
        
        .nav-link-enhanced {
            background: rgba(255, 255, 255, 0.2) !important;
            border: 2px solid rgba(255, 255, 255, 0.4) !important;
        }
    }
</style> 