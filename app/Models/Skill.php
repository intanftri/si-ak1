<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function pencariKerjas()
    {
        return $this->belongsToMany(
            PencariKerja::class,
            'pencari_kerja_skills'
        );
    }
}

