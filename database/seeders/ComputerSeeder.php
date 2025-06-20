<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Computer;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing computers
        Computer::truncate();

        $computers = [];
        $brands = ['ASUS', 'HP', 'Dell', 'Lenovo'];
        $models = [
            'ASUS' => ['VivoBook 15', 'ROG Strix', 'ZenBook 14'],
            'HP' => ['EliteBook 840', 'Pavilion 15', 'ProBook 450'],
            'Dell' => ['Inspiron 15', 'Latitude 7420', 'OptiPlex 7090'],
            'Lenovo' => ['ThinkPad E15', 'IdeaPad 3', 'Legion 5']
        ];
        $specs = [
            'Intel i5-1135G7, 8GB RAM, 256GB SSD',
            'Intel i7-1165G7, 16GB RAM, 512GB SSD',
            'AMD Ryzen 5 5500U, 8GB RAM, 256GB SSD',
            'Intel i5-10210U, 8GB RAM, 1TB HDD + 128GB SSD',
            'AMD Ryzen 7 5700U, 16GB RAM, 512GB SSD'
        ];
        $statuses = ['available', 'in_use', 'maintenance'];
        $users = [
            'Mahasiswa Fisika A',
            'Mahasiswa Fisika B', 
            'Mahasiswa Kimia A',
            'Peneliti Lab Fisika',
            'Dosen Fisika Teori',
            'Mahasiswa S2 Fisika'
        ];

        // Create 28 computers in 4 rows x 7 columns
        $counter = 1;
        for ($row = 1; $row <= 4; $row++) {
            for ($col = 1; $col <= 7; $col++) {
                $brand = $brands[array_rand($brands)];
                $model = $models[$brand][array_rand($models[$brand])];
                $spec = $specs[array_rand($specs)];
                $status = $statuses[array_rand($statuses)];
                
                // Create some realistic usage patterns
                $currentUser = null;
                $lastUsed = null;
                $usageHours = 0;
                
                if ($status === 'in_use') {
                    $currentUser = $users[array_rand($users)];
                    $lastUsed = now()->format('H:i');
                    $usageHours = rand(1, 6);
                } elseif ($status === 'available' && rand(0, 1)) {
                    $lastUsed = now()->subHours(rand(1, 24))->format('H:i');
                }

                $computers[] = [
                    'name' => sprintf('PC-%02d', $counter),
                    'code' => sprintf('LAB-PC-%03d', $counter),
                    'brand' => $brand,
                    'model' => $model,
                    'specs' => $spec,
                    'status' => $status,
                    'current_user' => $currentUser,
                    'last_used' => $lastUsed,
                    'usage_hours' => $usageHours,
                    'position_row' => $row,
                    'position_col' => $col,
                    'notes' => $status === 'maintenance' ? 'Maintenance rutin bulanan' : null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                
                $counter++;
            }
        }

        // Insert all computers
        Computer::insert($computers);

        // Set some specific scenarios for demo
        $demoComputers = Computer::take(10)->get();
        
        // Set first 5 as available
        $demoComputers->take(5)->each(function ($computer) {
            $computer->update([
                'status' => 'available',
                'current_user' => null,
                'usage_hours' => 0
            ]);
        });

        // Set next 3 as in use
        $demoComputers->skip(5)->take(3)->each(function ($computer, $index) use ($users) {
            $computer->update([
                'status' => 'in_use',
                'current_user' => $users[$index % count($users)],
                'last_used' => now()->format('H:i'),
                'usage_hours' => rand(1, 4)
            ]);
        });

        // Set 2 as maintenance
        $demoComputers->skip(8)->take(2)->each(function ($computer) {
            $computer->update([
                'status' => 'maintenance',
                'current_user' => null,
                'usage_hours' => 0,
                'notes' => 'Update sistem operasi'
            ]);
        });

        $this->command->info('28 komputer berhasil dibuat dengan distribusi:');
        $this->command->info('- Tersedia: ' . Computer::available()->count());
        $this->command->info('- Sedang Digunakan: ' . Computer::inUse()->count());
        $this->command->info('- Maintenance: ' . Computer::maintenance()->count());
        $this->command->info('- Total: ' . Computer::count());
    }
}
