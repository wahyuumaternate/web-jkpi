<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Narahubung extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_narahubung';

    protected $fillable = [
        'peserta_id',
        'nama',
        'telepon',
        'email',
    ];

    /**
     * Relasi: narahubung milik satu peserta
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }
}
