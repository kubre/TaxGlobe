<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $fillable = [
        'address',
        'city',
        'state',
        'pin_code',
        'shipping_notes',
        'contact',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
