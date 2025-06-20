<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Laboratory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Laboratory first
        $lab = Laboratory::create([
            'name' => 'Laboratorium Fisika Teori dan Komputasi',
            'slug' => Str::slug('Laboratorium Fisika Teori dan Komputasi'),
            'description' => 'Laboratorium yang berfokus pada simulasi fisika, komputasi ilmiah, dan penelitian teori fisika menggunakan 28 PC yang tersedia untuk mahasiswa.',
            'vision' => 'Menjadi laboratorium unggulan dalam bidang fisika teori dan komputasi yang mendukung penelitian dan pembelajaran berkualitas tinggi.',
            'mission' => 'Menyediakan fasilitas komputasi terdepan untuk simulasi fisika, mendukung penelitian mahasiswa dan dosen, serta mengembangkan kemampuan komputasi ilmiah.',
            'location' => 'Gedung FMIPA Lantai 2',
            'head_of_lab' => 'Dr. Budi Santoso, M.Si.',
            'phone' => '0651-7551234',
            'email' => 'fisika.komputasi@unsyiah.ac.id',
            'facilities' => [
                '28 PC untuk simulasi dan komputasi',
                'Software simulasi fisika (MATLAB, Python, Mathematica)',
                'Akses internet berkecepatan tinggi',
                'Proyektor dan screen presentasi',
                'Whiteboard digital interaktif',
                'AC dan ventilasi yang baik',
                'Server komputasi khusus',
                'Kamera untuk dokumentasi'
            ],
            'operating_hours' => [
                'senin' => '08:00-17:00',
                'selasa' => '08:00-17:00',
                'rabu' => '08:00-17:00',
                'kamis' => '08:00-17:00',
                'jumat' => '08:00-17:00',
                'sabtu' => '08:00-12:00',
                'minggu' => 'Tutup'
            ],
            'staff' => [
                [
                    'name' => 'Dr. Budi Santoso, M.Si.',
                    'position' => 'Kepala Laboratorium',
                    'email' => 'admin@fisika.unsyiah.ac.id'
                ],
                [
                    'name' => 'Prof. Dr. Siti Aminah, M.Si.',
                    'position' => 'Dosen Senior',
                    'email' => 'dosen@fisika.unsyiah.ac.id'
                ]
            ],
            'status' => 'active',
            'image' => 'laboratory/lab-fisika-1.jpg'
        ]);

        // 🔑 AKTOR 1: ADMIN LABORATORIUM
        // Email: admin@fisika.unsyiah.ac.id | Password: admin2024
        User::create([
            'name' => 'Dr. Budi Santoso, M.Si.',
            'email' => 'admin@fisika.unsyiah.ac.id',
            'password' => Hash::make('admin2024'),
            'role' => 'super_admin',
            'laboratory_id' => $lab->id,
            'phone' => '0651-7551234',
            'position' => 'Kepala Laboratorium Fisika Komputasi',
            'bio' => 'Kepala Laboratorium Fisika Teori dan Komputasi. Bertanggung jawab atas manajemen fasilitas, persetujuan akses lab, dan koordinasi kegiatan penelitian.',
            'is_active' => true
        ]);

        // 🔑 AKTOR 2: DOSEN/PENELITI 
        // Email: dosen@fisika.unsyiah.ac.id | Password: dosen2024
        User::create([
            'name' => 'Prof. Dr. Siti Aminah, M.Si.',
            'email' => 'dosen@fisika.unsyiah.ac.id',
            'password' => Hash::make('dosen2024'),
            'role' => 'staff',
            'laboratory_id' => $lab->id,
            'phone' => '0651-7551235',
            'position' => 'Dosen Senior Fisika Teori',
            'bio' => 'Dosen senior dan peneliti utama di bidang fisika teori dan komputasi. Aktif melakukan konsultasi dan penelitian menggunakan fasilitas laboratorium.',
            'is_active' => true
        ]);

        $this->command->info('✅ Demo users created successfully!');
        $this->command->info('🔑 AKTOR 1 - Admin Lab: admin@fisika.unsyiah.ac.id / admin2024');
        $this->command->info('🔑 AKTOR 2 - Dosen: dosen@fisika.unsyiah.ac.id / dosen2024');
        $this->command->info('📍 Laboratory: ' . $lab->name);
    }
}
