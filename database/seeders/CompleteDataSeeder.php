<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanItem;
use App\Models\Pengujian;
use App\Models\PengujianItem;
use App\Models\JenisPengujian;
use App\Models\Artikel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CompleteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Alat
        $alatData = [
            [
                'nama' => 'Spektrofotometer UV-Vis',
                'deskripsi' => 'Alat untuk analisis spektroskopi UV-Visible, mengukur absorbansi dan transmitansi sampel pada rentang panjang gelombang ultraviolet dan cahaya tampak',
                'stok' => 3,
                'isBroken' => false,
                'harga' => 125000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Mikroskop Elektron (SEM)',
                'deskripsi' => 'Scanning Electron Microscope untuk analisis morfologi dan struktur mikro material dengan resolusi tinggi hingga nanometer',
                'stok' => 1,
                'isBroken' => false,
                'harga' => 2500000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'X-Ray Diffractometer',
                'deskripsi' => 'Alat difraksi sinar-X untuk karakterisasi struktur kristal material, identifikasi fase, dan analisis parameter kisi',
                'stok' => 2,
                'isBroken' => false,
                'harga' => 800000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Universal Testing Machine',
                'deskripsi' => 'Mesin uji universal untuk pengujian sifat mekanik material seperti uji tarik, tekan, dan lentur',
                'stok' => 2,
                'isBroken' => true,
                'harga' => 450000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'DSC (Differential Scanning Calorimeter)',
                'deskripsi' => 'Alat analisis termal untuk mengukur aliran panas dan perubahan entalpi material selama pemanasan atau pendinginan',
                'stok' => 1,
                'isBroken' => false,
                'harga' => 350000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Multimeter Digital',
                'deskripsi' => 'Alat ukur listrik digital untuk mengukur tegangan, arus, resistansi, dan parameter kelistrikan lainnya',
                'stok' => 15,
                'isBroken' => false,
                'harga' => 2500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Oscilloscope Digital',
                'deskripsi' => 'Osiloskop digital untuk analisis sinyal listrik dan pengukuran bentuk gelombang dalam domain waktu',
                'stok' => 8,
                'isBroken' => false,
                'harga' => 15000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Function Generator',
                'deskripsi' => 'Generator fungsi untuk menghasilkan berbagai bentuk gelombang listrik seperti sinus, kotak, dan segitiga',
                'stok' => 6,
                'isBroken' => false,
                'harga' => 8500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($alatData as $data) {
            Alat::create($data);
        }

        // Seed Peminjaman
        $peminjamanData = [
            [
                'namaPeminjam' => 'Dr. Rina Sari - Universitas Brawijaya',
                'noHp' => '081234567890',
                'tujuanPeminjaman' => 'Penelitian karakterisasi material komposit untuk publikasi jurnal internasional',
                'tanggal_pinjam' => Carbon::now()->subDays(5),
                'tanggal_pengembalian' => Carbon::now()->addDays(2),
                'status' => 'PROCESSING',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'namaPeminjam' => 'Prof. Bambang Sutrisno - ITB',
                'noHp' => '081987654321',
                'tujuanPeminjaman' => 'Praktikum mahasiswa S2 Fisika Material untuk mata kuliah Karakterisasi Material',
                'tanggal_pinjam' => Carbon::now()->addDays(3),
                'tanggal_pengembalian' => Carbon::now()->addDays(10),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'namaPeminjam' => 'Ir. Ahmad Fauzi - PT Teknologi Material',
                'noHp' => '082345678901',
                'tujuanPeminjaman' => 'Pengujian kualitas produk material untuk sertifikasi ISO',
                'tanggal_pinjam' => Carbon::now()->subDays(14),
                'tanggal_pengembalian' => Carbon::now()->subDays(7),
                'status' => 'COMPLETED',
                'created_at' => Carbon::now()->subDays(21),
                'updated_at' => Carbon::now()->subDays(6)
            ],
            [
                'namaPeminjam' => 'Drs. Siti Nurhaliza - LIPI',
                'noHp' => '083456789012',
                'tujuanPeminjaman' => 'Kolaborasi penelitian nanomaterial untuk aplikasi energi terbarukan',
                'tanggal_pinjam' => Carbon::now()->addDays(7),
                'tanggal_pengembalian' => Carbon::now()->addDays(21),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ]
        ];

        foreach ($peminjamanData as $data) {
            Peminjaman::create($data);
        }

        // Seed Pengujian
        $pengujianData = [
            [
                'namaPenguji' => 'Dr. Maya Indrawati - Universitas Indonesia',
                'noHpPenguji' => '081234567890',
                'deskripsi' => 'Pengujian komprehensif material keramik untuk aplikasi suhu tinggi. Meliputi analisis XRD, SEM, dan uji mekanik.',
                'totalHarga' => 1200000,
                'tanggalPengujian' => Carbon::now()->addDays(5),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'namaPenguji' => 'Prof. Andi Setiawan - ITB',
                'noHpPenguji' => '081987654321',
                'deskripsi' => 'Karakterisasi material komposit polimer-karbon untuk aplikasi otomotif. Pengujian sifat mekanik dan termal.',
                'totalHarga' => 850000,
                'tanggalPengujian' => Carbon::now()->subDays(2),
                'status' => 'PROCESSING',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(1)
            ],
            [
                'namaPenguji' => 'Dr. Budi Santoso - UGM',
                'noHpPenguji' => '082345678901',
                'deskripsi' => 'Analisis spektroskopi UV-Vis untuk penentuan konsentrasi senyawa organik dalam sampel lingkungan.',
                'totalHarga' => 300000,
                'tanggalPengujian' => Carbon::now()->subDays(7),
                'status' => 'COMPLETED',
                'created_at' => Carbon::now()->subDays(14),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'namaPenguji' => 'Ir. Dewi Sartika - BATAN',
                'noHpPenguji' => '083456789012',
                'deskripsi' => 'Pengujian konduktivitas listrik material semikonduktor untuk aplikasi sel surya.',
                'totalHarga' => 450000,
                'tanggalPengujian' => Carbon::now()->addDays(12),
                'status' => 'PENDING',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)
            ]
        ];

        foreach ($pengujianData as $data) {
            Pengujian::create($data);
        }

        // Seed Artikel
        $artikelData = [
            [
                'namaAcara' => 'Workshop Simulasi Molekuler dengan LAMMPS',
                'deskripsi' => 'Workshop intensif tentang penggunaan software LAMMPS untuk simulasi dinamika molekuler. Peserta belajar dasar-dasar simulasi, setup sistem, dan analisis hasil untuk penelitian material.',
                'penulis' => 'Dr. Ahmad Hidayat & Tim Lab Fisika Komputasi',
                'tanggalAcara' => Carbon::now()->subDays(14),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10)
            ],
            [
                'namaAcara' => 'Seminar Nasional Fisika Komputasi 2024',
                'deskripsi' => 'Seminar nasional dengan tema "Inovasi Fisika Komputasi untuk Teknologi Masa Depan". Menghadirkan pembicara dari universitas terkemuka dan industri teknologi.',
                'penulis' => 'Panitia Seminar Nasional',
                'tanggalAcara' => Carbon::now()->subDays(30),
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25)
            ],
            [
                'namaAcara' => 'Pelatihan Analisis Data dengan Python',
                'deskripsi' => 'Pelatihan komprehensif penggunaan Python untuk analisis data ilmiah. Materi meliputi NumPy, Pandas, Matplotlib, dan SciPy untuk pengolahan data eksperimen.',
                'penulis' => 'Tim Asisten Laboratorium',
                'tanggalAcara' => Carbon::now()->subDays(21),
                'created_at' => Carbon::now()->subDays(18),
                'updated_at' => Carbon::now()->subDays(18)
            ],
            [
                'namaAcara' => 'Kunjungan Industri ke PT Teknologi Nusantara',
                'deskripsi' => 'Kunjungan edukatif mahasiswa ke industri teknologi untuk melihat aplikasi fisika komputasi dalam dunia industri. Diskusi dengan praktisi dan tour fasilitas R&D.',
                'penulis' => 'Koordinator Kunjungan Industri',
                'tanggalAcara' => Carbon::now()->subDays(45),
                'created_at' => Carbon::now()->subDays(40),
                'updated_at' => Carbon::now()->subDays(40)
            ],
            [
                'namaAcara' => 'Kompetisi Simulasi Fisika Mahasiswa',
                'deskripsi' => 'Kompetisi tahunan simulasi fisika untuk mahasiswa. Peserta membuat simulasi kreatif menggunakan berbagai software fisika komputasi dan mempresentasikan hasilnya.',
                'penulis' => 'Panitia Kompetisi',
                'tanggalAcara' => Carbon::now()->addDays(30),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5)
            ]
        ];

        foreach ($artikelData as $data) {
            Artikel::create($data);
        }

        $this->command->info('Complete data berhasil ditambahkan!');
        $this->command->info('- Alat: ' . count($alatData) . ' records');
        $this->command->info('- Peminjaman: ' . count($peminjamanData) . ' records');
        $this->command->info('- Pengujian: ' . count($pengujianData) . ' records');
        $this->command->info('- Artikel: ' . count($artikelData) . ' records');
    }
} 