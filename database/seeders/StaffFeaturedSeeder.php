<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Gallery;
use App\Models\Laboratory;

class StaffFeaturedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first laboratory or create one
        $lab = Laboratory::first();
        if (!$lab) {
            $lab = Laboratory::create([
                'name' => 'Lab Fisika Komputasi',
                'description' => 'Laboratorium Fisika Teori dan Komputasi',
                'status' => 'active'
            ]);
        }

        // Add sample staff data
        $staffData = [
            [
                'laboratory_id' => $lab->id,
                'name' => 'Dr. Mustapa, M.Si',
                'position' => 'Dosen & Peneliti',
                'specialization' => 'Computational Physics',
                'email' => 'mustapa@unsyiah.ac.id',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'laboratory_id' => $lab->id,
                'name' => 'Dr. Ahmad Rahman, M.Sc',
                'position' => 'Dosen & Peneliti',
                'specialization' => 'Theoretical Physics',
                'email' => 'ahmad.rahman@unsyiah.ac.id',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'laboratory_id' => $lab->id,
                'name' => 'Dr. Siti Nurhaliza, M.Si',
                'position' => 'Dosen & Peneliti',
                'specialization' => 'Mathematical Physics',
                'email' => 'siti.nurhaliza@unsyiah.ac.id',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'laboratory_id' => $lab->id,
                'name' => 'Muhammad Fadli, S.Si, M.T',
                'position' => 'Asisten Laboratorium',
                'specialization' => 'Computer Science',
                'email' => 'fadli@unsyiah.ac.id',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'laboratory_id' => $lab->id,
                'name' => 'Nuraida, S.Kom, M.T',
                'position' => 'Teknisi Lab',
                'specialization' => 'Web Development',
                'email' => 'nuraida@unsyiah.ac.id',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($staffData as $data) {
            Staff::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        // Add sample gallery data
        $galleryData = [
            [
                'laboratory_id' => $lab->id,
                'title' => 'Ruang Utama Lab',
                'description' => '28 PC Workstation untuk komputasi dan simulasi fisika',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'laboratory_id' => $lab->id,
                'title' => 'PC Workstations',
                'description' => 'High-Performance Computing untuk simulasi',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'laboratory_id' => $lab->id,
                'title' => 'Studio Fotografi',
                'description' => 'Digital Photography & Editing workspace',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'laboratory_id' => $lab->id,
                'title' => 'Web Development Area',
                'description' => 'Programming & Design Hub',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'laboratory_id' => $lab->id,
                'title' => 'Software Geofisika',
                'description' => 'Earth Science Analysis Tools',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'laboratory_id' => $lab->id,
                'title' => 'Area Simulasi',
                'description' => 'Computational Physics & Numerical Modeling',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($galleryData as $data) {
            Gallery::updateOrCreate(
                ['title' => $data['title'], 'laboratory_id' => $lab->id],
                $data
            );
        }

        $this->command->info('Featured staff and gallery data seeded successfully!');
    }
} 