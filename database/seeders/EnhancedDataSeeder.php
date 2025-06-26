<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Alat, MaintenanceLog, Notification, PengujianFile, Pengujian, Kunjungan, PeminjamanItem};
use Carbon\Carbon;
use Illuminate\Support\Str;

class EnhancedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing Alat with new fields
        $alatData = [
            [
                'id' => Alat::first()->id ?? Str::uuid(),
                'updates' => [
                    'kode_alat' => 'SFU-001',
                    'lokasi_penyimpanan' => 'Lab Fisika Komputasi - Rak A1',
                    'tanggal_kalibrasi_terakhir' => Carbon::now()->subMonths(10),
                    'tanggal_kalibrasi_berikutnya' => Carbon::now()->addMonths(2),
                    'status_kalibrasi' => 'VALID',
                    'riwayat_maintenance' => 'Kalibrasi terakhir: ' . Carbon::now()->subMonths(10)->format('d/m/Y') . ' - Status: Baik'
                ]
            ],
        ];

        // Update existing alat with enhanced data
        $existingAlat = Alat::take(8)->get();
        foreach ($existingAlat as $index => $alat) {
            $alat->update([
                'kode_alat' => 'LAB-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'lokasi_penyimpanan' => 'Lab Fisika Komputasi - Rak ' . chr(65 + ($index % 4)) . ($index % 3 + 1),
                'tanggal_kalibrasi_terakhir' => Carbon::now()->subMonths(rand(1, 18)),
                'tanggal_kalibrasi_berikutnya' => Carbon::now()->addMonths(rand(1, 6)),
                'status_kalibrasi' => $index < 2 ? 'EXPIRED' : ($index < 4 ? 'PENDING' : 'VALID'),
                'riwayat_maintenance' => 'Pemeliharaan rutin dilakukan setiap 6 bulan. Status: ' . ($index % 2 == 0 ? 'Baik' : 'Perlu Perhatian')
            ]);
        }

        // Create MaintenanceLog data
        $maintenanceData = [
            [
                'alat_id' => $existingAlat[0]->id ?? Str::uuid(),
                'jenis_maintenance' => 'KALIBRASI',
                'tanggal_maintenance' => Carbon::now()->addDays(3),
                'deskripsi_kegiatan' => 'Kalibrasi spektrofotometer UV-Vis dengan standar kalibrasi bersertifikat. Meliputi pengecekan akurasi wavelength, photometric accuracy, dan baseline noise.',
                'biaya' => 2500000,
                'teknisi' => 'Dr. Ahmad Rizki, M.Si',
                'status' => 'DIJADWALKAN',
                'catatan' => 'Kalibrasi urgent karena akan digunakan untuk penelitian mahasiswa S2'
            ],
            [
                'alat_id' => $existingAlat[1]->id ?? Str::uuid(),
                'jenis_maintenance' => 'PREVENTIF',
                'tanggal_maintenance' => Carbon::now()->subDays(5),
                'deskripsi_kegiatan' => 'Pembersihan menyeluruh mikroskop elektron, pengecekan sistem vakum, cleaning electron gun, dan kalibrasi magnifikasi.',
                'biaya' => 5000000,
                'teknisi' => 'Tim Maintenance PT. Scientific Solutions',
                'status' => 'SELESAI',
                'catatan' => 'Maintenance berhasil, semua sistem normal. Performa imaging meningkat 15%'
            ],
            [
                'alat_id' => $existingAlat[2]->id ?? Str::uuid(),
                'jenis_maintenance' => 'KOREKTIF',
                'tanggal_maintenance' => Carbon::now()->subDays(2),
                'deskripsi_kegiatan' => 'Perbaikan sistem cooling XRD yang mengalami overheating. Penggantian thermal paste dan cleaning heat sink.',
                'biaya' => 1200000,
                'teknisi' => 'Budi Santoso - Teknisi Internal',
                'status' => 'SEDANG_PROSES',
                'catatan' => 'Spare part sudah dipesan, estimasi selesai 2 hari lagi'
            ],
            [
                'alat_id' => $existingAlat[3]->id ?? Str::uuid(),
                'jenis_maintenance' => 'PEMBERSIHAN',
                'tanggal_maintenance' => Carbon::now()->addDays(7),
                'deskripsi_kegiatan' => 'Pembersihan rutin laboratorium komputasi, cleaning workstation, update software, dan backup data.',
                'biaya' => 300000,
                'teknisi' => 'Tim Kebersihan Lab',
                'status' => 'DIJADWALKAN',
                'catatan' => 'Pembersihan mingguan rutin'
            ],
            [
                'alat_id' => $existingAlat[4]->id ?? Str::uuid(),
                'jenis_maintenance' => 'KALIBRASI',
                'tanggal_maintenance' => Carbon::now()->subDays(10),
                'deskripsi_kegiatan' => 'Kalibrasi timbangan analitik dengan anak timbang standar. Pengecekan linearitas dan repeatability.',
                'biaya' => 800000,
                'teknisi' => 'PT. Kalibrasi Indonesia',
                'status' => 'SELESAI',
                'catatan' => 'Sertifikat kalibrasi telah diterbitkan, valid hingga 1 tahun'
            ]
        ];

        foreach ($maintenanceData as $data) {
            MaintenanceLog::create($data);
        }

        // Create enhanced Pengujian data with results
        $existingPengujian = Pengujian::take(3)->get();
        foreach ($existingPengujian as $index => $pengujian) {
            $pengujian->update([
                'hasil_pengujian' => $this->generateTestResults($index),
                'tanggal_selesai' => $index < 2 ? Carbon::now()->subDays(rand(1, 10)) : null,
                'catatan_tambahan' => $this->generateTestNotes($index),
                'petugas_pengujian' => 'Dr. ' . ['Sarah Putri', 'Ahmad Fauzi', 'Rina Sari'][$index] . ', M.Si',
                'progress_persentase' => [100, 85, 45][$index],
            ]);
        }

        // Create PengujianFile data
        $fileData = [
            [
                'pengujian_id' => $existingPengujian[0]->id ?? Str::uuid(),
                'nama_file' => 'Hasil_Analisis_XRD_Sample_001.pdf',
                'path_file' => 'storage/pengujian/hasil_analisis_xrd_001.pdf',
                'tipe_file' => 'application/pdf',
                'ukuran_file' => 2048576, // 2MB
                'kategori' => 'HASIL_ANALISIS',
                'deskripsi' => 'Hasil analisis struktur kristal menggunakan X-Ray Diffraction'
            ],
            [
                'pengujian_id' => $existingPengujian[0]->id ?? Str::uuid(),
                'nama_file' => 'Laporan_Lengkap_Pengujian_001.docx',
                'path_file' => 'storage/pengujian/laporan_lengkap_001.docx',
                'tipe_file' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'ukuran_file' => 5242880, // 5MB
                'kategori' => 'LAPORAN',
                'deskripsi' => 'Laporan komprehensif hasil pengujian dan analisis'
            ],
            [
                'pengujian_id' => $existingPengujian[1]->id ?? Str::uuid(),
                'nama_file' => 'Data_Mentah_SEM_Imaging.zip',
                'path_file' => 'storage/pengujian/data_mentah_sem.zip',
                'tipe_file' => 'application/zip',
                'ukuran_file' => 15728640, // 15MB
                'kategori' => 'DATA_RAW',
                'deskripsi' => 'Data mentah hasil imaging SEM dalam berbagai magnifikasi'
            ]
        ];

        foreach ($fileData as $data) {
            PengujianFile::create($data);
        }

        // Update Kunjungan with enhanced data
        $existingKunjungan = Kunjungan::take(3)->get();
        foreach ($existingKunjungan as $index => $kunjungan) {
            $kunjungan->update([
                'tanggal_kunjungan' => Carbon::now()->addDays(rand(1, 30)),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '12:00:00',
                'jenis_kunjungan' => ['Kunjungan Edukatif', 'Kunjungan Riset', 'Kunjungan Industri'][$index],
                'catatan_kunjungan' => $this->generateVisitNotes($index),
                'petugas_pemandu' => ['Dr. Lisa Maharani', 'Prof. Bambang Sutrisno', 'Dr. Indira Sari'][$index] . ', M.Si',
            ]);
        }

        // Update PeminjamanItem with condition tracking
        $existingPeminjamanItems = PeminjamanItem::take(5)->get();
        foreach ($existingPeminjamanItems as $index => $item) {
            $item->update([
                'kondisi_saat_pinjam' => 'BAIK',
                'kondisi_saat_kembali' => $index < 3 ? 'BAIK' : ($index == 3 ? 'RUSAK_RINGAN' : null),
                'catatan_kondisi' => $index == 3 ? 'Ditemukan goresan kecil pada bagian casing' : 'Kondisi alat baik, tidak ada kerusakan',
                'tanggal_dikembalikan' => $index < 4 ? Carbon::now()->subDays(rand(1, 5)) : null,
                'petugas_penerima' => $index < 4 ? 'Laboran ' . ['Ahmad', 'Siti', 'Budi', 'Rina'][$index] : null,
            ]);
        }

        // Create comprehensive Notifications
        $notificationData = [
            [
                'title' => 'Kalibrasi Urgent Diperlukan',
                'message' => 'Spektrofotometer UV-Vis memerlukan kalibrasi segera sebelum digunakan untuk penelitian. Jadwal kalibrasi: 3 hari lagi.',
                'type' => 'WARNING',
                'category' => 'MAINTENANCE',
                'related_id' => $existingAlat[0]->id,
                'related_type' => Alat::class,
                'is_read' => false,
            ],
            [
                'title' => 'Maintenance Selesai',
                'message' => 'Maintenance preventif mikroskop elektron telah selesai dilakukan. Semua sistem berfungsi normal dengan peningkatan performa 15%.',
                'type' => 'SUCCESS',
                'category' => 'MAINTENANCE',
                'related_id' => MaintenanceLog::first()->id ?? Str::uuid(),
                'related_type' => MaintenanceLog::class,
                'is_read' => false,
            ],
            [
                'title' => 'Pengujian Selesai',
                'message' => 'Pengujian XRD untuk sample 001 telah selesai. Hasil analisis dan laporan lengkap sudah tersedia untuk diunduh.',
                'type' => 'SUCCESS',
                'category' => 'PENGUJIAN',
                'related_id' => $existingPengujian[0]->id,
                'related_type' => Pengujian::class,
                'is_read' => false,
            ],
            [
                'title' => 'Peminjaman Baru',
                'message' => 'Permintaan peminjaman alat baru dari Universitas Teknologi Bandung untuk penelitian kolaborasi.',
                'type' => 'INFO',
                'category' => 'PEMINJAMAN',
                'related_id' => Str::uuid(),
                'related_type' => 'Peminjaman',
                'is_read' => false,
            ],
            [
                'title' => 'Kunjungan Terjadwal',
                'message' => 'Kunjungan edukatif dari SMA Negeri 1 Banda Aceh telah dijadwalkan untuk minggu depan. Persiapan materi presentasi diperlukan.',
                'type' => 'INFO',
                'category' => 'KUNJUNGAN',
                'related_id' => $existingKunjungan[0]->id,
                'related_type' => Kunjungan::class,
                'is_read' => false,
            ]
        ];

        foreach ($notificationData as $data) {
            Notification::create($data);
        }

        $this->command->info('Enhanced data seeded successfully!');
        $this->command->info('- Updated ' . $existingAlat->count() . ' alat with maintenance data');
        $this->command->info('- Created ' . count($maintenanceData) . ' maintenance logs');
        $this->command->info('- Enhanced ' . $existingPengujian->count() . ' pengujian with results');
        $this->command->info('- Created ' . count($fileData) . ' test result files');
        $this->command->info('- Updated ' . $existingKunjungan->count() . ' kunjungan with details');
        $this->command->info('- Created ' . count($notificationData) . ' notifications');
    }

    private function generateTestResults($index)
    {
        $results = [
            'Analisis XRD menunjukkan struktur kristal yang sesuai dengan referensi standar. Puncak-puncak difraksi teridentifikasi dengan jelas pada sudut 2θ: 25.3°, 37.8°, 48.1°, dan 62.5°. Intensitas relatif menunjukkan kristal dengan orientasi preferensial pada bidang (100). Ukuran kristal rata-rata: 45.2 nm. Tingkat kristalinitas: 87.3%.',
            
            'Hasil imaging SEM menunjukkan morfologi permukaan yang homogen dengan ukuran partikel rata-rata 125 ± 15 nm. Distribusi ukuran partikel mengikuti pola normal dengan standar deviasi 12%. Tidak ditemukan aglomerasi signifikan. Analisis EDS menunjukkan komposisi unsur sesuai dengan target: C (65.2%), O (28.1%), Si (4.3%), Al (2.4%).',
            
            'Pengujian spektroskopi FTIR mengidentifikasi gugus fungsi karakteristik pada bilangan gelombang: 3450 cm⁻¹ (O-H stretching), 2925 cm⁻¹ (C-H stretching), 1635 cm⁻¹ (C=O stretching), dan 1095 cm⁻¹ (C-O stretching). Spektrum menunjukkan keberhasilan sintesis dengan kemurnian tinggi. Tidak ada puncak impuritas yang terdeteksi.'
        ];

        return $results[$index] ?? 'Hasil pengujian sedang dalam proses analisis.';
    }

    private function generateTestNotes($index)
    {
        $notes = [
            'Pengujian dilakukan dalam kondisi lingkungan terkontrol (T: 25°C, RH: 45%). Sample preparation menggunakan metode standar. Kalibrasi alat telah dilakukan sebelum pengujian. Hasil dapat digunakan untuk publikasi ilmiah.',
            
            'Sample coating menggunakan Au dengan ketebalan 5 nm. Accelerating voltage: 15 kV. Working distance: 10 mm. Resolusi optimal tercapai pada magnifikasi 50,000x. Dokumentasi lengkap tersimpan dalam database.',
            
            'Preparasi sample menggunakan teknik KBr pellet. Background correction telah dilakukan. Resolusi spektral: 4 cm⁻¹. Scan range: 4000-400 cm⁻¹. Data telah dikonfirmasi dengan database spektral standar.'
        ];

        return $notes[$index] ?? 'Catatan pengujian akan ditambahkan setelah analisis selesai.';
    }

    private function generateVisitNotes($index)
    {
        $notes = [
            'Kunjungan edukatif untuk 30 siswa SMA. Agenda: presentasi fasilitas lab, demo penggunaan alat, hands-on experience sederhana. Durasi: 3 jam. Materi: pengenalan fisika komputasi dan aplikasinya.',
            
            'Kunjungan riset kolaboratif dengan tim dari Institut Teknologi. Fokus: pengembangan material nanoteknologi. Diskusi teknis dan sharing facility. Potensi MOU untuk penelitian bersama.',
            
            'Kunjungan industri dari PT. Advanced Materials Indonesia. Tujuan: eksplorasi layanan testing dan karakterisasi material. Presentasi capabilities lab dan tarif layanan komersial.'
        ];

        return $notes[$index] ?? 'Catatan kunjungan akan ditambahkan setelah kegiatan berlangsung.';
    }
} 