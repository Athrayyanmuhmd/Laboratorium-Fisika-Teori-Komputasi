<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Super Admin Dashboard') - Laboratorium Fisika Komputasi</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js for analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        'dark': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        },
                        'electric': {
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                        },
                        'neon': {
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                        },
                        'purple': {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        }
                    },
                    animation: {
                        'gradient': 'gradient 6s ease infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'fade-in': 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        glow: {
                            from: { 'box-shadow': '0 0 20px rgba(59, 130, 246, 0.5)' },
                            to: { 'box-shadow': '0 0 30px rgba(59, 130, 246, 0.8)' },
                        },
                        slideUp: {
                            from: { transform: 'translateY(20px)', opacity: '0' },
                            to: { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            from: { opacity: '0' },
                            to: { opacity: '1' },
                        }
                    },
                    backdropBlur: {
                        'xs': '2px',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1e293b;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #7c3aed);
        }
        
        /* Glassmorphism Effects */
        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        
        .glass-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #10b981);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient 6s ease infinite;
        }
        
        /* Cyber Grid Background */
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        
        /* Holographic Button */
        .btn-holo {
            position: relative;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border: 1px solid rgba(59, 130, 246, 0.5);
            transition: all 0.3s ease;
        }
        
        .btn-holo:hover {
            box-shadow: 
                0 0 30px rgba(59, 130, 246, 0.6),
                0 0 60px rgba(139, 92, 246, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .btn-holo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-holo:hover::before {
            left: 100%;
        }
        
        /* Status Indicators */
        .status-online {
            background: linear-gradient(45deg, #10b981, #34d399);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
        }
        
        .status-warning {
            background: linear-gradient(45deg, #f59e0b, #fbbf24);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.5);
        }
        
        .status-critical {
            background: linear-gradient(45deg, #ef4444, #f87171);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
        }
        
        /* Animated Statistics Cards */
        .stat-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover::before {
            transform: scaleX(1);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        /* Terminal-like Effects */
        .terminal-text {
            font-family: 'JetBrains Mono', monospace;
            color: #10b981;
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }
        
        /* Notification Styles */
        .notification {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .notification.success {
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.2);
        }
        
        .notification.error {
            border-color: rgba(239, 68, 68, 0.5);
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.2);
        }
    </style>
    
    @stack('styles')
</head>

<body class="h-full bg-gradient-to-br from-dark-950 via-dark-900 to-dark-800 cyber-grid font-sans">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 lg:relative lg:translate-x-0" id="sidebar">
            <div class="flex flex-col h-full glass-dark">
                <!-- Logo & Title -->
                <div class="flex items-center justify-center p-6 border-b border-electric-600/30">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-xl bg-gradient-to-r from-electric-500 to-purple-500 flex items-center justify-center animate-glow">
                            <i class="fas fa-crown text-white text-xl"></i>
                        </div>
                        <h1 class="text-lg font-bold gradient-text">SUPER ADMIN</h1>
                        <p class="text-xs text-gray-400 terminal-text">COMMAND CENTER</p>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('super-admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-electric-600/20 hover:text-white transition-all duration-200 {{ request()->routeIs('super-admin.dashboard') ? 'bg-electric-600/30 text-white border-l-4 border-electric-500' : '' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>Analytics Dashboard</span>
                        @if(request()->routeIs('super-admin.dashboard'))
                            <div class="ml-auto w-2 h-2 bg-neon-500 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                    
                    <!-- User Management -->
                    <a href="{{ route('super-admin.users.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-purple-600/20 hover:text-white transition-all duration-200 {{ request()->routeIs('super-admin.users.*') ? 'bg-purple-600/30 text-white border-l-4 border-purple-500' : '' }}">
                        <i class="fas fa-users-cog w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>User Management</span>
                        @if(request()->routeIs('super-admin.users.*'))
                            <div class="ml-auto w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                    
                    <!-- Staff Management -->
                    <a href="{{ route('super-admin.staff.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-neon-600/20 hover:text-white transition-all duration-200 {{ request()->routeIs('super-admin.staff.*') ? 'bg-neon-600/30 text-white border-l-4 border-neon-500' : '' }}">
                        <i class="fas fa-user-tie w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>Staff Management</span>
                        @if(request()->routeIs('super-admin.staff.*'))
                            <div class="ml-auto w-2 h-2 bg-neon-500 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                    
                    <!-- Gallery Management -->
                    <a href="{{ route('super-admin.gallery.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-electric-600/20 hover:text-white transition-all duration-200 {{ request()->routeIs('super-admin.gallery.*') ? 'bg-electric-600/30 text-white border-l-4 border-electric-500' : '' }}">
                        <i class="fas fa-images w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>Gallery Management</span>
                        @if(request()->routeIs('super-admin.gallery.*'))
                            <div class="ml-auto w-2 h-2 bg-electric-500 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                    
                    <div class="my-4 border-t border-gray-700"></div>
                    
                    <!-- System Analytics -->
                    <a href="{{ route('super-admin.analytics') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-purple-600/20 hover:text-white transition-all duration-200">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>System Analytics</span>
                    </a>
                    
                    <!-- Reports -->
                    <a href="{{ route('super-admin.reports') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-neon-600/20 hover:text-white transition-all duration-200">
                        <i class="fas fa-file-chart-line w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                        <span>System Reports</span>
                    </a>
                    
                    <!-- System Logs -->
                    <a href="{{ route('super-admin.system-logs') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:bg-electric-600/20 hover:text-white transition-all duration-200">
                        <i class="fas fa-terminal w-5 h-5 mr-3 group-hover:animate-pulse terminal-text"></i>
                        <span class="terminal-text">System Logs</span>
                    </a>
                    
                    <div class="my-4 border-t border-gray-700"></div>
                    
                    <!-- Quick Access to Regular Admin -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-400 rounded-xl hover:bg-gray-600/20 hover:text-gray-300 transition-all duration-200">
                        <i class="fas fa-external-link-alt w-5 h-5 mr-3"></i>
                        <span>Lab Operations Panel</span>
                        <span class="ml-auto text-xs bg-gray-600 text-gray-300 px-2 py-1 rounded">Limited</span>
                    </a>
                </nav>
                
                <!-- System Status -->
                <div class="p-4 border-t border-gray-700">
                    <div class="glass-card rounded-xl p-3">
                        <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                            <span class="terminal-text">SYSTEM STATUS</span>
                            <div class="status-online w-2 h-2 rounded-full"></div>
                        </div>
                        <div class="space-y-1 text-xs terminal-text">
                            <div class="flex justify-between">
                                <span>CPU:</span>
                                <span class="text-neon-400">23%</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Memory:</span>
                                <span class="text-electric-400">67%</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Storage:</span>
                                <span class="text-purple-400">45%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Header -->
            <header class="glass-dark border-b border-electric-600/30">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-toggle" class="lg:hidden text-gray-400 hover:text-white">
                        <i class="fas fa-bars w-6 h-6"></i>
                    </button>
                    
                    <!-- Page Title & Breadcrumb -->
                    <div class="flex items-center space-x-4">
                        <div>
                            <h2 class="text-xl font-bold text-white">@yield('page-title', 'Super Admin Dashboard')</h2>
                            <nav class="text-sm text-gray-400">
                                @yield('breadcrumb', 'Command Center / Dashboard')
                            </nav>
                        </div>
                    </div>
                    
                    <!-- Header Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Quick Actions -->
                        <div class="hidden md:flex items-center space-x-2">
                            <button class="btn-holo px-3 py-2 rounded-lg text-xs text-white font-medium">
                                <i class="fas fa-plus mr-1"></i>
                                Quick Add
                            </button>
                        </div>
                        
                        <!-- User Profile -->
                        <div class="flex items-center space-x-3 glass-card rounded-xl p-2">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs gradient-text font-medium">Super Administrator</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-electric-500 to-purple-500 flex items-center justify-center animate-glow">
                                <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="text-red-400 hover:text-red-300 p-3 rounded-xl hover:bg-red-500/20 transition-all duration-200 hover:animate-pulse">
                                <i class="fas fa-power-off w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 notification success rounded-xl p-4 animate-slide-up" data-notification>
                        <div class="flex items-center">
                            <div class="status-online w-4 h-4 rounded-full mr-3"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-white">Success</div>
                                <div class="text-xs text-gray-300">{{ session('success') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-white ml-4">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 notification error rounded-xl p-4 animate-slide-up" data-notification>
                        <div class="flex items-center">
                            <div class="status-critical w-4 h-4 rounded-full mr-3"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-white">Error</div>
                                <div class="text-xs text-gray-300">{{ session('error') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-white ml-4">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-75 z-40 lg:hidden hidden"></div>
    
    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        
        // Close sidebar when overlay is clicked
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        
        // Auto-hide notifications
        document.querySelectorAll('[data-notification]').forEach(notification => {
            setTimeout(() => {
                notification.remove();
            }, 5000);
        });
        
        // Add some cyber effects
        document.addEventListener('DOMContentLoaded', function() {
            // Randomly animate some elements
            setInterval(() => {
                const elements = document.querySelectorAll('.terminal-text');
                elements.forEach(el => {
                    if (Math.random() > 0.9) {
                        el.style.textShadow = '0 0 20px rgba(16, 185, 129, 0.8)';
                        setTimeout(() => {
                            el.style.textShadow = '0 0 10px rgba(16, 185, 129, 0.5)';
                        }, 200);
                    }
                });
            }, 2000);
        });
    </script>
    
    @stack('scripts')
</body>
</html> 