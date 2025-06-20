<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laboratorium Fisika') }} - Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom CSS -->
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.1);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .nav-link-active {
            background: rgba(59, 130, 246, 0.15);
            border-left: 4px solid #3b82f6;
            border-radius: 0 12px 12px 0;
        }
        
        .nav-link {
            border-radius: 12px;
            margin: 2px 8px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }
        
        .stat-card:hover {
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.3);
        }
        
        .stat-card.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
        }
        
        .stat-card.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2);
        }
        
        .stat-card.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2);
        }
        
        .stat-card.purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
        }
        
        .stat-card.yellow {
            background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
            box-shadow: 0 8px 25px rgba(234, 179, 8, 0.2);
        }
        
        .header-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        

        
        .user-avatar {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            margin: 16px 0;
        }
        
        .main-content {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }
        
        .alert-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
        }
        
        /* Enhanced Toast Notifications */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }
        
        .toast {
            margin-bottom: 12px;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateX(100%);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: white;
            font-weight: 500;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        .toast.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .toast.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .toast.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        
        .toast.info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .toast::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, rgba(255,255,255,0.8), rgba(255,255,255,0.3));
            animation: toastProgress 4s linear;
        }
        
        @keyframes toastProgress {
            from { width: 100%; }
            to { width: 0%; }
        }
        
        .toast-icon {
            font-size: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .toast-close {
            margin-left: 12px;
            padding: 4px;
            border-radius: 6px;
            transition: background-color 0.2s;
            flex-shrink: 0;
        }
        
        .toast-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        /* Enhanced Modal Styles */
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            animation: modalBackdropFadeIn 0.3s ease-out;
        }
        
        @keyframes modalBackdropFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px 28px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            position: relative;
        }
        
        .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ef4444);
        }
        
        .modal-body {
            padding: 28px;
        }
        
        .modal-footer {
            background: rgba(249, 250, 251, 0.8);
            padding: 20px 28px;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        /* Improved Buttons */
        .btn-modern {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-modern:active {
            transform: translateY(0);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        
        /* Enhanced Form Inputs */
        .form-input-modern {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
            width: 100%;
        }
        
        .form-input-modern:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: rgba(59, 130, 246, 0.02);
        }
        
        /* Enhanced Tables */
        .table-modern {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .table-modern th {
            font-weight: 600;
            color: #374151;
            padding: 16px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .table-modern td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .table-modern tbody tr:hover {
            background: rgba(59, 130, 246, 0.02);
        }
        
        /* Enhanced Loading States */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        

        
        /* Enhanced Confirmation Dialog */
        .confirm-dialog {
            max-width: 480px;
            width: 90%;
        }
        
        .confirm-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: white;
        }
        
        .confirm-icon.danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .confirm-icon.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        
        .confirm-icon.info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-up {
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        
        /* Enhanced Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
        }
        
        .status-approved {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .status-rejected {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="main-content font-sans">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="fixed inset-y-0 left-0 z-50 w-64 sidebar-gradient transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <!-- Logo Header -->
            <div class="flex items-center justify-center h-20 glass-effect">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center mr-3 backdrop-blur-lg">
                        <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Logo" class="h-8 w-8 object-contain">
                    </div>
                    <div>
                        <span class="text-white text-lg font-bold">
                            @if(Auth::user()->isSuperAdmin())
                                Super Admin
                            @elseif(Auth::user()->role === 'dosen')
                                Dosen/Peneliti
                            @else
                                Laboran
                            @endif
                        </span>
                        <div class="text-blue-300 text-xs">
                            @if(Auth::user()->isSuperAdmin())
                                Full System Access
                            @elseif(Auth::user()->role === 'dosen')
                                Lab Operations Access
                            @else
                                Lab Operations Management
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-8 px-4">
                <div class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link flex items-center px-4 py-3 text-white transition-all {{ Request::routeIs('admin.dashboard') ? 'nav-link-active' : '' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3 text-blue-400"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Section Divider -->
                    <div class="section-divider"></div>
                    <div class="px-4 py-2 text-blue-300 text-xs font-semibold uppercase tracking-wider">
                        Manajemen Inventaris
                    </div>
                    
                    <a href="{{ route('admin.equipment.index') }}" 
                       class="nav-link flex items-center px-4 py-3 text-white transition-all {{ Request::routeIs('admin.equipment.*') ? 'nav-link-active' : '' }}">
                        <i class="fas fa-microscope w-5 h-5 mr-3 text-green-400"></i>
                        <span class="font-medium">Alat Laboratorium</span>
                    </a>
                    
                    <!-- Section Divider -->
                    <div class="section-divider"></div>
                    <div class="px-4 py-2 text-blue-300 text-xs font-semibold uppercase tracking-wider">
                        Manajemen Layanan
                    </div>
                    
                    <a href="{{ route('admin.simulations.index') }}" 
                       class="nav-link flex items-center px-4 py-3 text-white transition-all {{ Request::routeIs('admin.simulations.*') ? 'nav-link-active' : '' }}">
                        <i class="fas fa-laptop-code w-5 h-5 mr-3 text-purple-400"></i>
                        <span class="font-medium">Simulasi & Komputasi</span>
                    </a>
                    
                    <a href="{{ route('admin.lab-access.index') }}" 
                       class="nav-link flex items-center px-4 py-3 text-white transition-all {{ Request::routeIs('admin.lab-access.*') ? 'nav-link-active' : '' }}">
                        <i class="fas fa-door-open w-5 h-5 mr-3 text-yellow-400"></i>
                        <span class="font-medium">Akses Laboratorium</span>
                    </a>
                    
                    <a href="{{ route('admin.consultations.index') }}" 
                       class="nav-link flex items-center px-4 py-3 text-white transition-all {{ Request::routeIs('admin.consultations.*') ? 'nav-link-active' : '' }}">
                        <i class="fas fa-user-tie w-5 h-5 mr-3 text-orange-400"></i>
                        <span class="font-medium">Konsultasi</span>
                    </a>
                    
                    @unless(Auth::user()->isSuperAdmin())
                        <!-- Limited Access Notice -->
                        <div class="mx-4 my-4 p-3 bg-yellow-500/20 border border-yellow-500/30 rounded-lg">
                            <div class="flex items-center text-yellow-300 text-xs">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span class="font-medium">Lab Operations Management</span>
                            </div>
                            <div class="text-yellow-200 text-xs mt-1">
                                Contact Super Admin for system-wide access
                            </div>
                        </div>
                    @endunless
                    
                    @if(Auth::user()->isSuperAdmin())
                        <!-- Section Divider -->
                        <div class="section-divider"></div>
                        <div class="px-4 py-2 text-blue-300 text-xs font-semibold uppercase tracking-wider">
                            Sistem
                        </div>
                        
                        <a href="#" 
                           class="nav-link flex items-center px-4 py-3 text-white transition-all">
                            <i class="fas fa-cog w-5 h-5 mr-3 text-gray-400"></i>
                            <span class="font-medium">Pengaturan</span>
                        </a>
                        
                        <!-- Super Admin Panel Link -->
                        <a href="{{ route('super-admin.dashboard') }}" 
                           class="nav-link flex items-center px-4 py-3 text-white transition-all bg-purple-500/20 border border-purple-400/30 rounded-lg mx-4 mt-3">
                            <i class="fas fa-crown w-5 h-5 mr-3 text-purple-300"></i>
                            <span class="font-medium">Super Admin Panel</span>
                        </a>
                    @endif
                </div>
            </nav>
            
            <!-- Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <div class="glass-effect rounded-xl p-3 text-center">
                    <div class="text-white text-xs font-medium">Lab Fisika FMIPA</div>
                    <div class="text-blue-300 text-xs">&copy; 2024</div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Top Bar -->
            <header class="header-glass shadow-lg">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button type="button" 
                                data-mobile-menu
                                class="text-gray-600 hover:text-gray-900 lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-bars w-6 h-6"></i>
                        </button>
                        <div class="ml-4 lg:ml-0">
                            <h1 class="text-2xl font-bold text-gray-900">
                                @yield('title', 'Dashboard')
                            </h1>
                            <p class="text-sm text-gray-600">@yield('subtitle', 'Laboratorium Fisika FMIPA')</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- User Menu -->
                        <div class="flex items-center space-x-3 bg-gray-50 rounded-xl p-2">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">
                                    @if(Auth::user()->isSuperAdmin())
                                        Super Admin
                                    @elseif(Auth::user()->role === 'dosen')
                                        Dosen/Peneliti
                                    @elseif(Auth::user()->role === 'lab_admin')
                                        Laboran
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                    @endif
                                </div>
                            </div>
                            <div class="user-avatar h-10 w-10 rounded-xl flex items-center justify-center">
                                <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700 p-3 rounded-xl hover:bg-red-50 transition-all">
                                <i class="fas fa-sign-out-alt w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-6 alert-success px-6 py-4 rounded-xl flex items-center" data-alert>
                        <i class="fas fa-check-circle mr-3"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 alert-error px-6 py-4 rounded-xl flex items-center" data-alert>
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif
                
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
    
    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('[data-mobile-menu]');
        const sidebar = document.querySelector('.sidebar-gradient');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
        
        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('[data-alert]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
        
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        

        
        // Professional Toast Notification System
        function createToastContainer() {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            return container;
        }
        
        function showToast(message, type = 'info', duration = 5000, actions = null) {
            const container = createToastContainer();
            const toast = document.createElement('div');
            const toastId = 'toast_' + Date.now();
            
            const icons = {
                success: '🎉',
                error: '❌',
                warning: '⚠️',
                info: 'ℹ️'
            };
            
            const iconClasses = {
                success: 'fa-check-circle',
                error: 'fa-times-circle', 
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };
            
            toast.id = toastId;
            toast.className = `toast ${type} fade-in`;
            
            let actionsHtml = '';
            if (actions) {
                actionsHtml = `
                    <div class="flex gap-2 mt-2">
                        ${actions.map(action => `
                            <button onclick="${action.onclick}" class="text-xs px-3 py-1 rounded-lg bg-white bg-opacity-20 hover:bg-opacity-30 transition-all">
                                ${action.text}
                            </button>
                        `).join('')}
                    </div>
                `;
            }
            
            toast.innerHTML = `
                <div class="flex items-start">
                    <div class="toast-icon">
                        <i class="fas ${iconClasses[type]}"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">${message}</div>
                        ${actionsHtml}
                    </div>
                    <button class="toast-close" onclick="removeToast('${toastId}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(toast);
            
            // Trigger show animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Auto remove after duration (unless it has actions)
            if (!actions) {
                setTimeout(() => {
                    removeToast(toastId);
                }, duration);
            }
            
            return toastId;
        }
        
        function removeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 400);
            }
        }
        
        // Professional Modal System
        function createModal(options) {
            const modalId = 'modal_' + Date.now();
            const modal = document.createElement('div');
            modal.id = modalId;
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center modal-backdrop';
            
            const modalSize = options.size || 'md';
            const sizeClasses = {
                sm: 'max-w-sm',
                md: 'max-w-md', 
                lg: 'max-w-lg',
                xl: 'max-w-xl',
                '2xl': 'max-w-2xl'
            };
            
            const iconHtml = options.icon ? `
                <div class="confirm-icon ${options.iconType || 'info'}">
                    <i class="fas ${options.icon}"></i>
                </div>
            ` : '';
            
            modal.innerHTML = `
                <div class="modal-content ${sizeClasses[modalSize]} w-full mx-4 transform transition-all scale-95 opacity-0 slide-up">
                    <div class="modal-header">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">${options.title}</h3>
                            ${options.closable !== false ? `
                                <button onclick="closeModal('${modalId}')" class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                            ` : ''}
                        </div>
                    </div>
                    <div class="modal-body">
                        ${iconHtml}
                        <div class="text-center ${iconHtml ? 'mt-4' : ''}">
                            ${options.content}
                        </div>
                    </div>
                    <div class="modal-footer flex justify-end space-x-3">
                        ${options.buttons || '<button class="btn-modern btn-secondary" onclick="closeModal(\'' + modalId + '\')">Tutup</button>'}
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Trigger show animation
            setTimeout(() => {
                const content = modal.querySelector('.modal-content');
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }, 100);
            
            // Close on backdrop click
            if (options.closeOnBackdrop !== false) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal(modalId);
                    }
                });
            }
            
            // Close on escape key
            const handleEscape = (e) => {
                if (e.key === 'Escape') {
                    closeModal(modalId);
                    document.removeEventListener('keydown', handleEscape);
                }
            };
            document.addEventListener('keydown', handleEscape);
            
            return modalId;
        }
        
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                const content = modal.querySelector('.modal-content');
                content.style.transform = 'scale(0.95)';
                content.style.opacity = '0';
                setTimeout(() => {
                    modal.remove();
                    // Restore body scroll if no other modals
                    if (!document.querySelector('.modal-backdrop')) {
                        document.body.style.overflow = '';
                    }
                }, 300);
            }
        }
        
        function confirmAction(message, onConfirm, options = {}) {
            const modalId = createModal({
                title: options.title || 'Konfirmasi Tindakan',
                content: `<p class="text-gray-600 text-center">${message}</p>`,
                icon: options.icon || 'fa-exclamation-triangle',
                iconType: options.type || 'warning',
                size: 'md',
                buttons: `
                    <button class="btn-modern btn-secondary" onclick="closeModal('${modalId}')">
                        ${options.cancelText || 'Batal'}
                    </button>
                    <button class="btn-modern ${options.confirmClass || 'btn-danger'}" onclick="handleConfirm('${modalId}')">
                        ${options.confirmText || 'Ya, Lanjutkan'}
                    </button>
                `,
                closable: options.closable !== false
            });
            
            window.handleConfirm = function(currentModalId) {
                if (onConfirm) {
                    const result = onConfirm();
                    // If onConfirm returns a promise, show loading state
                    if (result && typeof result.then === 'function') {
                        const confirmBtn = document.querySelector(`#${currentModalId} .btn-danger, #${currentModalId} .btn-success`);
                        if (confirmBtn) {
                            confirmBtn.classList.add('btn-loading');
                            confirmBtn.disabled = true;
                        }
                        
                        result.finally(() => {
                            closeModal(currentModalId);
                        });
                    } else {
                        closeModal(currentModalId);
                    }
                } else {
                    closeModal(currentModalId);
                }
            };
            
            return modalId;
        }
        
        function alertMessage(message, type = 'info', title = null) {
            const types = {
                success: { icon: 'fa-check-circle', iconType: 'success', title: 'Berhasil!' },
                error: { icon: 'fa-times-circle', iconType: 'danger', title: 'Error!' },
                warning: { icon: 'fa-exclamation-triangle', iconType: 'warning', title: 'Peringatan!' },
                info: { icon: 'fa-info-circle', iconType: 'info', title: 'Informasi' }
            };
            
            const config = types[type] || types.info;
            
            return createModal({
                title: title || config.title,
                content: `<p class="text-gray-600">${message}</p>`,
                icon: config.icon,
                iconType: config.iconType,
                buttons: `<button class="btn-modern btn-primary" onclick="closeModal(this.closest('.modal-backdrop').id)">OK</button>`
            });
        }
        
        // Enhanced Form Validation
        function validateForm(formId) {
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('.form-input-modern[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = '#ef4444';
                    input.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                    isValid = false;
                } else {
                    input.style.borderColor = '#10b981';
                    input.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
                }
            });
            
            return isValid;
        }
        
        // Enhanced Button Loading States
        function setButtonLoading(button, loading = true) {
            if (loading) {
                button.disabled = true;
                button.innerHTML = '<div class="loading-spinner"></div> Memproses...';
            } else {
                button.disabled = false;
                button.innerHTML = button.getAttribute('data-original-text') || 'Submit';
            }
        }
        
        // Auto-save form data to localStorage
        function autoSaveForm(formId) {
            const form = document.getElementById(formId);
            if (!form) return;
            
            const inputs = form.querySelectorAll('input, textarea, select');
            
            // Load saved data
            const savedData = localStorage.getItem(`form_${formId}`);
            if (savedData) {
                const data = JSON.parse(savedData);
                inputs.forEach(input => {
                    if (data[input.name] && input.type !== 'password') {
                        input.value = data[input.name];
                    }
                });
            }
            
            // Save on change
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    const formData = {};
                    inputs.forEach(inp => {
                        if (inp.type !== 'password') {
                            formData[inp.name] = inp.value;
                        }
                    });
                    localStorage.setItem(`form_${formId}`, JSON.stringify(formData));
                });
            });
        }
        
        // Initialize enhanced features
        document.addEventListener('DOMContentLoaded', function() {
            // Add modern classes to existing buttons
            document.querySelectorAll('button[type="submit"]').forEach(btn => {
                if (!btn.classList.contains('btn-modern')) {
                    btn.classList.add('btn-modern', 'btn-primary');
                }
            });
            
            // Add modern classes to form inputs
            document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], textarea, select').forEach(input => {
                if (!input.classList.contains('form-input-modern')) {
                    input.classList.add('form-input-modern');
                }
            });
            
            // Add modern classes to tables
            document.querySelectorAll('table').forEach(table => {
                if (!table.classList.contains('table-modern')) {
                    table.classList.add('table-modern');
                }
            });
        });
        
        // Global notification function
        window.notify = {
            success: (message) => showToast(message, 'success'),
            error: (message) => showToast(message, 'error'),
            warning: (message) => showToast(message, 'warning'),
            info: (message) => showToast(message, 'info')
        };
    </script>
    
    @stack('scripts')
</body>
</html> 