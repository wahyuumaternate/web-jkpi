<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Menyimpan kegiatan-kegiatan yang akan diikuti oleh setiap peserta.
     * Satu peserta bisa memilih banyak kegiatan (one-to-many).
     *
     * Pilihan kegiatan (sesuai form):
     *  - Welcome Dinner          (25 Agustus, Pendopo Wali Kota Ternate)
     *  - Simposium Internasional (26 Agustus, Bela Hotel)
     *  - Rapat Kerja Nasional    (26 Agustus, Bela Hotel)
     *  - Festival Gastronomi     (27–28 Agustus, Benteng Oranje)
     *  - Ladies Program          (27–28 Agustus, Benteng Oranje)
     */
    public function up(): void
    {
        Schema::create('pendaftaran_kegiatan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                ->constrained('pendaftaran_peserta')
                ->cascadeOnDelete();

            $table->string('nama_kegiatan'); // ex: "Welcome Dinner"

            $table->timestamps();

            // Cegah duplikasi kegiatan yang sama untuk peserta yang sama
            $table->unique(['peserta_id', 'nama_kegiatan']);

            // Index untuk laporan per kegiatan
            $table->index('nama_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatan');
    }
};
