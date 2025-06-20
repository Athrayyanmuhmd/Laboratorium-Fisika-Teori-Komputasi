<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laboratorium Fisika FMIPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-pattern {
            background-image: 
                linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%),
                url('{{ asset('images/background_admin_gedung_fmipa.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }
        
        .input-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(29, 78, 216, 0.3);
        }
        
        .logo-glow {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
        }
        
        .fade-in {
            animation: fadeIn 1s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-up {
            animation: slideUp 0.8s ease-out 0.2s both;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-button {
            position: fixed;
            top: 2rem;
            left: 2rem;
            z-index: 50;
        }
    </style>
</head>
<body class="bg-pattern min-h-screen">
    <!-- Back to Home Button - Top Left Corner -->
    <div class="back-button">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg rounded-xl text-white hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-white/40">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="hidden sm:inline">Kembali ke Beranda</span>
            <span class="sm:hidden">Beranda</span>
        </a>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header Card -->
            <div class="text-center fade-in">
                <div class="mx-auto h-20 w-20 bg-white/10 rounded-full flex items-center justify-center mb-6 logo-glow backdrop-blur-lg">
                    <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Logo Fisika" class="h-12 w-12 object-contain">
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Selamat Datang</h1>
                <p class="text-gray-300">Laboratorium Fisika Teori dan Komputasi</p>
                <p class="text-blue-300 text-sm font-medium">Fakultas MIPA - Universitas</p>
            </div>

            <!-- Login Card -->
            <div class="glass-card rounded-3xl p-8 slide-up">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">
                        <i class="fas fa-sign-in-alt mr-2 text-blue-400"></i>
                        Masuk ke Sistem
                    </h2>
                    <p class="text-gray-300 text-sm">Silakan masuk dengan akun Anda</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500/20 backdrop-blur-sm border border-red-400/30 text-red-200 px-4 py-3 rounded-xl mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span class="font-medium">Terjadi kesalahan:</span>
                        </div>
                        <ul class="list-disc list-inside mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-200 mb-2">
                                <i class="fas fa-envelope mr-2 text-blue-400"></i>
                                Email Address
                            </label>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   autocomplete="email" 
                                   required 
                                   value="{{ old('email') }}"
                                   class="input-glass w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none"
                                   placeholder="admin@labfisika.ac.id">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-200 mb-2">
                                <i class="fas fa-lock mr-2 text-blue-400"></i>
                                Password
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       autocomplete="current-password" 
                                       required
                                       class="input-glass w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none pr-12"
                                       placeholder="Masukkan password Anda">
                                <button type="button" 
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white transition-colors">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" 
                                   name="remember" 
                                   type="checkbox" 
                                   class="h-4 w-4 text-blue-500 bg-white/10 border-gray-400 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="remember" class="ml-2 block text-sm text-gray-300">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                                class="btn-primary w-full flex justify-center items-center py-3 px-4 rounded-xl shadow-lg text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-400 text-xs">
                <p>&copy; 2024 Laboratorium Fisika FMIPA. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Auto-hide error messages after 5 seconds
        setTimeout(() => {
            const errorDiv = document.querySelector('.bg-red-500\\/20');
            if (errorDiv) {
                errorDiv.style.transition = 'opacity 0.5s ease-out';
                errorDiv.style.opacity = '0';
                setTimeout(() => errorDiv.remove(), 500);
            }
        }, 5000);

        // Add subtle parallax effect
        window.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth) * 100;
            const y = (e.clientY / window.innerHeight) * 100;
            document.body.style.backgroundPosition = `${x/10}% ${y/10}%`;
        });
    </script>
</body>
</html> 