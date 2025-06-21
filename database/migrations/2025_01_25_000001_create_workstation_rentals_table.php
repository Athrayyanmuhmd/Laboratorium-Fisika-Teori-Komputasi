<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workstation_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->unique();
            $table->string('name');
            $table->string('institution');
            $table->string('email');
            $table->enum('workstation_type', [
                'pc_high_performance',
                'software_geofisika',
                'tools_fotografi',
                'environment_programming'
            ]);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('research_purpose');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workstation_rentals');
    }
}; 