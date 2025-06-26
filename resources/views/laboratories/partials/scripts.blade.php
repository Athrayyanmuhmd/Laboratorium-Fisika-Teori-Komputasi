<script>
    // Enhanced Mobile Detection
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    
    // Mobile Menu and Navigation Management

    // Enhanced Mobile Menu with Touch Gestures
    class MobileMenuManager {
        constructor() {
            this.mobileMenuButton = document.getElementById('mobile-menu-button');
            this.mobileMenu = document.getElementById('mobile-menu');
            this.isOpen = false;
            this.touchStartY = 0;
            this.touchEndY = 0;
            this.init();
        }

        init() {
            if (!this.mobileMenuButton || !this.mobileMenu) return;

            // Button click handler
            this.mobileMenuButton.addEventListener('click', () => this.toggle());

            // Touch gesture for swipe up to close
            this.mobileMenu.addEventListener('touchstart', (e) => {
                this.touchStartY = e.changedTouches[0].screenY;
            }, { passive: true });

            this.mobileMenu.addEventListener('touchend', (e) => {
                this.touchEndY = e.changedTouches[0].screenY;
                this.handleSwipe();
            }, { passive: true });

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
        }

        toggle() {
            this.isOpen ? this.close() : this.open();
        }

        open() {
            this.isOpen = true;
            this.mobileMenu.classList.remove('hidden');
            this.mobileMenu.classList.add('active');
            
            // Add haptic feedback on mobile
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
            
            // Prevent background scroll
            document.body.style.overflow = 'hidden';
            
            // Animate menu items
            const menuItems = this.mobileMenu.querySelectorAll('.nav-link-enhanced');
            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        item.style.transition = 'all 0.3s ease';
                        item.style.opacity = '1';
                        item.style.transform = 'translateX(0)';
                    }, 50);
                }, index * 50);
            });
        }

        close() {
            this.isOpen = false;
            this.mobileMenu.classList.remove('active');
            
            setTimeout(() => {
                this.mobileMenu.classList.add('hidden');
            }, 300);
            
            // Restore background scroll
            document.body.style.overflow = '';
        }

        handleSwipe() {
            const swipeDistance = this.touchStartY - this.touchEndY;
            const minSwipeDistance = 50;

            // Swipe up to close
            if (swipeDistance > minSwipeDistance && this.isOpen) {
                this.close();
            }
        }
    }

    // Enhanced Smooth Scrolling with Mobile Optimization
    class SmoothScrollManager {
        constructor() {
            this.init();
        }

        init() {
            const navLinks = document.querySelectorAll('a[href^="#"]');
            
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => this.handleClick(e, link));
            });
        }

        handleClick(e, link) {
            e.preventDefault();
            
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (!targetSection) return;

            const headerHeight = isMobile ? 70 : 80;
            const targetPosition = targetSection.offsetTop - headerHeight;
            
            // Smooth scroll with different behavior for mobile
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });

            // Close mobile menu if open
            const mobileMenuManager = window.mobileMenuManager;
            if (mobileMenuManager && mobileMenuManager.isOpen) {
                mobileMenuManager.close();
            }

            // Add haptic feedback on mobile
            if (navigator.vibrate) {
                navigator.vibrate(30);
            }
        }
    }

    // Enhanced Form Handler with Mobile Optimization
    class FormManager {
        constructor() {
            this.init();
        }

        init() {
            const forms = document.querySelectorAll('form[data-form-type]');
            forms.forEach(form => {
                form.addEventListener('submit', (e) => this.handleSubmit(e, form));
                
                // Mobile-specific input optimizations
                if (isMobile) {
                    this.optimizeForMobile(form);
                }
            });
        }

        handleSubmit(e, form) {
            e.preventDefault();
            
            const formType = form.getAttribute('data-form-type');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Show loading state with haptic feedback
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
            
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
            submitButton.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                
                this.showNotification('success', `Formulir ${formType} berhasil dikirim!`);
                form.reset();
                
                // Success haptic feedback
                if (navigator.vibrate) {
                    navigator.vibrate([50, 100, 50]);
                }
            }, 2000);
        }

        optimizeForMobile(form) {
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                // Prevent zoom on focus for iOS
                input.style.fontSize = '16px';
                
                // Add touch-friendly styling
                input.addEventListener('focus', () => {
                    input.style.transform = 'scale(1.02)';
                    input.style.transition = 'transform 0.2s ease';
                });
                
                input.addEventListener('blur', () => {
                    input.style.transform = 'scale(1)';
                });
            });
        }

        showNotification(type, message) {
            const notification = document.createElement('div');
            const baseClasses = 'fixed z-50 px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-300';
            const typeClasses = type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white';
            const positionClasses = isMobile ? 'top-4 left-4 right-4' : 'top-4 right-4 translate-x-full';
            
            notification.className = `${baseClasses} ${typeClasses} ${positionClasses}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check' : 'fa-exclamation-triangle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                if (isMobile) {
                    notification.style.transform = 'translateY(0)';
                } else {
                    notification.classList.remove('translate-x-full');
                }
            }, 100);
            
            // Hide notification
            setTimeout(() => {
                if (isMobile) {
                    notification.style.transform = 'translateY(-100%)';
                } else {
                    notification.classList.add('translate-x-full');
                }
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }

    // Enhanced Navbar with Mobile Optimizations
    class NavbarManager {
        constructor() {
            this.navbar = document.getElementById('navbar');
            this.lastScrollY = window.scrollY;
            this.isScrollingDown = false;
            this.init();
        }

        init() {
            if (!this.navbar) return;

            window.addEventListener('scroll', () => this.handleScroll(), { passive: true });
            
            // Add resize listener for mobile orientation changes
            window.addEventListener('resize', () => this.handleResize());
        }

        handleScroll() {
            const currentScrollY = window.scrollY;
            this.isScrollingDown = currentScrollY > this.lastScrollY;
            
            // Update navbar background
            if (currentScrollY > 50) {
                this.navbar.style.backgroundColor = 'rgba(30, 41, 59, 0.95)';
                this.navbar.style.backdropFilter = 'blur(25px)';
            } else {
                this.navbar.style.backgroundColor = 'rgba(30, 41, 59, 0.85)';
                this.navbar.style.backdropFilter = 'blur(20px)';
            }

            // Hide/show navbar on mobile when scrolling
            if (isMobile) {
                if (this.isScrollingDown && currentScrollY > 100) {
                    this.navbar.style.transform = 'translateY(-100%)';
                } else {
                    this.navbar.style.transform = 'translateY(0)';
                }
            }

            this.lastScrollY = currentScrollY;
        }

        handleResize() {
            // Close mobile menu on orientation change
            const mobileMenuManager = window.mobileMenuManager;
            if (mobileMenuManager && mobileMenuManager.isOpen) {
                mobileMenuManager.close();
            }
        }
    }

    // Enhanced Intersection Observer for Mobile Animations
    class AnimationManager {
        constructor() {
            this.init();
        }

        init() {
            const observerOptions = {
                threshold: isMobile ? 0.05 : 0.1,
                rootMargin: isMobile ? '0px 0px -20px 0px' : '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateElement(entry.target);
                    }
                });
            }, observerOptions);

            // Observe sections and cards
            const sections = document.querySelectorAll('section, .card-hover, .mobile-animate');
            sections.forEach(section => {
                observer.observe(section);
            });
        }

        animateElement(element) {
            element.classList.add('animate-fade-in');
            
            // Add stagger animation for child elements
            const children = element.querySelectorAll('.animate-slide-in-left, .animate-slide-in-right');
            children.forEach((child, index) => {
                setTimeout(() => {
                    child.classList.add('visible');
                }, index * 100);
            });
        }
    }

    // Performance optimizations for mobile
    class PerformanceManager {
        constructor() {
            this.init();
        }

        init() {
            // Lazy load images
            this.lazyLoadImages();
            
            // Optimize touch events
            this.optimizeTouchEvents();
            
            // Add viewport meta adjustments
            this.adjustViewport();
        }

        lazyLoadImages() {
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }

        optimizeTouchEvents() {
            // Add touch-action optimization
            const touchElements = document.querySelectorAll('.btn-hover, .card-hover, .nav-link-enhanced');
            touchElements.forEach(element => {
                element.style.touchAction = 'manipulation';
            });
        }

        adjustViewport() {
            if (isMobile) {
                // Adjust viewport for better mobile experience
                const viewport = document.querySelector('meta[name="viewport"]');
                if (viewport) {
                    viewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover';
                }
            }
        }
    }

    // Initialize all managers when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize dark mode first
        // Dark mode removed - now using light theme only
        
        // Initialize all managers
        window.mobileMenuManager = new MobileMenuManager();
        window.smoothScrollManager = new SmoothScrollManager();
        window.formManager = new FormManager();
        window.navbarManager = new NavbarManager();
        window.animationManager = new AnimationManager();
        window.performanceManager = new PerformanceManager();
        
        // Add mobile-specific classes
        if (isMobile) {
            document.body.classList.add('mobile-device');
        }
        
        if (isTouch) {
            document.body.classList.add('touch-device');
        }
        
        console.log('🚀 Mobile-optimized website loaded successfully!');
    });

    // Handle orientation changes
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            window.scrollTo(0, window.scrollY + 1);
            window.scrollTo(0, window.scrollY - 1);
        }, 500);
    });

    // Add connection awareness
    if ('connection' in navigator) {
        const connection = navigator.connection;
        if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
            document.body.classList.add('slow-connection');
        }
    }
</script> 