<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'placeholder',
        'type',
        'helper_text',
        'options',
        'required'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function options_array()
    {
        return json_decode($this->options, true);
    }
}
