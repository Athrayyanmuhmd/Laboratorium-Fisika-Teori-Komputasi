<!-- Formulir Online Section -->
<section id="formulir" class="py-16 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8">Formulir Online</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Ajukan permohonan layanan laboratorium melalui formulir online yang mudah dan cepat
            </p>
        </div>

        <!-- Process Steps -->
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-center text-slate-800 mb-8">Proses Permohonan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-slate-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-xl font-bold">1</span>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Isi Formulir</h4>
                    <p class="text-gray-600 text-sm">Lengkapi formulir sesuai jenis layanan yang dibutuhkan</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-slate-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-xl font-bold">2</span>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Review Admin</h4>
                    <p class="text-gray-600 text-sm">Tim admin akan melakukan review dan verifikasi</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-slate-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-xl font-bold">3</span>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-2">Konfirmasi</h4>
                    <p class="text-gray-600 text-sm">Dapatkan konfirmasi dan jadwal layanan</p>
                </div>
            </div>
        </div>

        <!-- Forms Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Form 1: Equipment Rental -->
            <div class="h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300">
                    <i class="fas fa-desktop text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4">Penyewaan Workstation</h3>
                <p class="text-gray-600 mb-6 flex-grow">Formulir permohonan akses workstation PC untuk kebutuhan komputasi, simulasi, dan research.</p>
                
                <form data-form-type="penyewaan" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Institusi</label>
                        <input type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Penggunaan</label>
                        <textarea required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500" rows="3"></textarea>
                    </div>
                    <button type="submit" class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105">
                        Ajukan Permohonan
                    </button>
                </form>
            </div>

            <!-- Form 2: Lab Visit -->
            <div class="h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4">Kunjungan Laboratorium</h3>
                <p class="text-gray-600 mb-6 flex-grow">Formulir pengajuan kunjungan edukasi atau penelitian ke laboratorium fisika komputasi.</p>
                
                <form data-form-type="kunjungan" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama PIC</label>
                        <input type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Institusi/Sekolah</label>
                        <input type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta</label>
                        <input type="number" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <button type="submit" class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105">
                        Ajukan Kunjungan
                    </button>
                </form>
            </div>

            <!-- Form 3: Testing Service -->
            <div class="h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4">Analisis & Simulasi</h3>
                <p class="text-gray-600 mb-6 flex-grow">Formulir permohonan layanan analisis data dan simulasi menggunakan computational physics.</p>
                
                <form data-form-type="analisis" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peneliti</label>
                        <input type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Analisis</label>
                        <select required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500">
                            <option>Simulasi Numerik</option>
                            <option>Analisis Data Geofisika</option>
                            <option>Computational Modeling</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Project</label>
                        <textarea required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500" rows="3"></textarea>
                    </div>
                    <button type="submit" class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105">
                        Ajukan Analisis
                    </button>
                </form>
            </div>
        </div>
    </div>
</section> 