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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laboratory_id')->nullable();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->text('bio')->nullable();
            $table->string('specialization')->nullable();
            $table->string('education')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
