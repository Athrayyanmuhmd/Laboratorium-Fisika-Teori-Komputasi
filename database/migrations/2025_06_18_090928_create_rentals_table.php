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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('rental_code')->unique(); // Kode penyewaan
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->string('renter_name');
            $table->string('renter_email');
            $table->string('renter_phone');
            $table->string('renter_institution')->nullable();
            $table->string('renter_id_number')->nullable(); // NIK/NIM/NIP
            $table->text('purpose'); // Tujuan penggunaan
            $table->integer('quantity')->default(1);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'ongoing', 'returned', 'cancelled', 'overdue'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->date('actual_return_date')->nullable();
            $table->enum('return_condition', ['excellent', 'good', 'fair', 'poor', 'damaged'])->nullable();
            $table->text('return_notes')->nullable();
            $table->decimal('penalty_fee', 10, 2)->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('returned_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
