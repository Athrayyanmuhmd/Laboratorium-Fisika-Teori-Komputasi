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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'lab_admin', 'staff', 'user'])->default('user');
            $table->foreignId('laboratory_id')->nullable()->constrained('laboratories')->onDelete('set null');
            $table->string('phone')->nullable();
            $table->string('position')->nullable(); // Jabatan
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['laboratory_id']);
            $table->dropColumn(['role', 'laboratory_id', 'phone', 'position', 'bio', 'avatar', 'is_active']);
        });
    }
};
