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
}

