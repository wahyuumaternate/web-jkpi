<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pendaftaran_peserta', function (Blueprint $table) {
            // Data Wakil Kepala Daerah
            $table->string('nama_wakil_kepala_daerah')->nullable()->after('nama_pasangan_kepala_daerah');

            $table->string('nama_pasangan_wakil_kepala_daerah')->nullable()->after('nama_wakil_kepala_daerah');

            // Informasi Kepala Daerah
            $table->string('ukuran_peci', 10)->nullable()->after('ukuran_baju_pasangan');

            // Informasi Wakil Kepala Daerah
            $table
                ->enum('ukuran_baju_wakil', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])
                ->nullable()
                ->after('ukuran_peci');

            $table
                ->enum('ukuran_baju_pasangan_wakil', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])
                ->nullable()
                ->after('ukuran_baju_wakil');

            $table->string('ukuran_peci_wakil', 10)->nullable()->after('ukuran_baju_pasangan_wakil');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_peserta', function (Blueprint $table) {
            $table->dropColumn(['nama_wakil_kepala_daerah', 'nama_pasangan_wakil_kepala_daerah', 'ukuran_peci', 'ukuran_baju_wakil', 'ukuran_baju_pasangan_wakil', 'ukuran_peci_wakil']);
        });
    }
};
