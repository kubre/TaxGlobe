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

    public static $statusList = [
        'created' => 'Payment Cancelled',
        'cancelled' => 'Order Cancelled (by User)',
        'success' => 'Payment Success',
        'failure' => 'Payment Failure',
        'accepted' => 'Order Accepted',
        'denied' => 'Order Cancelled (by Admin)',
        'dispatched' => 'Dispatched',
        'shipped' => 'Shipped',
        'dispute' => 'Payment Dispute',
        'initiated_return' => 'Return Initiated',
        'return_success' => 'Return Accepted',
        'return_success' => 'Return Success',
    ];

    public function getReadableStatusAttribute()
    {
        return self::$statusList[$this->status] ?? 'Unknown';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
