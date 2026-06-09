<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ============================================================
        //  1. TABEL UTAMA: pendaftaran_peserta
        // ============================================================
        Schema::create('pendaftaran_peserta', function (Blueprint $table) {
            $table->id();

            // Data Daerah & Kepala Daerah
            $table->string('nama_daerah');
            $table->string('nama_kepala_daerah');
            $table->string('nama_pasangan_kepala_daerah')->nullable();

            // Informasi Tambahan
            $table->enum('ukuran_baju', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
            $table->enum('ukuran_baju_pasangan', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();
            $table->unsignedSmallInteger('jumlah_rombongan')->default(1);

            // Informasi Perjalanan
            $table->string('nomor_plat')->nullable();
            $table->string('info_kedatangan');
            $table->string('info_kepulangan');

            // Data Ajudan / ADC
            $table->string('nama_ajudan')->nullable();
            $table->string('telepon_ajudan', 20)->nullable();

            // Status & Catatan Admin
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('catatan')->nullable();

            // Kode Registrasi
            $table->string('kode_registrasi', 30)->unique();

            $table->timestamps();
            $table->softDeletes();

            $table->index('nama_daerah');
            $table->index('status');
        });

        // ============================================================
        //  2. TABEL RELASI: pendaftaran_narahubung
        //     Model  : PendaftaranNarahubung
        //     FK     : peserta_id -> pendaftaran_peserta.id
        // ============================================================
        Schema::create('pendaftaran_narahubung', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                ->constrained('pendaftaran_peserta')
                ->cascadeOnDelete();

            $table->string('nama');
            $table->string('telepon', 20);
            $table->string('email');

            $table->timestamps();

            $table->index('peserta_id');
        });

        // ============================================================
        //  3. TABEL RELASI: pendaftaran_kegiatan
        //     Model  : PendaftaranKegiatan
        //     FK     : peserta_id -> pendaftaran_peserta.id
        // ============================================================
        Schema::create('pendaftaran_kegiatan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                ->constrained('pendaftaran_peserta')
                ->cascadeOnDelete();

            $table->string('nama_kegiatan', 100);

            $table->timestamps();

            $table->index('peserta_id');
            // Mencegah peserta mendaftar kegiatan yang sama dua kali
            $table->unique(['peserta_id', 'nama_kegiatan']);
        });
    }

    public function down(): void
    {
        // Urutan drop: child dulu, baru parent
        Schema::dropIfExists('pendaftaran_kegiatan');
        Schema::dropIfExists('pendaftaran_narahubung');
        Schema::dropIfExists('pendaftaran_peserta');
    }
};