<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;
use App\Models\Laboratory;
use Carbon\Carbon;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $lab = Laboratory::first();
        
        if (!$lab) {
            $this->command->warn('Laboratorium belum ada. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // Create only a few sample equipment for testing
        $sampleEquipment = [
            [
                'code' => 'PC-001',
                'name' => 'PC Simulasi #1',
                'description' => 'Komputer desktop untuk simulasi fisika dan komputasi ilmiah. Dilengkapi dengan software simulasi dan programming tools.',
                'specifications' => [
                    'processor' => 'Intel Core i7-10700K',
                    'ram' => '16 GB DDR4',
                    'storage' => '512 GB SSD + 1 TB HDD',
                    'gpu' => 'NVIDIA GTX 1660 Super',
                    'os' => 'Windows 10 Pro',
                    'software' => [
                        'MATLAB R2023b',
                        'Python 3.11 + Scientific Libraries',
                        'OriginPro',
                        'Mathematica',
                        'Visual Studio Code',
                        'Microsoft Office 2021'
                    ]
                ],
                'brand' => 'Custom Build',
                'model' => 'Workstation 2023',
                'purchase_year' => 2023,
                'purchase_price' => 15000000,
                'quantity' => 1,
                'available_quantity' => 1,
                'condition' => 'excellent',
                'status' => 'available',
                'category' => 'komputer',
                'last_calibration' => Carbon::now()->subMonths(3),
                'next_calibration' => Carbon::now()->addMonths(9),
                'rental_price_per_day' => 0,
                'notes' => "PC untuk simulasi fisika dan komputasi. Tersedia software lengkap untuk penelitian dan praktikum."
            ],
            [
                'code' => 'PROJ-001',
                'name' => 'Proyektor LCD',
                'description' => 'Proyektor untuk presentasi dan demonstrasi',
                'specifications' => [
                    'resolution' => '1920x1080 Full HD',
                    'brightness' => '3500 lumens',
                    'contrast' => '10000:1',
                    'connectivity' => 'HDMI, VGA, USB, WiFi'
                ],
                'brand' => 'Epson',
                'model' => 'EB-X51',
                'purchase_year' => 2022,
                'purchase_price' => 8000000,
                'quantity' => 1,
                'available_quantity' => 1,
                'condition' => 'good',
                'status' => 'available',
                'category' => 'elektronik',
                'last_calibration' => Carbon::now()->subMonths(2),
                'next_calibration' => Carbon::now()->addYear(),
                'rental_price_per_day' => 50000,
                'notes' => 'Peralatan pendukung untuk kegiatan laboratorium'
            ]
        ];

        foreach ($sampleEquipment as $equipment) {
            Equipment::create(array_merge([
                'laboratory_id' => $lab->id,
            ], $equipment));
        }

        $this->command->info('Equipment seeder completed: ' . Equipment::count() . ' sample items created.');
    }
}
