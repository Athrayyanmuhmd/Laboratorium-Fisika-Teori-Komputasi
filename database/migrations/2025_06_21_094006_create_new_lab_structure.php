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
        // 1. Tabel admin
        Schema::create('admin', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['ADMIN', 'SUPER_ADMIN'])->default('ADMIN');
            $table->timestamps();
        });

        // 2. Tabel alat
        Schema::create('alat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->boolean('isBroken')->default(false);
            $table->decimal('harga', 15, 2)->nullable();
            $table->timestamps();
        });

        // 3. Tabel jenisPengujian
        Schema::create('jenisPengujian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('namaPengujian');
            $table->decimal('hargaPerSampel', 15, 2);
            $table->boolean('isAvailable')->default(true);
            $table->timestamps();
        });

        // 4. Tabel peminjaman
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('namaPeminjam');
            $table->string('noHp');
            $table->text('tujuanPeminjaman')->nullable();
            $table->date('tanggal_pinjam')->default(now());
            $table->date('tanggal_pengembalian');
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->timestamps();
        });

        // 5. Tabel peminjamanItem
        Schema::create('peminjamanItem', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peminjamanId');
            $table->uuid('alat_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('peminjamanId')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
        });

        // 6. Tabel pengujian
        Schema::create('pengujian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('namaPenguji');
            $table->string('noHpPenguji');
            $table->text('deskripsi');
            $table->decimal('totalHarga', 15, 2);
            $table->date('tanggalPengujian')->default(now());
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->timestamps();
        });

        // 7. Tabel pengujianItem
        Schema::create('pengujianItem', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jenisPengujianId');
            $table->uuid('pengujianId');
            $table->timestamps();

            $table->foreign('jenisPengujianId')->references('id')->on('jenisPengujian')->onDelete('cascade');
            $table->foreign('pengujianId')->references('id')->on('pengujian')->onDelete('cascade');
        });

        // 8. Tabel kunjungan
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('namaPengunjung');
            $table->text('tujuan')->nullable();
            $table->integer('jumlahPengunjung')->default(1);
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->timestamps();
        });

        // 9. Tabel jadwal
        Schema::create('jadwal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengujianId')->nullable();
            $table->uuid('kunjunganId')->nullable();
            $table->datetime('tanggalMulai')->default(now());
            $table->datetime('tanggalSelesai')->nullable();
            $table->timestamps();

            $table->foreign('pengujianId')->references('id')->on('pengujian')->onDelete('cascade');
            $table->foreign('kunjunganId')->references('id')->on('kunjungan')->onDelete('cascade');
        });

        // 10. Tabel misi
        Schema::create('misi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('pointMisi');
            $table->timestamps();
        });

        // 11. Tabel profilLaboratorium
        Schema::create('profilLaboratorium', function (Blueprint $table) {
            $table->id();
            $table->string('namaLaboratorium');
            $table->text('tentangLaboratorium');
            $table->text('visi');
            $table->uuid('misiId')->nullable();
            $table->timestamps();

            $table->foreign('misiId')->references('id')->on('misi')->onDelete('set null');
        });

        // 12. Tabel biodataPengurus
        Schema::create('biodataPengurus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('jabatan');
            $table->timestamps();
        });

        // 13. Tabel artikel
        Schema::create('artikel', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('namaAcara');
            $table->text('deskripsi');
            $table->string('penulis')->nullable();
            $table->date('tanggalAcara')->default(now());
            $table->timestamps();
        });

        // 14. Tabel gambar
        Schema::create('gambar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengurusId')->nullable();
            $table->uuid('acaraId')->nullable();
            $table->string('url');
            $table->enum('kategori', ['PENGURUS', 'ACARA']);
            $table->timestamps();

            $table->foreign('pengurusId')->references('id')->on('biodataPengurus')->onDelete('cascade');
            $table->foreign('acaraId')->references('id')->on('artikel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar');
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('biodataPengurus');
        Schema::dropIfExists('profilLaboratorium');
        Schema::dropIfExists('misi');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('kunjungan');
        Schema::dropIfExists('pengujianItem');
        Schema::dropIfExists('pengujian');
        Schema::dropIfExists('peminjamanItem');
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('jenisPengujian');
        Schema::dropIfExists('alat');
        Schema::dropIfExists('admin');
    }
};
