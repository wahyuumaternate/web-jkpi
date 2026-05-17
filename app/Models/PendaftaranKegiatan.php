<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranKegiatan extends Model
{
    protected $table = 'pendaftaran_kegiatan';

    protected $fillable = [
        'peserta_id',
        'nama_kegiatan',
    ];

    /**
     * Daftar kegiatan yang valid (untuk validasi).
     */
    public const KEGIATAN_VALID = [
        'Welcome Dinner',
        'Simposium Internasional',
        'Rapat Kerja Nasional',
        'Festival Gastronomi',
        'Ladies Program',
    ];

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }
}
