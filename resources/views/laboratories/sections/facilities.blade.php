<!-- Facilities Section / Fasilitas -->
<section id="fasilitas" class="py-16 bg-white relative overflow-hidden" style="font-family: 'Montserrat', sans-serif;">
    <!-- Google Fonts Import -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Background decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-64 h-64 bg-slate-50 rounded-full opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-slate-100 rounded-full opacity-40 animate-pulse" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/3 right-1/4 w-3 h-3 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/3 left-1/4 w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 4s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Enhanced Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center bg-slate-50 rounded-full px-6 py-2 mb-6 shadow-sm border border-slate-100">
                <div class="w-2 h-2 bg-slate-600 rounded-full mr-3 animate-pulse"></div>
                <span class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Our Facilities</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
                Fasilitas Laboratorium
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                28 PC workstation dan fasilitas digital lengkap untuk komputasi, simulasi, fotografi, dan web desain software geofisika
            </p>
        </div>

        <!-- Card Hover Effects Container -->
        <div class="facilities-container">
            <!-- PC Workstations Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-desktop text-5xl text-white"></i>
                        <h3>PC Workstations</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>28 PC workstation berkualitas tinggi untuk komputasi dan simulasi fisika dengan spesifikasi tinggi, akses mahasiswa, dan maintenance rutin.</p>
                    </div>
                </div>
            </div>

            <!-- Software Komputasi Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-calculator text-5xl text-white"></i>
                        <h3>Software Komputasi</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Software khusus untuk komputasi fisika, simulasi numerik, dan pemodelan matematis termasuk MATLAB/Octave, Python/NumPy, dan simulasi fisika.</p>
                    </div>
                </div>
            </div>

            <!-- Network Infrastructure Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-network-wired text-5xl text-white"></i>
                        <h3>Network Infrastructure</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Infrastruktur jaringan berkecepatan tinggi untuk akses data dan komputasi cloud dengan Gigabit Ethernet, cloud access, dan secure connection.</p>
                    </div>
                </div>
            </div>

            <!-- Fotografi & Digital Arts Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-camera text-5xl text-white"></i>
                        <h3>Fotografi & Digital Arts</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Fasilitas fotografi digital untuk mendukung hobi mahasiswa di bidang fotografi dan desain visual dengan peralatan fotografi, software editing, dan studio digital.</p>
                    </div>
                </div>
            </div>

            <!-- Web Design & Development Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-code text-5xl text-white"></i>
                        <h3>Web Design & Development</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Fasilitas untuk pengembangan web dan aplikasi, mendukung hobi mahasiswa di bidang teknologi web dengan development tools, web frameworks, dan testing environment.</p>
                    </div>
                </div>
            </div>

            <!-- Software Geofisika Card -->
            <div class="facility-card">
                <div class="face face1">
                    <div class="content">
                        <i class="fas fa-globe text-5xl text-white"></i>
                        <h3>Software Geofisika</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Software khusus untuk analisis data geofisika dan pemodelan struktur bumi termasuk seismic analysis, gravity modeling, dan magnetic processing.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Operational Hours with Glassmorphism -->
        <div class="mt-16 bg-white/80 backdrop-blur-md rounded-3xl p-8 text-center border border-slate-200/50 shadow-xl">
            <h3 class="text-2xl font-bold text-slate-800 mb-4">Jam Operasional</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-semibold text-slate-800 mb-2">Hari Kerja (Senin - Jumat)</h4>
                    <p class="text-gray-600">08:00 - 16:00 WIB</p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-800 mb-2">Layanan Khusus</h4>
                    <p class="text-gray-600">Tersedia sesuai appointment</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Card Hover Effects -->
    <style>
        .facilities-container {
            width: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 2.5vw;
            font-family: 'Montserrat', sans-serif;
        }

        .facility-card {
            position: relative;
            cursor: pointer;
            margin-bottom: 32px;
            flex: 1 1 30%;
            max-width: 32%;
            min-width: 320px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .facility-card .face {
            width: 100%;
            height: 240px;
            transition: 0.5s;
        }

        .facility-card .face.face1 {
            position: relative;
            background: linear-gradient(135deg, #475569, #334155);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            transform: translateY(120px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.10);
        }

        .facility-card:hover .face.face1 {
            background: linear-gradient(135deg, #334155, #1e293b);
            transform: translateY(0);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .facility-card .face.face1 .content {
            opacity: 0.2;
            transition: 0.5s;
            text-align: center;
        }

        .facility-card:hover .face.face1 .content {
            opacity: 1;
        }

        .facility-card .face.face1 .content i {
            margin-bottom: 18px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        .facility-card .face.face1 .content h3 {
            margin: 10px 0 0;
            padding: 0;
            color: #fff;
            text-align: center;
            font-size: 1.25em;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .facility-card .face.face2 {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 36px;
            box-sizing: border-box;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.10);
            transform: translateY(-120px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .facility-card:hover .face.face2 {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .facility-card .face.face2 .content {
            text-align: center;
        }

        .facility-card .face.face2 .content p {
            margin: 0;
            padding: 0;
            color: #334155;
            font-size: 1.05em;
            line-height: 1.8;
            font-weight: 400;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .facility-card {
                max-width: 48%;
                min-width: 280px;
            }
            .facility-card .face {
                height: 200px;
            }
        }

        @media (max-width: 900px) {
            .facility-card {
                max-width: 100%;
                min-width: 220px;
            }
            .facilities-container {
                gap: 18px;
            }
            .facility-card .face {
                height: 180px;
            }
        }

        @media (max-width: 600px) {
            .facilities-container {
                flex-direction: column;
                align-items: center;
                gap: 14px;
            }
            .facility-card {
                max-width: 98%;
                min-width: 0;
            }
            .facility-card .face {
                height: 140px;
            }
            .facility-card .face.face1 .content h3 {
                font-size: 1em;
            }
            .facility-card .face.face2 .content p {
                font-size: 0.95em;
            }
        }
    </style>
</section> 