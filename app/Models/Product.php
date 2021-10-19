<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    public $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'price',
        'discount',
        'stock',
        'type',
    ];

    public $casts = [
        'price' => 'int',
        'discount' => 'int',
        'stock' => 'int',
    ];

    public static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::of($product->title)->slug()->limit(80)->append(Str::random(11));
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);

        $this->addMediaCollection('download');
    }

    public function getFinalPriceAttribute()
    {
        return $this->attributes['price'] - $this->attributes['discount'];
    }

    public function getInStockAttribute()
    {
        return $this->attributes['stock'] > 0;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->attributes['price'] === 0) {
            return 0;
        }
        return ($this->attributes['discount'] / $this->attributes['price']) * 100;
    }


    # Relations

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
