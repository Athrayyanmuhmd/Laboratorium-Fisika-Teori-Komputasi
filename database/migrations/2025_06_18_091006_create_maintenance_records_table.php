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
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->enum('type', ['maintenance', 'calibration', 'repair', 'inspection'])->default('maintenance');
            $table->date('scheduled_date');
            $table->date('completed_date')->nullable();
            $table->text('description');
            $table->decimal('cost', 10, 2)->default(0);
            $table->string('technician_name')->nullable();
            $table->string('vendor')->nullable(); // Vendor yang melakukan maintenance
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->json('checklist')->nullable(); // Checklist items for maintenance
            $table->date('next_maintenance_date')->nullable();
            $table->json('documents')->nullable(); // Dokumen maintenance (sertifikat, laporan, dll)
            $table->enum('result', ['passed', 'failed', 'needs_attention'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
