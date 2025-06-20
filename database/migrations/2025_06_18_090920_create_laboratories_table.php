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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->json('facilities')->nullable(); // Array of facilities
            $table->text('location');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->json('operating_hours')->nullable(); // JSON for operating hours
            $table->string('head_of_lab')->nullable();
            $table->string('status')->default('active'); // active, inactive
            $table->string('image')->nullable();
            $table->json('staff')->nullable(); // Array of staff info
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
