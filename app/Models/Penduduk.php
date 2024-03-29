<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Penduduk extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'nokk',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'tempat_lahir',
        'hubungan_dalam_keluarga',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'status',
        'jenis_pekerjaan',
        'golongan_darah',
        'file_ktp',
        'file_kk',
        'pas_foto'
    ];

    public function agama()
    {
        return $this->hasOne(Agama::class, 'id', 'agama');
    }


    public function pendidikan()
    {
        return $this->hasOne(JenisPendidikan::class, 'pendidikan');
    }


    public function jenis_pekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::class, 'id', 'jenis_pekerjaan');
    }

    public function hubungan_dalam_keluarga()
    {
        return $this->hasOne(JenisPekerjaan::class, 'hubungan_dalam_keluarga');
    }
}
