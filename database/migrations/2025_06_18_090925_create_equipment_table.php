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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained('laboratories')->onDelete('cascade');
            $table->string('code')->unique(); // Kode alat
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('specifications')->nullable(); // Spesifikasi teknis
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->year('purchase_year')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('available_quantity')->default(1);
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor', 'damaged'])->default('good');
            $table->enum('status', ['available', 'rented', 'maintenance', 'retired'])->default('available');
            $table->string('category')->nullable(); // elektronik, mekanik, optik, dll
            $table->date('last_calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->decimal('rental_price_per_day', 10, 2)->nullable();
            $table->json('images')->nullable(); // Array of image paths
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
