<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'pendidikan_id',
        'status_kerja',
        'tanggal_daftar',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function skills()
    {
        return $this->belongsToMany(
            Skill::class,
            'pencari_kerja_skills'
        );
    }

    public function kartuAk1()
    {
        return $this->hasOne(KartuAk1::class);
    }
}

