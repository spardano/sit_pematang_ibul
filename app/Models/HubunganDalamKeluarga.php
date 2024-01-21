<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganDalamKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'hubungan_dalam_keluarga'
    ];
}
