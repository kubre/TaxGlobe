<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public const TYPE_ARTICLE = 'article';
    public const TYPE_POST = 'post';
    public const TYPE_IMAGE = 'image';

    protected $fillable = [
        'title', 'slug', 'body', 'image', 'type', 'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
