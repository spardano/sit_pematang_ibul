<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_layanan_desa',
        'nik',
        'data_field',
        'uploaded_dokumen',
        'status_pengajuan',
        'id_pejabat',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }



    public function layanan_desa()
    {
        return $this->hasOne(LayananDesa::class, 'id', 'id_layanan_desa');
    }

    public function getFieldData()
    {
        return json_decode($this->data_field);
    }

    public function getDocument()
    {
        return json_decode($this->uploaded_dokumen);
    }

    public function pejabat_ttd()
    {
        return $this->hasOne(PejabatPenandatangan::class, 'id', 'id_pejabat');
    }
}
