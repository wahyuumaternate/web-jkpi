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

            // Data Daerah & Kepala Daerah
            $table->string('nama_daerah');
            $table->string('nama_kepala_daerah');
            $table->string('nama_pasangan_kepala_daerah')->nullable();

            // Informasi Perjalanan
            $table->string('nomor_plat')->nullable();
            $table->string('info_kedatangan');  // free-text: "26 Agustus 2026, GA-602, 10:30 WIT"
            $table->string('info_kepulangan');  // free-text: "30 Agustus 2026, GA-603, 14:15 WIT"

            // Data Ajudan / ADC
            $table->string('nama_ajudan')->nullable();
            $table->string('telepon_ajudan', 20)->nullable();

            // Status Pendaftaran
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
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