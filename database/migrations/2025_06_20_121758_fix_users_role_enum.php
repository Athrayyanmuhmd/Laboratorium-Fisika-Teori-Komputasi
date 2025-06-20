<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Update existing data to valid values first
        DB::table('users')->where('role', 'admin')->update(['role' => 'dosen']);
        
        // Step 2: Change column to varchar temporarily
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(20) DEFAULT 'user'");
        
        // Step 3: Update the data to correct roles
        DB::table('users')
            ->where('email', 'admin@fisika.unsyiah.ac.id')
            ->update(['role' => 'super_admin']);
            
        // Step 4: Create lab admin if not exists
        $labAdminExists = DB::table('users')
            ->where('email', 'labadmin@fisika.unsyiah.ac.id')
            ->exists();
            
        if (!$labAdminExists) {
            $lab = DB::table('laboratories')->first();
            if ($lab) {
                DB::table('users')->insert([
                    'name' => 'Dr. Ahmad Syafii, M.Si.',
                    'email' => 'labadmin@fisika.unsyiah.ac.id',
                    'password' => bcrypt('labadmin2024'),
                    'role' => 'lab_admin',
                    'laboratory_id' => $lab->id,
                    'phone' => '0651-7551235',
                    'position' => 'Administrator Laboratorium',
                    'bio' => 'Administrator laboratorium yang bertanggung jawab atas operasional harian lab.',
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        // Step 5: Convert back to ENUM with all needed values
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'lab_admin', 'dosen', 'staff', 'user') DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('dosen', 'staff', 'user') DEFAULT 'user'");
    }
};
