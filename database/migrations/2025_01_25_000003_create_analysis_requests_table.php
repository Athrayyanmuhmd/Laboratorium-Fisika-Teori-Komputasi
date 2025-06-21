<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analysis_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->unique();
            $table->string('researcher_name');
            $table->string('affiliation');
            $table->string('email');
            $table->enum('analysis_type', [
                'simulasi_numerik',
                'analisis_data_geofisika',
                'visualisasi_data',
                'laporan_komprehensif'
            ]);
            $table->text('data_description');
            $table->text('analysis_parameters');
            $table->date('target_deadline');
            $table->enum('status', ['pending', 'approved', 'rejected', 'in_progress', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->text('results')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('analyst_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analysis_requests');
    }
}; 