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
            $table->string('nik', 16)->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kode_pos', 5)->nullable();

            // Kontak
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('email')->unique();
            $table->string('nomor_wa', 15); // wajib

            // Instansi/Pekerjaan
            $table->string('instansi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('bidang_pekerjaan')->nullable();

            // Data Kepesertaan
            $table->boolean('is_anggota_jkpi')->default(false);

            // Kebutuhan Khusus
            $table->boolean('butuh_akomodasi')->default(false);
            $table->text('kebutuhan_khusus')->nullable(); // diet, disabilitas, dll

            // Upload Dokumen
            $table->string('foto')->nullable();
            $table->string('ktp')->nullable();

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
