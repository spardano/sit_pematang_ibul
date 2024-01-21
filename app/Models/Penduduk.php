<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

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
        'jenis_pekerjaan',
        'golongan_darah',
    ];

    public function agama()
    {
        return $this->hasOne(Agama::class, 'agama');
    }


    public function pendidikan()
    {
        return $this->hasOne(JenisPendidikan::class, 'pendidikan');
    }


    public function jenis_pekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::class, 'jenis_pekerjaan');
    }

    public function hubungan_dalam_keluarga()
    {
        return $this->hasOne(JenisPekerjaan::class, 'hubungan_dalam_keluarga');
    }
}
