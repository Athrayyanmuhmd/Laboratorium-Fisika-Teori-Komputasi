<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laboratorium Fisika FMIPA'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'alexandria': ['Alexandria', 'sans-serif'],
                    },
                    colors: {
                        'physics-blue': '#1e40af',
                        'physics-cyan': '#06b6d4',
                        'physics-purple': '#7c3aed',
                    }
                }
            }
        }
    </script>

    <!-- Base Styles (fallback if Tailwind doesn't load) -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Alexandria', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9fafb;
        }
        
        a {
            color: inherit;
            text-decoration: none;
        }
        
        .navigation {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 50;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem;
        }
        
        .nav-brand {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1e40af;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: #374151;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #1e40af;
        }
        
        .btn-login {
            background: #1e40af;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }
        
        .btn-login:hover {
            background: #1d4ed8;
        }
        
        .footer {
            background: #1f2937;
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .footer h3 {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .footer ul {
            list-style: none;
        }
        
        .footer li {
            margin-bottom: 0.5rem;
            color: #d1d5db;
        }
        
        .footer-bottom {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            text-align: center;
            color: #d1d5db;
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }
    </style>

    <!-- Additional Tailwind Styles -->
    <style type="text/tailwindcss">
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>

<body class="font-alexandria antialiased bg-gray-50">
    <div id="app">
        <!-- Navigation -->
        <nav class="navigation bg-white shadow-lg">
            <div class="nav-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="nav-brand flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold text-physics-blue">Laboratorium Fisika FMIPA</h1>
                        </a>
                    </div>

                    <div class="nav-links hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-physics-blue px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Beranda
                        </a>
                        <a href="{{ route('home') }}#fasilitas" class="nav-link text-gray-700 hover:text-physics-blue px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Laboratorium
                        </a>
                        <a href="{{ route('simulation.index') }}" class="nav-link text-gray-700 hover:text-physics-blue px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Simulasi & Komputasi
                        </a>
                        <a href="{{ route('lab-access.index') }}" class="nav-link text-gray-700 hover:text-physics-blue px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Akses Lab
                        </a>
                        <a href="{{ route('consultation.index') }}" class="nav-link text-gray-700 hover:text-physics-blue px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Konsultasi
                        </a>

                        @guest
                            <a href="{{ route('login') }}" class="btn-login bg-physics-blue text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                                Login
                            </a>
                        @else
                            <div class="relative">
                                <button class="flex items-center text-gray-700 hover:text-physics-blue">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard Admin</a>
                                    @endif
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button class="text-gray-700 hover:text-physics-blue focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer bg-gray-800 text-white py-12 mt-16">
            <div class="footer-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4">Laboratorium Fisika FMIPA</h3>
                        <p class="text-gray-300 mb-4">Universitas Syiah Kuala</p>
                        <p class="text-gray-300">Jl. Syiah Kuala No. 1, Banda Aceh</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4">Laboratorium</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li>Geofisika</li>
                            <li>Fisika Dasar</li>
                            <li>Elektronika</li>
                            <li>Fisika Lanjut</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4">Kontak</h3>
                        <p class="text-gray-300 mb-2">Email: laboratorium@fisika.unsyiah.ac.id</p>
                        <p class="text-gray-300">Tel: +62 651 7551234</p>
                    </div>
                </div>
                <div class="footer-bottom mt-8 pt-8 border-t border-gray-700 text-center text-gray-300">
                    <p>&copy; {{ date('Y') }} Laboratorium Fisika FMIPA Universitas Syiah Kuala. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Simple dropdown toggle
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.querySelector('.relative button');
            const dropdownMenu = document.querySelector('.relative .absolute');
            
            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdownButton.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html> 