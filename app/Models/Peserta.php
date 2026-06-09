<?php

// app/Models/Peserta.php

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
        'ukuran_baju',
        'ukuran_baju_pasangan',         // nullable
        'jumlah_rombongan',
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
        'jumlah_rombongan' => 'integer',
    ];

    // ===== AUTO-GENERATE KODE REGISTRASI =====

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
        return $this->hasMany(PendaftaranNarahubung::class, 'peserta_id');
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(PendaftaranKegiatan::class, 'peserta_id');
    }
}