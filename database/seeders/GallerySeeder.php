<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\Laboratory;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laboratoryId = Laboratory::first()->id ?? 1;

        $galleryItems = [
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'PC Workstation Setup',
                'description' => 'Konfigurasi 28 unit PC untuk komputasi dan simulasi fisika',
                'image_path' => 'gallery/placeholder-equipment.jpg',
                'image_alt' => 'PC Workstation Setup',
                'category' => 'equipment',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Software Development Area',
                'description' => 'Area pengembangan aplikasi dan web design untuk penelitian',
                'image_path' => 'gallery/placeholder-facility.jpg',
                'image_alt' => 'Software Development Area',
                'category' => 'facility',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Data Analysis Station',
                'description' => 'Workstation khusus untuk analisis data geofisika dan komputasi',
                'image_path' => 'gallery/placeholder-analysis.jpg',
                'image_alt' => 'Data Analysis Station',
                'category' => 'equipment',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Digital Photography Lab',
                'description' => 'Studio fotografi digital dan editing untuk dokumentasi penelitian',
                'image_path' => 'gallery/placeholder-photo-lab.jpg',
                'image_alt' => 'Digital Photography Lab',
                'category' => 'facility',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Collaborative Workspace',
                'description' => 'Area kolaborasi untuk project tim dan diskusi penelitian',
                'image_path' => 'gallery/placeholder-workspace.jpg',
                'image_alt' => 'Collaborative Workspace',
                'category' => 'facility',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Server & Networking Infrastructure',
                'description' => 'Infrastruktur jaringan dan server laboratorium untuk komputasi terdistribusi',
                'image_path' => 'gallery/placeholder-server.jpg',
                'image_alt' => 'Server & Networking Infrastructure',
                'category' => 'equipment',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Research Activities',
                'description' => 'Dokumentasi kegiatan penelitian mahasiswa dan dosen',
                'image_path' => 'gallery/placeholder-research.jpg',
                'image_alt' => 'Research Activities',
                'category' => 'activity',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'laboratory_id' => $laboratoryId,
                'title' => 'Workshop Session',
                'description' => 'Kegiatan workshop dan pelatihan penggunaan software komputasi',
                'image_path' => 'gallery/placeholder-workshop.jpg',
                'image_alt' => 'Workshop Session',
                'category' => 'activity',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($galleryItems as $item) {
            Gallery::updateOrCreate(
                [
                    'title' => $item['title'],
                    'laboratory_id' => $item['laboratory_id']
                ],
                $item
            );
        }
    }
}
