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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                        'display': ['Space Grotesk', 'Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'secondary': {
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
                        },
                        'success': {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        'warning': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        'purple': {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                            800: '#6b21a8',
                            900: '#581c87',
                        }
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideUp: {
                            from: { transform: 'translateY(20px)', opacity: '0' },
                            to: { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            from: { opacity: '0' },
                            to: { opacity: '1' },
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0%)' },
                            '50%': { transform: 'translateY(-5%)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.8' },
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 15px 0 rgba(0, 0, 0, 0.08)',
                        'medium': '0 4px 25px 0 rgba(0, 0, 0, 0.1)',
                        'large': '0 10px 40px 0 rgba(0, 0, 0, 0.12)',
                        'colored': '0 4px 20px 0 rgba(59, 130, 246, 0.15)',
                        'success': '0 4px 20px 0 rgba(16, 185, 129, 0.15)',
                        'warning': '0 4px 20px 0 rgba(245, 158, 11, 0.15)',
                        'purple': '0 4px 20px 0 rgba(168, 85, 247, 0.15)',
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
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #7c3aed);
        }
        
        /* Glass Effects */
        .glass-white {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Gradient Elements */
        .gradient-primary {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, #10b981, #34d399);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
        }
        
        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6, #c084fc);
        }
        
        /* Modern Card Styles */
        .modern-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .modern-card:hover::before {
            transform: scaleX(1);
        }
        
        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Button Styles */
        .btn-modern {
            position: relative;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Status Indicators */
        .status-dot {
            position: relative;
        }
        
        .status-dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150%;
            height: 150%;
            border-radius: 50%;
            background: inherit;
            opacity: 0.3;
            animation: pulse-soft 2s ease-in-out infinite;
        }
        
        /* Menu Item Active State */
        .menu-active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
            border-right: 4px solid #3b82f6;
            color: #1d4ed8;
        }
        
        /* Notification Styles */
        .notification {
            backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .notification.success {
            background: rgba(236, 253, 245, 0.9);
            border-color: rgba(16, 185, 129, 0.3);
        }
        
        .notification.error {
            background: rgba(254, 242, 242, 0.9);
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        /* Modern Input Styles */
        .input-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .input-modern:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: rgba(255, 255, 255, 1);
        }
    </style>
    
    @stack('styles')
</head>

<body class="h-full bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 font-sans">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-72 transform transition-transform duration-300 lg:relative lg:translate-x-0" id="sidebar">
            <div class="flex flex-col h-full glass-white shadow-large">
                <!-- Logo & Title -->
                <div class="flex items-center justify-center p-6 border-b border-gray-200/50">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-2xl gradient-primary flex items-center justify-center shadow-colored animate-float">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <h1 class="text-xl font-bold font-display text-gray-800 mb-1">Super Administrator</h1>
                        <p class="text-sm text-primary-600 font-medium">System Command Center</p>
                        <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                            <div class="w-2 h-2 bg-success-500 rounded-full mr-2 status-dot"></div>
                            Full Access
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('super-admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('super-admin.dashboard') ? 'menu-active font-semibold' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-700' }}">
                        <div class="w-10 h-10 rounded-xl {{ request()->routeIs('super-admin.dashboard') ? 'bg-primary-500' : 'bg-gray-100 group-hover:bg-primary-100' }} flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-chart-line {{ request()->routeIs('super-admin.dashboard') ? 'text-white' : 'text-gray-600 group-hover:text-primary-600' }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Analytics Dashboard</div>
                            <div class="text-xs text-gray-500">System overview & metrics</div>
                        </div>
                        @if(request()->routeIs('super-admin.dashboard'))
                            <div class="w-2 h-2 bg-primary-500 rounded-full animate-pulse-soft"></div>
                        @endif
                    </a>
                    
                    <!-- User Management -->
                    <a href="{{ route('super-admin.users.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('super-admin.users.*') ? 'menu-active font-semibold' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }}">
                        <div class="w-10 h-10 rounded-xl {{ request()->routeIs('super-admin.users.*') ? 'bg-purple-500' : 'bg-gray-100 group-hover:bg-purple-100' }} flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-users-cog {{ request()->routeIs('super-admin.users.*') ? 'text-white' : 'text-gray-600 group-hover:text-purple-600' }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">User Management</div>
                            <div class="text-xs text-gray-500">Manage system users & roles</div>
                        </div>
                        @if(request()->routeIs('super-admin.users.*'))
                            <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse-soft"></div>
                        @endif
                    </a>
                    
                    <!-- Staff Management -->
                    <a href="{{ route('super-admin.staff.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('super-admin.staff.*') ? 'menu-active font-semibold' : 'text-gray-700 hover:bg-success-50 hover:text-success-700' }}">
                        <div class="w-10 h-10 rounded-xl {{ request()->routeIs('super-admin.staff.*') ? 'bg-success-500' : 'bg-gray-100 group-hover:bg-success-100' }} flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-user-tie {{ request()->routeIs('super-admin.staff.*') ? 'text-white' : 'text-gray-600 group-hover:text-success-600' }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Staff Management</div>
                            <div class="text-xs text-gray-500">Laboratory staff directory</div>
                        </div>
                        @if(request()->routeIs('super-admin.staff.*'))
                            <div class="w-2 h-2 bg-success-500 rounded-full animate-pulse-soft"></div>
                        @endif
                    </a>
                    
                    <!-- Gallery Management -->
                    <a href="{{ route('super-admin.gallery.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('super-admin.gallery.*') ? 'menu-active font-semibold' : 'text-gray-700 hover:bg-warning-50 hover:text-warning-700' }}">
                        <div class="w-10 h-10 rounded-xl {{ request()->routeIs('super-admin.gallery.*') ? 'bg-warning-500' : 'bg-gray-100 group-hover:bg-warning-100' }} flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-images {{ request()->routeIs('super-admin.gallery.*') ? 'text-white' : 'text-gray-600 group-hover:text-warning-600' }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Gallery Management</div>
                            <div class="text-xs text-gray-500">Manage media & galleries</div>
                        </div>
                        @if(request()->routeIs('super-admin.gallery.*'))
                            <div class="w-2 h-2 bg-warning-500 rounded-full animate-pulse-soft"></div>
                        @endif
                    </a>
                    
                    <div class="my-4 border-t border-gray-200"></div>
                    
                    <!-- System Analytics -->
                    <a href="{{ route('super-admin.analytics') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 group-hover:bg-primary-100 flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-chart-bar text-gray-600 group-hover:text-primary-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">System Analytics</div>
                            <div class="text-xs text-gray-500">Advanced reporting tools</div>
                        </div>
                    </a>
                    
                    <!-- Reports -->
                    <a href="{{ route('super-admin.reports') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-purple-50 hover:text-purple-700 transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 group-hover:bg-purple-100 flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-file-chart-line text-gray-600 group-hover:text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">System Reports</div>
                            <div class="text-xs text-gray-500">Generate & export reports</div>
                        </div>
                    </a>
                    
                    <!-- System Logs -->
                    <a href="{{ route('super-admin.system-logs') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-secondary-50 hover:text-secondary-700 transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 group-hover:bg-secondary-100 flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-terminal text-gray-600 group-hover:text-secondary-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">System Logs</div>
                            <div class="text-xs text-gray-500">Monitor system activity</div>
                        </div>
                    </a>
                    
                    <div class="my-4 border-t border-gray-200"></div>
                    
                    <!-- Quick Access to Regular Admin -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium text-gray-500 rounded-xl hover:bg-gray-50 hover:text-gray-700 transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 group-hover:bg-gray-100 flex items-center justify-center mr-3 transition-all duration-200">
                            <i class="fas fa-external-link-alt text-gray-400 group-hover:text-gray-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Lab Operations Panel</div>
                            <div class="text-xs text-gray-400">Regular admin interface</div>
                        </div>
                        <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-md">Limited</span>
                    </a>
                </nav>
                
                <!-- System Status -->
                <div class="p-4 border-t border-gray-200">
                    <div class="glass-card rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-700">System Status</span>
                            <div class="w-3 h-3 bg-success-500 rounded-full status-dot"></div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Server CPU</span>
                                <div class="flex items-center">
                                    <div class="w-16 h-1.5 bg-gray-200 rounded-full mr-2">
                                        <div class="w-1/4 h-full bg-success-500 rounded-full"></div>
                                    </div>
                                    <span class="text-xs font-medium text-success-600">23%</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Memory</span>
                                <div class="flex items-center">
                                    <div class="w-16 h-1.5 bg-gray-200 rounded-full mr-2">
                                        <div class="w-2/3 h-full bg-warning-500 rounded-full"></div>
                                    </div>
                                    <span class="text-xs font-medium text-warning-600">67%</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Storage</span>
                                <div class="flex items-center">
                                    <div class="w-16 h-1.5 bg-gray-200 rounded-full mr-2">
                                        <div class="w-1/2 h-full bg-primary-500 rounded-full"></div>
                                    </div>
                                    <span class="text-xs font-medium text-primary-600">45%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <div class="text-xs text-gray-500 text-center">
                                Last updated: <span class="font-medium text-gray-700" id="last-updated">Just now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Header -->
            <header class="glass-white border-b border-gray-200/50 shadow-soft">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-toggle" class="lg:hidden text-gray-600 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-bars w-5 h-5"></i>
                    </button>
                    
                    <!-- Page Title & Breadcrumb -->
                    <div class="flex items-center space-x-4">
                        <div>
                            <h2 class="text-2xl font-bold font-display text-gray-800">@yield('page-title', 'Dashboard Overview')</h2>
                            <nav class="text-sm text-gray-500 mt-1">
                                @yield('breadcrumb', 'Super Admin / Dashboard')
                            </nav>
                        </div>
                    </div>
                    
                    <!-- Header Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Quick Actions -->
                        <div class="hidden md:flex items-center space-x-2">
                            <button class="btn-modern gradient-primary px-4 py-2 rounded-xl text-sm text-white font-medium shadow-colored">
                                <i class="fas fa-plus mr-2"></i>
                                Quick Add
                            </button>
                            <button class="btn-modern bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm text-gray-700 font-medium hover:bg-gray-50 shadow-soft">
                                <i class="fas fa-download mr-2"></i>
                                Export
                            </button>
                        </div>
                        
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-3 rounded-xl text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-all duration-200 relative">
                                <i class="fas fa-bell w-5 h-5"></i>
                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-xs text-white font-bold">3</span>
                                </div>
                            </button>
                        </div>
                        
                        <!-- User Profile -->
                        <div class="flex items-center space-x-3 glass-card rounded-xl p-2 shadow-soft">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-primary-600 font-medium">Super Administrator</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center shadow-colored">
                                <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-600 p-3 rounded-xl hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-power-off w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 notification success rounded-xl p-4 shadow-success animate-slide-up" data-notification>
                        <div class="flex items-center">
                            <div class="w-5 h-5 bg-success-500 rounded-full mr-3 flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-success-800">Success</div>
                                <div class="text-xs text-success-600">{{ session('success') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-success-400 hover:text-success-600 ml-4">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 notification error rounded-xl p-4 shadow-large animate-slide-up" data-notification>
                        <div class="flex items-center">
                            <div class="w-5 h-5 bg-red-500 rounded-full mr-3 flex items-center justify-center">
                                <i class="fas fa-exclamation text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-red-800">Error</div>
                                <div class="text-xs text-red-600">{{ session('error') }}</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600 ml-4">
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
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden backdrop-blur-sm"></div>
    
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
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        });
        
        // Update last updated time
        function updateLastUpdated() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            document.getElementById('last-updated').textContent = timeString;
        }
        
        // Update every minute
        setInterval(updateLastUpdated, 60000);
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateLastUpdated();
            
            // Add smooth scroll behavior
            document.documentElement.style.scrollBehavior = 'smooth';
        });
    </script>
    
    @stack('scripts')
</body>
</html> 