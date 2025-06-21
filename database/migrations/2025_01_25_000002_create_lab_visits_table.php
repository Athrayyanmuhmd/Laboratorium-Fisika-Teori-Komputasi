<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_code')->unique();
            $table->string('pic_name');
            $table->string('institution');
            $table->string('contact');
            $table->enum('visit_type', [
                'tur_fasilitas',
                'workshop_simulasi',
                'demo_software',
                'konsultasi_ahli'
            ]);
            $table->date('visit_date');
            $table->integer('participant_count');
            $table->text('purpose_expectations');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_visits');
    }
}; 