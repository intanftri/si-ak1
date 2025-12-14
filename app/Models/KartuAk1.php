<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuAk1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencari_kerja_id',
        'nomor_ak1',
        'tanggal_terbit',
        'tanggal_berlaku',
        'file_pdf',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_berlaku' => 'date',
    ];

    public function pencariKerja()
    {
        return $this->belongsTo(PencariKerja::class);
    }
}

