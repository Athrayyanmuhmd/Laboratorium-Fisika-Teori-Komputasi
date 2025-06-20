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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_code')->unique(); // Kode kunjungan
            $table->foreignId('laboratory_id')->constrained('laboratories')->onDelete('cascade');
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->string('visitor_phone');
            $table->string('institution');
            $table->string('group_leader')->nullable();
            $table->integer('participant_count');
            $table->enum('visit_type', ['education', 'research', 'tour', 'collaboration'])->default('education');
            $table->text('purpose'); // Tujuan kunjungan
            $table->date('preferred_date');
            $table->time('preferred_start_time');
            $table->time('preferred_end_time');
            $table->date('scheduled_date')->nullable();
            $table->time('scheduled_start_time')->nullable();
            $table->time('scheduled_end_time')->nullable();
            $table->enum('status', ['pending', 'approved', 'completed', 'cancelled', 'rejected'])->default('pending');
            $table->text('requirements')->nullable(); // Kebutuhan khusus
            $table->text('admin_notes')->nullable();
            $table->text('visit_notes')->nullable(); // Catatan setelah kunjungan
            $table->json('documents')->nullable(); // File dokumen pendukung
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
