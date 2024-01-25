<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananDesa extends Model
{
    use HasFactory;

    protected $table = 'layanan_desa';
    protected $fillable = [
        'nama_layanan',
        'icon',
        'deskripsi',
        'slug'
    ];

    public function field()
    {
        return $this->hasMany(PivotLayananField::class, 'id_layanan_desa')->orderBy('sort_order', 'asc');
    }
}
