<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran_peserta', function (Blueprint $table) {
            $table->id();

            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('jabatan');
            $table->string('instansi_organisasi');
            $table->string('nomor_telepon', 15);
            $table->string('email')->unique();

            // Perwakilan Daerah
            $table->string('kota_kabupaten');

            // Upload Dokumen
            $table->string('foto')->nullable();

            // Perjalanan dan Akomodasi
            $table->date('tanggal_kedatangan');
            $table->date('tanggal_kepulangan');
            $table->string('akomodasi_hotel')->nullable();

            // Verifikasi Email
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            // Status Pendaftaran
            $table->enum('status', ['unverified', 'verified', 'cancelled'])->default('unverified');
            $table->text('catatan')->nullable();

            // Kode Registrasi
            $table->string('kode_registrasi')->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_peserta');
    }
};
