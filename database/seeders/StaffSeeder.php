<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Laboratory;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laboratoryId = Laboratory::first()->id ?? 1;

        $staffMembers = [
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Dr. Ahmad Mustafa, M.Si',
                'position' => 'Dosen & Peneliti Senior',
                'email' => 'ahmad.mustafa@unsyiah.ac.id',
                'phone' => '+62 651 123456',
                'specialization' => 'Computational Physics, Quantum Mechanics',
                'education' => 'Ph.D in Physics, Institut Teknologi Bandung',
                'bio' => 'Ahli fisika komputasi dengan fokus pada simulasi quantum dan material science.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1
            ],
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Dr. Sarah Lestari, M.Kom',
                'position' => 'Dosen & Web Developer',
                'email' => 'sarah.lestari@unsyiah.ac.id',
                'phone' => '+62 651 123457',
                'specialization' => 'Web Development, Database Systems',
                'education' => 'Ph.D in Computer Science, Universitas Indonesia',
                'bio' => 'Spesialis pengembangan aplikasi web dan sistem manajemen laboratorium.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2
            ],
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Prof. Dr. Bakhtiar Rahman, M.Eng',
                'position' => 'Profesor & Kepala Lab',
                'email' => 'bakhtiar.rahman@unsyiah.ac.id',
                'phone' => '+62 651 123458',
                'specialization' => 'Geophysics, Data Analysis',
                'education' => 'Ph.D in Engineering Physics, Tokyo University',
                'bio' => 'Pakar geofisika dan analisis data dengan pengalaman internasional.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3
            ],
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Dr. Rizki Wahyudi, M.T',
                'position' => 'Dosen & System Administrator',
                'email' => 'rizki.wahyudi@unsyiah.ac.id',
                'phone' => '+62 651 123459',
                'specialization' => 'Network Systems, Linux Administration',
                'education' => 'Ph.D in Information Technology, Universitas Gadjah Mada',
                'bio' => 'Administrator sistem dengan keahlian dalam jaringan komputer dan server.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 4
            ],
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Dra. Mariana Sari, M.Pd',
                'position' => 'Dosen & Education Specialist',
                'email' => 'mariana.sari@unsyiah.ac.id',
                'phone' => '+62 651 123460',
                'specialization' => 'Physics Education, E-Learning',
                'education' => 'Master in Physics Education, Universitas Negeri Jakarta',
                'bio' => 'Ahli pendidikan fisika dengan fokus pada pembelajaran digital.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 5
            ],
            [
                'laboratory_id' => $laboratoryId,
                'name' => 'Muhammad Farid, S.Kom',
                'position' => 'Technical Staff',
                'email' => 'muhammad.farid@unsyiah.ac.id',
                'phone' => '+62 651 123461',
                'specialization' => 'Hardware Maintenance, Technical Support',
                'education' => 'Bachelor in Computer Science, Universitas Syiah Kuala',
                'bio' => 'Teknisi komputer dengan keahlian maintenance hardware dan software.',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 6
            ]
        ];

        foreach ($staffMembers as $staff) {
            Staff::create($staff);
        }
    }
}
