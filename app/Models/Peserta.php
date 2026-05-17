<?php

/**
 * ============================================================
 *  CATATAN UPDATE UNTUK app/Models/Peserta.php
 * ============================================================
 *
 *  Tidak perlu rewrite seluruh model — cukup pastikan 3 hal
 *  di bawah ini sudah ada / ditambahkan:
 *
 *  1) Tambahkan 'ukuran_baju' & 'jumlah_rombongan' ke $fillable
 *  2) (Opsional) Tambah cast untuk jumlah_rombongan
 *  3) Tambah relasi kegiatan()
 * ============================================================
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Peserta extends Model
{
    use SoftDeletes;

    protected $table = 'pendaftaran_peserta';

    protected $fillable = [
        'nama_daerah',
        'nama_kepala_daerah',
        'nama_pasangan_kepala_daerah',

        // ⬇⬇⬇ TAMBAHKAN 2 BARIS INI
        'ukuran_baju',
        'jumlah_rombongan',
        // ⬆⬆⬆

        'nomor_plat',
        'info_kedatangan',
        'info_kepulangan',
        'nama_ajudan',
        'telepon_ajudan',
        'status',
        'catatan',
        'kode_registrasi',
    ];

    protected $casts = [
        'jumlah_rombongan' => 'integer', // opsional, tapi disarankan
    ];

    /**
     * Auto-generate kode registrasi (kemungkinan sudah ada di model Anda;
     * jangan diduplikasi kalau sudah ada).
     */
    protected static function booted(): void
    {
        static::creating(function (self $peserta) {
            if (empty($peserta->kode_registrasi)) {
                $peserta->kode_registrasi = 'JKPI-2026-' . strtoupper(Str::random(6));
            }
        });
    }

    // ===== RELATIONS =====

    public function narahubung(): HasMany
    {
        // Sudah ada di model Anda — biarkan apa adanya.
        return $this->hasMany(PendaftaranNarahubung::class, 'peserta_id');
    }

    // ⬇⬇⬇ TAMBAHKAN RELASI INI
    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'peserta_id');
    }
    // ⬆⬆⬆
}