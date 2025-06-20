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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_code')->unique(); // Kode pengujian
            $table->foreignId('laboratory_id')->constrained('laboratories')->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_institution')->nullable();
            $table->string('sample_name');
            $table->text('sample_description');
            $table->json('test_parameters'); // Parameter yang akan diuji
            $table->text('test_method')->nullable();
            $table->enum('test_type', ['analysis', 'characterization', 'quality_control', 'research'])->default('analysis');
            $table->integer('sample_quantity');
            $table->string('sample_unit')->default('pcs'); // pcs, gram, ml, dll
            $table->date('received_date')->nullable();
            $table->date('target_completion_date')->nullable();
            $table->date('actual_completion_date')->nullable();
            $table->decimal('estimated_cost', 10, 2)->default(0);
            $table->decimal('final_cost', 10, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'in_queue', 'in_progress', 'completed', 'delivered', 'cancelled'])->default('pending');
            $table->text('special_requirements')->nullable();
            $table->text('admin_notes')->nullable();
            $table->json('test_results')->nullable(); // Hasil pengujian
            $table->json('test_documents')->nullable(); // File hasil pengujian
            $table->text('analyst_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('analyst_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
