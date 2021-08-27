<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public $fillable = [
        'order_id',
        'pay_id',
        'status',
        'amount',
        'details',
        'user_id',
        'product_id',
        'quantity',
    ];

    public $casts = [
        'amount' => 'integer',
        'details' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
