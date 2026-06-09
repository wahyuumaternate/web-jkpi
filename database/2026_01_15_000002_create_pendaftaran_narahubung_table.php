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
        Schema::create('pendaftaran_narahubung', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                ->constrained('pendaftaran_peserta')
                ->cascadeOnDelete();

            $table->string('nama');
            $table->string('telepon', 20);
            $table->string('email');

            $table->timestamps();

            // Index untuk lookup cepat per peserta
            $table->index('peserta_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_narahubung');
    }
};