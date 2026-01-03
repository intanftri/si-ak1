<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerjaSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencari_kerja_id',
        'skill_id',
    ];

    public function pencariKerja()
    {
        return $this->belongsTo(PencariKerja::class, 'pencari_kerja_id', 'id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }
}

