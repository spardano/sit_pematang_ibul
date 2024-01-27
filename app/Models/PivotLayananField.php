<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotLayananField extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_layanan_desa',
        'id_field'
    ];

    public function field()
    {
        return $this->hasOne(Field::class, 'id', 'id_field');
    }
}
