<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    public const TYPE_ARTICLE = 'article';
    public const TYPE_POST = 'post';
    public const TYPE_IMAGE = 'image';

    protected $fillable = [
        'title', 'slug', 'body', 'image', 'type', 'user_id',
    ];

    public static function booted()
    {
        static::created(function ($post) {
            $post->user()->increment('points');
        });

        static::deleted(function ($post) {
            if (!is_null($post->image)) {
                Storage::disk('posts')->delete($post->image);
            }
            $post->user()->decrement('points');
        });
    }

    /* Central Logic */

    public function toggleLikeFrom(int $userId)
    {
        $changes = $this->likedUsers()->toggle($userId);
        $hasLiked = empty($changes['detached']);
        $this->timestamps = false;
        $this->increment('like_count', $hasLiked ? 1 : -1);
        $this->timestamps = true;
        return $hasLiked;
    }

    public function addCommentFrom(string $comment, int $userId)
    {
        $this->timestamps = false;
        $this->increment('comment_count');
        $this->timestamps = true;
        return $this->comments()->create([
            'body' => $comment,
            'user_id' => $userId,
        ]);
    }

    /* Relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function latestComment()
    {
        return $this->hasOne(Comment::class)->with('user')->latest();
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function likedBy(User $user)
    {
        return $this->belongsToMany(User::class, 'likes')
            ->wherePivot('user_id', $user->id);
    }
}
