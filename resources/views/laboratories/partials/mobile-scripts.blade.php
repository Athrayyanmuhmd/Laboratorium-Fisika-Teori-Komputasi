<script>
    // Enhanced Mobile Detection & Features
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
    
    // Enhanced Mobile Menu with Touch Gestures & Animations
    class MobileMenuManager {
        constructor() {
            this.mobileMenuButton = document.getElementById('mobile-menu-button');
            this.mobileMenu = document.getElementById('mobile-menu');
            this.isOpen = false;
            this.touchStartY = 0;
            this.touchEndY = 0;
            this.touchStartX = 0;
            this.touchEndX = 0;
            this.init();
        }

        init() {
            if (!this.mobileMenuButton || !this.mobileMenu) return;

            // Enhanced button styles for mobile
            this.mobileMenuButton.style.cssText = `
                background: rgba(255, 255, 255, 0.1) !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
                backdrop-filter: blur(15px) !important;
                border-radius: 12px !important;
                padding: 12px !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                -webkit-tap-highlight-color: transparent !important;
                position: relative !important;
                overflow: hidden !important;
            `;

            // Button click handler with haptic feedback
            this.mobileMenuButton.addEventListener('click', () => {
                this.toggle();
                this.hapticFeedback('light');
            });

            // Touch gestures for menu
            this.setupTouchGestures();

            // Close menu on outside click
            document.addEventListener('click', (e) => {
                if (this.isOpen && !this.mobileMenu.contains(e.target) && !this.mobileMenuButton.contains(e.target)) {
                    this.close();
                }
            });

            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });

            // Handle orientation changes
            window.addEventListener('orientationchange', () => {
                if (this.isOpen) {
                    setTimeout(() => this.close(), 100);
                }
            });
        }

        setupTouchGestures() {
            // Swipe gestures for mobile menu
            this.mobileMenu.addEventListener('touchstart', (e) => {
                this.touchStartY = e.changedTouches[0].screenY;
                this.touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            this.mobileMenu.addEventListener('touchmove', (e) => {
                const currentY = e.changedTouches[0].screenY;
                const diffY = this.touchStartY - currentY;
                
                // Add visual feedback for swipe
                if (diffY > 0) {
                    this.mobileMenu.style.transform = `translateY(-${Math.min(diffY * 0.5, 50)}px)`;
                    this.mobileMenu.style.opacity = Math.max(1 - (diffY / 200), 0.7);
                }
            }, { passive: true });

            this.mobileMenu.addEventListener('touchend', (e) => {
                this.touchEndY = e.changedTouches[0].screenY;
                this.touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
                
                // Reset transform
                this.mobileMenu.style.transform = '';
                this.mobileMenu.style.opacity = '';
            }, { passive: true });
        }

        toggle() {
            this.isOpen ? this.close() : this.open();
        }

        open() {
            this.isOpen = true;
            this.mobileMenu.classList.remove('hidden');
            this.mobileMenu.classList.add('active');
            
            // Prevent background scroll with better iOS support
            if (isIOS) {
                document.body.style.position = 'fixed';
                document.body.style.width = '100%';
                document.body.style.top = `-${window.scrollY}px`;
            } else {
                document.body.style.overflow = 'hidden';
            }
            
            // Enhanced opening animation
            this.mobileMenu.style.cssText += `
                background: rgba(30, 41, 59, 0.98) !important;
                backdrop-filter: blur(30px) !important;
                border-top: 1px solid rgba(71, 85, 105, 0.4) !important;
                box-shadow: 0 -20px 60px rgba(0, 0, 0, 0.6) !important;
            `;
            
            // Animate menu items with stagger
            const menuItems = this.mobileMenu.querySelectorAll('.nav-link-enhanced, .mobile-dark-toggle');
            menuItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-30px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 80 + 100);
            });

            // Add backdrop blur to page content
            const pageContent = document.querySelector('main') || document.body;
            pageContent.style.filter = 'blur(2px)';
            pageContent.style.transition = 'filter 0.3s ease';
        }

        close() {
            this.isOpen = false;
            this.mobileMenu.classList.remove('active');
            
            // Restore scroll with iOS support
            if (isIOS) {
                const scrollY = document.body.style.top;
                document.body.style.position = '';
                document.body.style.width = '';
                document.body.style.top = '';
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            } else {
                document.body.style.overflow = '';
            }
            
            // Remove backdrop blur
            const pageContent = document.querySelector('main') || document.body;
            pageContent.style.filter = '';
            
            setTimeout(() => {
                this.mobileMenu.classList.add('hidden');
            }, 300);
        }

        handleSwipe() {
            const swipeDistanceY = this.touchStartY - this.touchEndY;
            const swipeDistanceX = Math.abs(this.touchStartX - this.touchEndX);
            const minSwipeDistance = 50;

            // Swipe up or right to close
            if ((swipeDistanceY > minSwipeDistance || swipeDistanceX > minSwipeDistance) && this.isOpen) {
                this.close();
                this.hapticFeedback('light');
            }
        }

        hapticFeedback(type = 'light') {
            if (navigator.vibrate) {
                switch(type) {
                    case 'light': navigator.vibrate(50); break;
                    case 'medium': navigator.vibrate(100); break;
                    case 'heavy': navigator.vibrate([100, 50, 100]); break;
                }
            }
        }
    }

    // Enhanced Mobile Navigation with Auto-Hide
    class MobileNavbarManager {
        constructor() {
            this.navbar = document.getElementById('navbar');
            this.lastScrollY = window.scrollY;
            this.isScrollingDown = false;
            this.scrollThreshold = 10;
            this.hideThreshold = 100;
            this.ticking = false;
            this.init();
        }

        init() {
            if (!this.navbar) return;

            // Enhanced navbar styles for mobile
            this.navbar.style.cssText += `
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                will-change: transform, background-color !important;
            `;

            window.addEventListener('scroll', () => this.requestScrollUpdate(), { passive: true });
            window.addEventListener('resize', () => this.handleResize());
            
            // Add touch scroll optimization
            if (isTouch) {
                this.navbar.style.transform = 'translateZ(0)'; // Hardware acceleration
            }
        }

        requestScrollUpdate() {
            if (!this.ticking) {
                requestAnimationFrame(() => this.handleScroll());
                this.ticking = true;
            }
        }

        handleScroll() {
            const currentScrollY = window.scrollY;
            const scrollDifference = Math.abs(currentScrollY - this.lastScrollY);
            
            if (scrollDifference < this.scrollThreshold) {
                this.ticking = false;
                return;
            }

            this.isScrollingDown = currentScrollY > this.lastScrollY;
            
            // Update navbar background with smoother transitions
            const scrollProgress = Math.min(currentScrollY / 100, 1);
            const bgOpacity = 0.85 + (scrollProgress * 0.1);
            const blurAmount = 20 + (scrollProgress * 10);
            
            this.navbar.style.backgroundColor = `rgba(30, 41, 59, ${bgOpacity})`;
            this.navbar.style.backdropFilter = `blur(${blurAmount}px)`;

            // Enhanced mobile auto-hide behavior
            if (isMobile && currentScrollY > this.hideThreshold) {
                if (this.isScrollingDown) {
                    this.navbar.style.transform = 'translateY(-100%)';
                } else {
                    this.navbar.style.transform = 'translateY(0)';
                }
            } else if (isMobile) {
                this.navbar.style.transform = 'translateY(0)';
            }

            this.lastScrollY = currentScrollY;
            this.ticking = false;
        }

        handleResize() {
            // Close mobile menu on orientation change
            const mobileMenuManager = window.mobileMenuManager;
            if (mobileMenuManager && mobileMenuManager.isOpen) {
                mobileMenuManager.close();
            }
        }
    }

    // Enhanced Touch Interactions for Cards and Buttons
    class TouchInteractionManager {
        constructor() {
            this.init();
        }

        init() {
            this.setupCardInteractions();
            this.setupButtonInteractions();
            this.setupFormOptimizations();
        }

        setupCardInteractions() {
            const cards = document.querySelectorAll('.card-hover, .service-card, .facility-item');
            
            cards.forEach(card => {
                card.style.cssText += `
                    -webkit-tap-highlight-color: transparent !important;
                    touch-action: manipulation !important;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                `;

                // Enhanced touch feedback
                card.addEventListener('touchstart', () => {
                    card.style.transform = 'scale(0.98)';
                    card.style.transition = 'transform 0.1s ease';
                }, { passive: true });

                card.addEventListener('touchend', () => {
                    card.style.transform = '';
                    card.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                }, { passive: true });

                card.addEventListener('touchcancel', () => {
                    card.style.transform = '';
                    card.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                }, { passive: true });
            });
        }

        setupButtonInteractions() {
            const buttons = document.querySelectorAll('.btn-hover, button, .nav-link-enhanced');
            
            buttons.forEach(button => {
                button.style.cssText += `
                    min-height: 44px !important;
                    min-width: 44px !important;
                    -webkit-tap-highlight-color: transparent !important;
                    touch-action: manipulation !important;
                `;

                // Add ripple effect for mobile
                button.addEventListener('touchstart', (e) => {
                    this.createRipple(e, button);
                }, { passive: true });
            });
        }

        createRipple(event, element) {
            const ripple = document.createElement('span');
            const rect = element.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.touches[0].clientX - rect.left - size / 2;
            const y = event.touches[0].clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                pointer-events: none;
            `;
            
            element.style.position = 'relative';
            element.style.overflow = 'hidden';
            element.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        setupFormOptimizations() {
            const inputs = document.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Prevent iOS zoom
                input.style.fontSize = Math.max(16, parseInt(getComputedStyle(input).fontSize)) + 'px';
                
                // Enhanced focus states for mobile
                input.addEventListener('focus', () => {
                    input.style.transform = 'scale(1.02)';
                    input.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                });
                
                input.addEventListener('blur', () => {
                    input.style.transform = '';
                    input.style.boxShadow = '';
                });
            });
        }
    }

    // Performance optimizations for mobile
    class MobilePerformanceManager {
        constructor() {
            this.init();
        }

        init() {
            this.optimizeImages();
            this.optimizeAnimations();
            this.addConnectionAwareness();
            this.optimizeViewport();
        }

        optimizeImages() {
            // Lazy loading with Intersection Observer
            const images = document.querySelectorAll('img');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            }, { rootMargin: '50px' });

            images.forEach(img => {
                if (img.dataset.src) {
                    imageObserver.observe(img);
                }
            });
        }

        optimizeAnimations() {
            // Reduced motion support
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                const style = document.createElement('style');
                style.textContent = `
                    *, *::before, *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                    }
                `;
                document.head.appendChild(style);
            }
        }

        addConnectionAwareness() {
            if ('connection' in navigator) {
                const connection = navigator.connection;
                
                // Reduce animations on slow connections
                if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
                    document.body.classList.add('slow-connection');
                    
                    const style = document.createElement('style');
                    style.textContent = `
                        .slow-connection * {
                            animation: none !important;
                            transition: none !important;
                        }
                    `;
                    document.head.appendChild(style);
                }
            }
        }

        optimizeViewport() {
            if (isMobile) {
                // Enhanced viewport meta for better mobile experience
                const viewport = document.querySelector('meta[name="viewport"]');
                if (viewport) {
                    viewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover';
                }
                
                // Add safe area support
                const style = document.createElement('style');
                style.textContent = `
                    @supports (padding: max(0px)) {
                        .mobile-safe-area {
                            padding-left: max(env(safe-area-inset-left), 1rem);
                            padding-right: max(env(safe-area-inset-right), 1rem);
                        }
                    }
                `;
                document.head.appendChild(style);
            }
        }
    }

    // Add CSS animations for mobile interactions
    const mobileAnimationCSS = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes mobileSlideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes mobileSlideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .mobile-animate-up {
            animation: mobileSlideUp 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .mobile-animate-down {
            animation: mobileSlideDown 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        /* Enhanced mobile scrollbar */
        @media (max-width: 768px) {
            ::-webkit-scrollbar {
                display: none;
            }
            
            body {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
    `;

    // Inject mobile animations CSS
    const styleSheet = document.createElement('style');
    styleSheet.textContent = mobileAnimationCSS;
    document.head.appendChild(styleSheet);

    // Initialize all mobile managers when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (isMobile || isTouch) {
            // Initialize mobile-specific managers
            window.mobileMenuManager = new MobileMenuManager();
            window.mobileNavbarManager = new MobileNavbarManager();
            window.touchInteractionManager = new TouchInteractionManager();
            window.mobilePerformanceManager = new MobilePerformanceManager();
            
            // Add mobile classes
            document.body.classList.add('mobile-optimized');
            if (isIOS) document.body.classList.add('ios-device');
            
            console.log('📱 Mobile optimizations loaded successfully!');
        }
    });

    // Handle orientation changes with debouncing
    let orientationTimeout;
    window.addEventListener('orientationchange', function() {
        clearTimeout(orientationTimeout);
        orientationTimeout = setTimeout(() => {
            // Force repaint to fix layout issues
            document.body.style.display = 'none';
            document.body.offsetHeight; // Trigger reflow
            document.body.style.display = '';
            
            // Dispatch custom event for other components
            window.dispatchEvent(new CustomEvent('mobileOrientationChange'));
        }, 300);
    });
</script> 