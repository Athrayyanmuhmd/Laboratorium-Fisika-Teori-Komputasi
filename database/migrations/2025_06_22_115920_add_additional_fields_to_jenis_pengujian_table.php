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
        Schema::table('jenisPengujian', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('hargaPerSampel');
            $table->string('estimasiWaktu', 100)->nullable()->after('deskripsi');
            $table->string('kategori', 100)->nullable()->after('estimasiWaktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenisPengujian', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'estimasiWaktu', 'kategori']);
        });
    }
};
