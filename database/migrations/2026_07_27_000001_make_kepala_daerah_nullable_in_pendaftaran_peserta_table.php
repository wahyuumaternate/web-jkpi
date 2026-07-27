<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pendaftaran_peserta', function (Blueprint $table) {
            $table->string('nama_kepala_daerah')->nullable()->change();
        });

        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE pendaftaran_peserta MODIFY ukuran_baju ENUM('S','M','L','XL','XXL','XXXL') NULL");
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE pendaftaran_peserta ALTER COLUMN ukuran_baju DROP NOT NULL');
        } else {
            Schema::table('pendaftaran_peserta', function (Blueprint $table) {
                $table->string('ukuran_baju')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE pendaftaran_peserta MODIFY nama_kepala_daerah VARCHAR(255) NOT NULL');
            DB::statement("ALTER TABLE pendaftaran_peserta MODIFY ukuran_baju ENUM('S','M','L','XL','XXL','XXXL') NOT NULL");
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE pendaftaran_peserta ALTER COLUMN nama_kepala_daerah SET NOT NULL');
            DB::statement('ALTER TABLE pendaftaran_peserta ALTER COLUMN ukuran_baju SET NOT NULL');
        } else {
            Schema::table('pendaftaran_peserta', function (Blueprint $table) {
                $table->string('nama_kepala_daerah')->nullable(false)->change();
                $table->string('ukuran_baju')->nullable(false)->change();
            });
        }
    }
};
