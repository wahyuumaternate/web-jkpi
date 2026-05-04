<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Peserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran_peserta';

    protected $fillable = ['nama_lengkap', 'jabatan', 'instansi_organisasi', 'nomor_telepon', 'email', 'kota_kabupaten', 'foto', 'kegiatan', 'tanggal_kedatangan', 'tanggal_kepulangan', 'email_verification_token', 'email_verified_at', 'status', 'catatan', 'kode_registrasi'];

    protected $casts = [
        'kegiatan' => 'array',
        'tanggal_kedatangan' => 'date',
        'tanggal_kepulangan' => 'date',
        'email_verified_at' => 'datetime',
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

            if (empty($peserta->email_verification_token)) {
                $peserta->email_verification_token = Str::random(64);
            }
        });
    }

    /**
     * Generate kode registrasi unik
     */
    public static function generateKodeRegistrasi()
    {
        do {
            $kode = 'JKPI2026-' . strtoupper(Str::random(8));
        } while (self::where('kode_registrasi', $kode)->exists());

        return $kode;
    }

    /**
     * Cek apakah email sudah diverifikasi
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Tandai email sebagai terverifikasi
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'status' => 'verified',
        ])->save();
    }

    /**
     * Scope untuk peserta yang sudah terverifikasi
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    /**
     * Scope untuk peserta yang belum terverifikasi
     */
    public function scopeUnverified($query)
    {
        return $query->where('status', 'unverified');
    }

    /**
     * Accessor untuk foto URL
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('assets/img/default-avatar.png');
    }

    /**
     * Accessor untuk nama lengkap terformat
     */
    public function getNamaLengkapFormattedAttribute()
    {
        return ucwords(strtolower($this->nama_lengkap));
    }

    /**
     * Accessor untuk durasi menginap
     */
    public function getDurasiMenginapAttribute()
    {
        if ($this->tanggal_kedatangan && $this->tanggal_kepulangan) {
            return $this->tanggal_kedatangan->diffInDays($this->tanggal_kepulangan);
        }
        return 0;
    }

    /**
     * Accessor untuk jumlah kegiatan yang dipilih
     */
    public function getJumlahKegiatanAttribute()
    {
        return count($this->kegiatan ?? []);
    }

    /**
     * Cek apakah peserta mengikuti kegiatan tertentu
     */
    public function mengikutiKegiatan(string $namaKegiatan): bool
    {
        return in_array($namaKegiatan, $this->kegiatan ?? []);
    }
}
