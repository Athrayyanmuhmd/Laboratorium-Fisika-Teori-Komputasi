<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and debug user authentication';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Checking Users in Database ===');
        $this->newLine();

        // Check existing users
        $users = User::all();
        $this->info("Found {$users->count()} users in database:");

        foreach ($users as $user) {
            $this->line("- ID: {$user->id} | Name: {$user->name} | Email: {$user->email} | Role: {$user->role}");
        }

        $this->newLine();
        $this->info('=== Checking Specific Users ===');

        // Check super admin
        $superAdmin = User::where('email', 'admin@fisika.unsyiah.ac.id')->first();
        if ($superAdmin) {
            $this->info("✅ Super Admin found: {$superAdmin->name} | Role: {$superAdmin->role}");
            $passwordCheck = Hash::check('admin2024', $superAdmin->password);
            $this->line("   Password verification (admin2024): " . ($passwordCheck ? "✅ CORRECT" : "❌ WRONG"));
        } else {
            $this->error("❌ Super Admin NOT found");
        }

        // Check lab admin
        $labAdmin = User::where('email', 'labadmin@fisika.unsyiah.ac.id')->first();
        if ($labAdmin) {
            $this->info("✅ Lab Admin found: {$labAdmin->name} | Role: {$labAdmin->role}");
            $passwordCheck = Hash::check('labadmin2024', $labAdmin->password);
            $this->line("   Password verification (labadmin2024): " . ($passwordCheck ? "✅ CORRECT" : "❌ WRONG"));
        } else {
            $this->warn("❌ Lab Admin NOT found - Creating now...");
            
            // Create lab admin if laboratory exists
            $lab = \App\Models\Laboratory::first();
            if ($lab) {
                $labAdmin = User::create([
                    'name' => 'Dr. Ahmad Syafii, M.Si.',
                    'email' => 'labadmin@fisika.unsyiah.ac.id',
                    'password' => Hash::make('labadmin2024'),
                    'role' => 'lab_admin',
                    'laboratory_id' => $lab->id,
                    'phone' => '0651-7551235',
                    'position' => 'Administrator Laboratorium',
                    'bio' => 'Administrator laboratorium yang bertanggung jawab atas operasional harian lab.',
                    'is_active' => true
                ]);
                $this->info("✅ Lab Admin created successfully!");
            } else {
                $this->error("❌ Cannot create lab admin: No laboratory found");
            }
        }

        // Check dosen
        $dosen = User::where('email', 'dosen@fisika.unsyiah.ac.id')->first();
        if ($dosen) {
            $this->info("✅ Dosen found: {$dosen->name} | Role: {$dosen->role}");
            $passwordCheck = Hash::check('dosen2024', $dosen->password);
            $this->line("   Password verification (dosen2024): " . ($passwordCheck ? "✅ CORRECT" : "❌ WRONG"));
        } else {
            $this->error("❌ Dosen NOT found");
        }

        $this->newLine();
        $this->info('=== Testing Role Methods ===');
        
        if ($superAdmin) {
            $this->line("Super Admin methods:");
            $this->line("- isAdmin(): " . ($superAdmin->isAdmin() ? "✅ TRUE" : "❌ FALSE"));
            $this->line("- isSuperAdmin(): " . ($superAdmin->isSuperAdmin() ? "✅ TRUE" : "❌ FALSE"));
            $this->line("- isLabAdmin(): " . ($superAdmin->isLabAdmin() ? "❌ TRUE" : "✅ FALSE"));
        }

        if ($labAdmin) {
            $this->line("Lab Admin methods:");
            $this->line("- isAdmin(): " . ($labAdmin->isAdmin() ? "✅ TRUE" : "❌ FALSE"));
            $this->line("- isSuperAdmin(): " . ($labAdmin->isSuperAdmin() ? "❌ TRUE" : "✅ FALSE"));
            $this->line("- isLabAdmin(): " . ($labAdmin->isLabAdmin() ? "✅ TRUE" : "❌ FALSE"));
        }

        $this->newLine();
        $this->info('=== SUMMARY ===');
        $this->line("Super Admin Login: admin@fisika.unsyiah.ac.id / admin2024");
        $this->line("Lab Admin Login: labadmin@fisika.unsyiah.ac.id / labadmin2024");
        $this->line("Dosen Login: dosen@fisika.unsyiah.ac.id / dosen2024");
        
        return 0;
    }
}
