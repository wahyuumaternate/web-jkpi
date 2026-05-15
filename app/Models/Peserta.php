<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Peserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran_peserta';

    protected $fillable = ['nama_daerah', 'nama_kepala_daerah', 'nama_pasangan_kepala_daerah', 'nomor_plat', 'info_kedatangan', 'info_kepulangan', 'nama_ajudan', 'telepon_ajudan', 'status', 'catatan', 'kode_registrasi'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot method untuk generate kode registrasi otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peserta) {
            if (empty($peserta->kode_registrasi)) {
                $peserta->kode_registrasi = self::generateKodeRegistrasi();
            }
        });
    }

    /**
     * Generate kode registrasi unik
     */
    public static function generateKodeRegistrasi(): string
    {
        do {
            $kode = 'JKPI2026-' . strtoupper(Str::random(8));
        } while (self::where('kode_registrasi', $kode)->exists());

        return $kode;
    }

    /**
     * Relasi: satu peserta punya banyak narahubung
     */
    public function narahubung(): HasMany
    {
        return $this->hasMany(Narahubung::class, 'peserta_id');
    }

    /**
     * Scope: peserta confirmed
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope: peserta pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Accessor: nama kepala daerah terformat
     */
    public function getNamaKepalaDaerahFormattedAttribute(): string
    {
        return ucwords(strtolower($this->nama_kepala_daerah));
    }

    /**
     * Accessor: jumlah narahubung
     */
    public function getJumlahNarahubungAttribute(): int
    {
        return $this->narahubung()->count();
    }
}
