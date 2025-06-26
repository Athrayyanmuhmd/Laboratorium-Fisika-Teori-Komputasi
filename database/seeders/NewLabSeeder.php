<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Admin, Alat, JenisPengujian, ProfilLaboratorium, Misi, BiodataPengurus, Artikel};
use Illuminate\Support\Str;

class NewLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin User
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
            'role' => 'ADMIN'
        ]);

        // 2. Create Misi
        $misi = Misi::create([
            'pointMisi' => 'Menyediakan layanan laboratorium fisika komputasi terbaik untuk mendukung pendidikan dan penelitian'
        ]);

        // 3. Create Profil Laboratorium
        ProfilLaboratorium::create([
            'namaLaboratorium' => 'Laboratorium Fisika Komputasi',
            'tentangLaboratorium' => 'Laboratorium Fisika Komputasi adalah fasilitas penelitian dan pendidikan yang menyediakan berbagai layanan analisis, pengujian, dan simulasi untuk mendukung perkembangan ilmu fisika dan teknologi.',
            'visi' => 'Menjadi pusat unggulan dalam bidang fisika komputasi dan simulasi untuk mendukung inovasi teknologi berkelanjutan',
            'misiId' => $misi->id
        ]);

        // 4. Create Sample Alat
        $alatData = [
            ['nama' => 'Mikroskop Digital', 'deskripsi' => 'Mikroskop digital dengan pembesaran hingga 1000x', 'stok' => 5, 'harga' => 15000000],
            ['nama' => 'Komputer Workstation', 'deskripsi' => 'Komputer high-end untuk simulasi dan analisis', 'stok' => 10, 'harga' => 25000000],
            ['nama' => 'Sensor Suhu Digital', 'deskripsi' => 'Sensor suhu presisi tinggi', 'stok' => 20, 'harga' => 500000],
            ['nama' => 'Oscilloscope', 'deskripsi' => 'Oscilloscope digital 4 channel', 'stok' => 3, 'harga' => 12000000],
            ['nama' => 'Function Generator', 'deskripsi' => 'Generator sinyal untuk pengujian elektronik', 'stok' => 2, 'harga' => 8000000],
        ];

        foreach ($alatData as $alat) {
            Alat::create($alat);
        }

        // 5. Create Jenis Pengujian
        $jenisPengujianData = [
            ['namaPengujian' => 'Analisis Spektroskopi', 'hargaPerSampel' => 150000],
            ['namaPengujian' => 'Pengujian Konduktivitas Termal', 'hargaPerSampel' => 200000],
            ['namaPengujian' => 'Analisis Struktur Kristal', 'hargaPerSampel' => 300000],
            ['namaPengujian' => 'Pengujian Sifat Magnetik', 'hargaPerSampel' => 250000],
            ['namaPengujian' => 'Simulasi Monte Carlo', 'hargaPerSampel' => 500000],
            ['namaPengujian' => 'Analisis Data Eksperimental', 'hargaPerSampel' => 100000],
        ];

        foreach ($jenisPengujianData as $jenis) {
            JenisPengujian::create($jenis);
        }

        // 6. Create Sample Pengurus
        $pengurusData = [
            ['nama' => 'Dr. Ahmad Susanto, M.Si', 'jabatan' => 'Kepala Laboratorium'],
            ['nama' => 'Dr. Siti Nurhaliza, M.Sc', 'jabatan' => 'Koordinator Penelitian'],
            ['nama' => 'Budi Prasetyo, S.Si', 'jabatan' => 'Teknisi Senior'],
            ['nama' => 'Rina Kusumawati, S.Kom', 'jabatan' => 'Administrator Sistem'],
        ];

        foreach ($pengurusData as $pengurus) {
            BiodataPengurus::create($pengurus);
        }

        // 7. Create Sample Artikel
        $artikelData = [
            [
                'namaAcara' => 'Workshop Simulasi Molecular Dynamics',
                'deskripsi' => 'Workshop intensif tentang simulasi molecular dynamics menggunakan software LAMMPS dan GROMACS untuk penelitian material',
                'penulis' => 'Tim Laboratorium',
                'tanggalAcara' => now()->subDays(30)
            ],
            [
                'namaAcara' => 'Seminar Fisika Komputasi Terkini',
                'deskripsi' => 'Seminar nasional membahas perkembangan terbaru dalam bidang fisika komputasi dan aplikasinya dalam industri',
                'penulis' => 'Dr. Ahmad Susanto',
                'tanggalAcara' => now()->subDays(15)
            ],
            [
                'namaAcara' => 'Pelatihan Analisis Data dengan Python',
                'deskripsi' => 'Pelatihan praktis penggunaan Python untuk analisis data eksperimen fisika',
                'penulis' => 'Rina Kusumawati',
                'tanggalAcara' => now()->subDays(7)
            ],
        ];

        foreach ($artikelData as $artikel) {
            Artikel::create($artikel);
        }
    }
}
