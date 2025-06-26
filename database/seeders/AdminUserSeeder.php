<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user for authentication
        User::create([
            'name' => 'Admin Laboran',
            'email' => 'admin@fisika.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'lab_admin'
        ]);

        // Create super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@fisika.com',
            'password' => Hash::make('superadmin123'),
            'email_verified_at' => now(),
            'role' => 'super_admin'
        ]);
    }
}
