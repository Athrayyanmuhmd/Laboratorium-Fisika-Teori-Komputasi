<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // PC-01, PC-02, etc.
            $table->string('code')->unique(); // LAB-PC-001, LAB-PC-002, etc.
            $table->string('brand'); // ASUS, HP, Dell, etc.
            $table->string('model'); // VivoBook 15, EliteBook, etc.
            $table->text('specs'); // Intel i5, 8GB RAM, 256GB SSD
            $table->enum('status', ['available', 'in_use', 'maintenance', 'offline'])->default('available');
            $table->string('current_user')->nullable(); // Mahasiswa Fisika A, etc.
            $table->time('last_used')->nullable(); // Last time it was used
            $table->integer('usage_hours')->default(0); // Current session hours
            $table->integer('position_row'); // Row number (1-4)
            $table->integer('position_col'); // Column number (1-7)
            $table->text('notes')->nullable(); // Additional notes
            $table->boolean('is_active')->default(true); // Enable/disable computer
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['status', 'is_active']);
            $table->index(['position_row', 'position_col']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
