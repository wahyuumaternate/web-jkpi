<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $table = 'pendaftaran_kegiatan';

    protected $fillable = ['peserta_id', 'nama_kegiatan'];

    /**
     * Harus sama persis dengan value checkbox di form
     */
    const KEGIATAN_VALID = ['Welcome Dinner', 'Master Class', 'Heritage City Tour', 'Ladies Program', 'Expo UMKM', 'Pentas Budaya', 'Simposium Internasional - Pulau-Pulau Penghasil Rempah', 'Festival Gastronomi', 'Rapat Kerja Nasional', 'Gelar Budaya dan Penyerahan Pataka', 'Pawai Budaya dan Karnaval', 'Nusantara Raya Run'];

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }
}
