<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxDate extends Model
{
    public $fillable = ['title', 'description', 'date_at', 'category',];

    public $casts = [
        'date_at' => 'datetime',
    ];
}
