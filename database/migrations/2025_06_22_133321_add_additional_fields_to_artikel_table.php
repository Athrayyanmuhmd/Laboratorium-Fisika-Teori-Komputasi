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
        Schema::table('artikel', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('tanggalAcara');
            $table->text('tags')->nullable()->after('kategori');
            $table->enum('status', ['draft', 'published', 'archived'])->default('published')->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'tags', 'status']);
        });
    }
};
