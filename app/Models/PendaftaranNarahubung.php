<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranNarahubung extends Model
{
    protected $table = 'pendaftaran_narahubung';

    protected $fillable = [
        'peserta_id',
        'nama',
        'telepon',
        'email',
    ];

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }
}