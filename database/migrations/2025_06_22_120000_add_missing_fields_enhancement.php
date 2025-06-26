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
        // 1. Tambah field maintenance & kalibrasi ke tabel alat
        Schema::table('alat', function (Blueprint $table) {
            $table->date('tanggal_kalibrasi_terakhir')->nullable()->after('harga');
            $table->date('tanggal_kalibrasi_berikutnya')->nullable()->after('tanggal_kalibrasi_terakhir');
            $table->enum('status_kalibrasi', ['VALID', 'EXPIRED', 'PENDING'])->default('PENDING')->after('tanggal_kalibrasi_berikutnya');
            $table->text('riwayat_maintenance')->nullable()->after('status_kalibrasi');
            $table->string('lokasi_penyimpanan')->nullable()->after('riwayat_maintenance');
            $table->string('kode_alat')->unique()->nullable()->after('lokasi_penyimpanan');
        });

        // 2. Tambah field kondisi pengembalian ke tabel peminjamanItem
        Schema::table('peminjamanItem', function (Blueprint $table) {
            $table->enum('kondisi_saat_pinjam', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT'])->default('BAIK')->after('jumlah');
            $table->enum('kondisi_saat_kembali', ['BAIK', 'RUSAK_RINGAN', 'RUSAK_BERAT'])->nullable()->after('kondisi_saat_pinjam');
            $table->text('catatan_kondisi')->nullable()->after('kondisi_saat_kembali');
            $table->datetime('tanggal_dikembalikan')->nullable()->after('catatan_kondisi');
            $table->string('petugas_penerima')->nullable()->after('tanggal_dikembalikan');
        });

        // 3. Tambah field hasil pengujian ke tabel pengujian
        Schema::table('pengujian', function (Blueprint $table) {
            $table->text('hasil_pengujian')->nullable()->after('status');
            $table->string('file_hasil')->nullable()->after('hasil_pengujian');
            $table->date('tanggal_selesai')->nullable()->after('file_hasil');
            $table->text('catatan_tambahan')->nullable()->after('tanggal_selesai');
            $table->string('petugas_pengujian')->nullable()->after('catatan_tambahan');
            $table->decimal('progress_persentase', 5, 2)->default(0)->after('petugas_pengujian');
        });

        // 4. Tambah field detail ke tabel kunjungan
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->date('tanggal_kunjungan')->nullable()->after('jumlahPengunjung');
            $table->time('waktu_mulai')->nullable()->after('tanggal_kunjungan');
            $table->time('waktu_selesai')->nullable()->after('waktu_mulai');
            $table->string('jenis_kunjungan')->nullable()->after('waktu_selesai');
            $table->text('catatan_kunjungan')->nullable()->after('jenis_kunjungan');
            $table->string('petugas_pemandu')->nullable()->after('catatan_kunjungan');
        });

        // 5. Buat tabel baru untuk tracking maintenance alat
        Schema::create('maintenance_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alat_id');
            $table->enum('jenis_maintenance', ['PREVENTIF', 'KOREKTIF', 'KALIBRASI', 'PEMBERSIHAN']);
            $table->date('tanggal_maintenance');
            $table->text('deskripsi_kegiatan');
            $table->decimal('biaya', 15, 2)->nullable();
            $table->string('teknisi')->nullable();
            $table->enum('status', ['DIJADWALKAN', 'SEDANG_PROSES', 'SELESAI', 'DITUNDA'])->default('DIJADWALKAN');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
        });

        // 6. Buat tabel untuk file management hasil pengujian
        Schema::create('pengujian_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengujian_id');
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('tipe_file');
            $table->bigInteger('ukuran_file');
            $table->enum('kategori', ['HASIL_ANALISIS', 'LAPORAN', 'DATA_RAW', 'DOKUMENTASI']);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('pengujian_id')->references('id')->on('pengujian')->onDelete('cascade');
        });

        // 7. Buat tabel untuk notification system
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['INFO', 'SUCCESS', 'WARNING', 'ERROR'])->default('INFO');
            $table->enum('category', ['PEMINJAMAN', 'PENGUJIAN', 'KUNJUNGAN', 'MAINTENANCE', 'SYSTEM']);
            $table->uuid('related_id')->nullable(); // ID dari record terkait
            $table->string('related_type')->nullable(); // Model class terkait
            $table->boolean('is_read')->default(false);
            $table->datetime('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('pengujian_files');
        Schema::dropIfExists('maintenance_log');
        
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_kunjungan', 'waktu_mulai', 'waktu_selesai', 
                'jenis_kunjungan', 'catatan_kunjungan', 'petugas_pemandu'
            ]);
        });

        Schema::table('pengujian', function (Blueprint $table) {
            $table->dropColumn([
                'hasil_pengujian', 'file_hasil', 'tanggal_selesai', 
                'catatan_tambahan', 'petugas_pengujian', 'progress_persentase'
            ]);
        });

        Schema::table('peminjamanItem', function (Blueprint $table) {
            $table->dropColumn([
                'kondisi_saat_pinjam', 'kondisi_saat_kembali', 'catatan_kondisi',
                'tanggal_dikembalikan', 'petugas_penerima'
            ]);
        });

        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_kalibrasi_terakhir', 'tanggal_kalibrasi_berikutnya', 'status_kalibrasi',
                'riwayat_maintenance', 'lokasi_penyimpanan', 'kode_alat'
            ]);
        });
    }
}; 