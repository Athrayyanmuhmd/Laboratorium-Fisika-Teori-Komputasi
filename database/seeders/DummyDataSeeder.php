<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kunjungan;
use App\Models\JenisPengujian;
use App\Models\BiodataPengurus;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Kunjungan
        $kunjunganData = [
            [
                'namaPengunjung' => 'Dr. Ahmad Hidayat - Universitas Indonesia',
                'instansiAsal' => 'Universitas Indonesia',
                'jumlahPengunjung' => 15,
                'tujuan' => 'Kunjungan akademik dan observasi fasilitas laboratorium. Mahasiswa semester 6 Fisika UI untuk mempelajari simulasi komputasi.',
                'tujuanKunjungan' => 'Kunjungan akademik dan observasi fasilitas laboratorium. Mahasiswa semester 6 Fisika UI untuk mempelajari simulasi komputasi.',
                'tanggal_kunjungan' => Carbon::now()->addDays(7),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'namaPengunjung' => 'Prof. Siti Nurhaliza - Institut Teknologi Bandung',
                'instansiAsal' => 'Institut Teknologi Bandung',
                'jumlahPengunjung' => 8,
                'tujuan' => 'Kolaborasi penelitian fisika komputasi. Tim peneliti dari ITB untuk diskusi dan sharing knowledge.',
                'tujuanKunjungan' => 'Kolaborasi penelitian fisika komputasi. Tim peneliti dari ITB untuk diskusi dan sharing knowledge.',
                'tanggal_kunjungan' => Carbon::now()->addDays(14),
                'status' => 'PROCESSING',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'namaPengunjung' => 'Drs. Bambang Sutrisno - SMA Negeri 1 Jakarta',
                'instansiAsal' => 'SMA Negeri 1 Jakarta',
                'jumlahPengunjung' => 25,
                'tujuan' => 'Kunjungan edukasi siswa SMA kelas XII IPA. Tour laboratorium dan demo simulasi komputer.',
                'tujuanKunjungan' => 'Kunjungan edukasi siswa SMA kelas XII IPA. Tour laboratorium dan demo simulasi komputer.',
                'tanggal_kunjungan' => Carbon::now()->subDays(3),
                'status' => 'COMPLETED',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'namaPengunjung' => 'Dr. Maya Sari - Universitas Gadjah Mada',
                'instansiAsal' => 'Universitas Gadjah Mada',
                'jumlahPengunjung' => 12,
                'tujuan' => 'Benchmarking laboratorium fisika. Delegasi dari UGM untuk studi banding fasilitas.',
                'tujuanKunjungan' => 'Benchmarking laboratorium fisika. Delegasi dari UGM untuk studi banding fasilitas.',
                'tanggal_kunjungan' => Carbon::now()->addDays(21),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'namaPengunjung' => 'Ir. Budi Santoso, M.T. - PT Teknologi Nusantara',
                'instansiAsal' => 'PT Teknologi Nusantara',
                'jumlahPengunjung' => 6,
                'tujuan' => 'Konsultasi pengembangan software simulasi. Diskusi teknis implementasi algoritma komputasi.',
                'tujuanKunjungan' => 'Konsultasi pengembangan software simulasi. Diskusi teknis implementasi algoritma komputasi.',
                'tanggal_kunjungan' => Carbon::now()->addDays(10),
                'status' => 'PROCESSING',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ]
        ];

        foreach ($kunjunganData as $data) {
            Kunjungan::create($data);
        }

        // Seed Jenis Pengujian
        $jenisPengujianData = [
            [
                'namaPengujian' => 'Analisis Spektroskopi',
                'hargaPerSampel' => 150000,
                'deskripsi' => 'Analisis spektroskopi untuk mengidentifikasi komposisi molekuler sampel menggunakan teknik UV-Vis, FTIR, dan spektroskopi lainnya. Cocok untuk analisis material organik dan anorganik.',
                'estimasiWaktu' => '2-3 hari kerja',
                'kategori' => 'Spektroskopi',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Pengujian Konduktivitas Termal',
                'hargaPerSampel' => 200000,
                'deskripsi' => 'Pengukuran konduktivitas termal material padat untuk aplikasi teknik dan penelitian. Menggunakan metode steady-state dan transient untuk akurasi tinggi.',
                'estimasiWaktu' => '3-4 hari kerja',
                'kategori' => 'Karakterisasi Material',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Analisis Struktur Kristal',
                'hargaPerSampel' => 300000,
                'deskripsi' => 'Analisis struktur kristal menggunakan difraksi sinar-X (XRD) untuk menentukan fase kristal, parameter kisi, dan orientasi kristal dalam material.',
                'estimasiWaktu' => '4-5 hari kerja',
                'kategori' => 'Karakterisasi Material',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Pengujian Sifat Magnetik',
                'hargaPerSampel' => 250000,
                'deskripsi' => 'Karakterisasi sifat magnetik material termasuk magnetisasi, koersivitas, dan permeabilitas magnetik menggunakan VSM dan SQUID.',
                'estimasiWaktu' => '3-4 hari kerja',
                'kategori' => 'Karakterisasi Material',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Simulasi Monte Carlo',
                'hargaPerSampel' => 500000,
                'deskripsi' => 'Simulasi Monte Carlo untuk sistem fisika kompleks, termasuk simulasi spin, difusi, dan fenomena transport dalam material.',
                'estimasiWaktu' => '1-2 minggu',
                'kategori' => 'Simulasi Komputasi',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Analisis Data Eksperimental',
                'hargaPerSampel' => 100000,
                'deskripsi' => 'Analisis statistik dan fitting data eksperimental menggunakan software khusus. Termasuk analisis regresi, curve fitting, dan visualisasi data.',
                'estimasiWaktu' => '1-2 hari kerja',
                'kategori' => 'Analisis Data',
                'isAvailable' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'namaPengujian' => 'Analisis Spektroskopi UV-Vis',
                'hargaPerSampel' => 150000,
                'deskripsi' => 'Spektroskopi UV-Vis untuk analisis absorpsi dan transmisi cahaya dalam rentang ultraviolet dan visible. Ideal untuk analisis senyawa organik.',
                'estimasiWaktu' => '1-2 hari kerja',
                'kategori' => 'Spektroskopi',
                'isAvailable' => true,
                'created_at' => Carbon::now()->addDay(),
                'updated_at' => Carbon::now()->addDay()
            ],
            [
                'namaPengujian' => 'Karakterisasi Material XRD',
                'hargaPerSampel' => 300000,
                'deskripsi' => 'Karakterisasi material menggunakan X-Ray Diffraction (XRD) untuk identifikasi fase, analisis kuantitatif, dan penentuan ukuran kristal.',
                'estimasiWaktu' => '3-4 hari kerja',
                'kategori' => 'Karakterisasi Material',
                'isAvailable' => true,
                'created_at' => Carbon::now()->addDay(),
                'updated_at' => Carbon::now()->addDay()
            ],
            [
                'namaPengujian' => 'Pengujian Konduktivitas Listrik',
                'hargaPerSampel' => 100000,
                'deskripsi' => 'Pengukuran konduktivitas listrik material dalam berbagai kondisi temperatur dan frekuensi menggunakan impedance analyzer.',
                'estimasiWaktu' => '2-3 hari kerja',
                'kategori' => 'Pengujian Listrik',
                'isAvailable' => true,
                'created_at' => Carbon::now()->addDay(),
                'updated_at' => Carbon::now()->addDay()
            ],
            [
                'namaPengujian' => 'Analisis Thermal DSC',
                'hargaPerSampel' => 250000,
                'deskripsi' => 'Differential Scanning Calorimetry (DSC) untuk analisis transisi fase, titik lebur, kristalisasi, dan stabilitas termal material.',
                'estimasiWaktu' => '2-3 hari kerja',
                'kategori' => 'Analisis Termal',
                'isAvailable' => true,
                'created_at' => Carbon::now()->addDay(),
                'updated_at' => Carbon::now()->addDay()
            ],
            [
                'namaPengujian' => 'Simulasi Dinamika Molekuler',
                'hargaPerSampel' => 400000,
                'deskripsi' => 'Simulasi dinamika molekuler untuk mempelajari perilaku atom dan molekul dalam sistem material pada skala nanometer.',
                'estimasiWaktu' => '1-2 minggu',
                'kategori' => 'Simulasi Komputasi',
                'isAvailable' => false,
                'created_at' => Carbon::now()->addDays(2),
                'updated_at' => Carbon::now()->addDays(2)
            ],
            [
                'namaPengujian' => 'Analisis FTIR Spektroskopi',
                'hargaPerSampel' => 175000,
                'deskripsi' => 'Fourier Transform Infrared (FTIR) spektroskopi untuk identifikasi gugus fungsi dan analisis struktur molekul senyawa organik dan anorganik.',
                'estimasiWaktu' => '1-2 hari kerja',
                'kategori' => 'Spektroskopi',
                'isAvailable' => true,
                'created_at' => Carbon::now()->addDays(2),
                'updated_at' => Carbon::now()->addDays(2)
            ],
            [
                'namaPengujian' => 'Pengujian Kekerasan Material',
                'hargaPerSampel' => 120000,
                'deskripsi' => 'Pengujian kekerasan material menggunakan metode Vickers, Brinell, dan Rockwell untuk karakterisasi sifat mekanik.',
                'estimasiWaktu' => '1 hari kerja',
                'kategori' => 'Karakterisasi Material',
                'isAvailable' => false,
                'created_at' => Carbon::now()->addDays(2),
                'updated_at' => Carbon::now()->addDays(2)
            ]
        ];

        foreach ($jenisPengujianData as $data) {
            JenisPengujian::create($data);
        }

        // Seed Biodata Pengurus
        $pengurusData = [
            [
                'nama' => 'Dr. Andi Setiawan, M.Si',
                'jabatan' => 'Kepala Laboratorium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Prof. Dr. Sari Indrawati',
                'jabatan' => 'Koordinator Penelitian',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Muhammad Rizki Pratama',
                'jabatan' => 'Asisten Laboratorium Senior',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Dewi Sartika',
                'jabatan' => 'Asisten Laboratorium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'jabatan' => 'Asisten Laboratorium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Putri Maharani',
                'jabatan' => 'Asisten Laboratorium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Budi Santoso',
                'jabatan' => 'Asisten Laboratorium Junior',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Rina Wulandari',
                'jabatan' => 'Asisten Laboratorium Junior',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($pengurusData as $data) {
            BiodataPengurus::create($data);
        }

        $this->command->info('Dummy data berhasil ditambahkan!');
        $this->command->info('- Kunjungan: ' . count($kunjunganData) . ' records');
        $this->command->info('- Jenis Pengujian: ' . count($jenisPengujianData) . ' records');
        $this->command->info('- Pengurus: ' . count($pengurusData) . ' records');
    }
} 