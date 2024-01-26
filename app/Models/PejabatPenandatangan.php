<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PejabatPenandatangan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'nama_pejabat',
        'jenis_kelamin',
        'nip',
        'nik',
        'jabatan',
        'signature',
    ];

    public function getJenisKelaminFormattedAttribute()
    {
        return $this->jenis_kelamin == "L" ? 'Laki-laki' : 'Perempuan';
    }
}
