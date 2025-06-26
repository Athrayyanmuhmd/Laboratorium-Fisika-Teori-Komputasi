<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // 🔑 AKTOR 1: ADMIN LABORATORIUM
        // Email: admin@fisika.unsyiah.ac.id | Password: admin2024
        User::create([
            'name' => 'Dr. Budi Santoso, M.Si.',
            'email' => 'admin@fisika.unsyiah.ac.id',
            'password' => Hash::make('admin2024'),
            'role' => 'super_admin',
            'phone' => '0651-7551234',
            'position' => 'Kepala Laboratorium Fisika Komputasi',
            'bio' => 'Kepala Laboratorium Fisika Teori dan Komputasi. Bertanggung jawab atas manajemen fasilitas, persetujuan akses lab, dan koordinasi kegiatan penelitian.',
            'is_active' => true
        ]);

        // 🔑 AKTOR 2: LAB ADMIN 
        // Email: labadmin@fisika.unsyiah.ac.id | Password: labadmin2024
        User::create([
            'name' => 'Dr. Ahmad Syafii, M.Si.',
            'email' => 'labadmin@fisika.unsyiah.ac.id',
            'password' => Hash::make('labadmin2024'),
            'role' => 'lab_admin',
            'phone' => '0651-7551235',
            'position' => 'Administrator Laboratorium',
            'bio' => 'Administrator laboratorium yang bertanggung jawab atas operasional harian lab, maintenance peralatan, dan bantuan teknis untuk pengguna.',
            'is_active' => true
        ]);

        // 🔑 AKTOR 3: DOSEN/PENELITI 
        // Email: dosen@fisika.unsyiah.ac.id | Password: dosen2024
        User::create([
            'name' => 'Prof. Dr. Siti Aminah, M.Si.',
            'email' => 'dosen@fisika.unsyiah.ac.id',
            'password' => Hash::make('dosen2024'),
            'role' => 'staff',
            'phone' => '0651-7551236',
            'position' => 'Dosen Senior Fisika Teori',
            'bio' => 'Dosen senior dan peneliti utama di bidang fisika teori dan komputasi. Aktif melakukan konsultasi dan penelitian menggunakan fasilitas laboratorium.',
            'is_active' => true
        ]);

        $this->command->info('✅ Demo users created successfully!');
        $this->command->info('👑 SUPER ADMIN: admin@fisika.unsyiah.ac.id / admin2024 (Full System Access)');
        $this->command->info('🔧 LAB ADMIN: labadmin@fisika.unsyiah.ac.id / labadmin2024 (Lab Operations Only)');
        $this->command->info('👨‍🏫 DOSEN: dosen@fisika.unsyiah.ac.id / dosen2024 (Limited Access)');
    }
}
