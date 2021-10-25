<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    public const TYPE_ARTICLE = 'article';
    public const TYPE_POST = 'post';
    public const TYPE_IMAGE = 'image';

    protected $fillable = [
        'title', 'slug', 'body', 'image', 'type', 'user_id', 'reported_at', 'reported_reason'
    ];

    public $casts = [
        'reported_at' => 'datetime',
    ];

    public static $reportReasons = [
        'Its spam' => 'Its spam',
        'Nudity or Sexual Activity' => 'Nudity or Sexual Activity',
        'Hate Speech or symbols' => 'Hate Speech or symbols',
        'Violence or dangerous orgnizations' => 'Violence or dangerous orgnizations',
        'Sale of illegal or regulated goods' => 'Sale of illegal or regulated goods',
        'Bullying or harassment' => 'Bullying or harassment',
        'Intellctual property violation' => 'Intellctual property violation',
        'Suicide or self-injury' => 'Suicide or self-injury',
        'Eating Disorder' => 'Eating Disorder',
        'Scam or fraud' => 'Scam or fraud',
        'False violations' => 'False violations',
        'Against TaxGlobes Terms and Conditions' => 'Against TaxGlobes Terms and Conditions',
        'I just dont like it' => 'I just dont like it',
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


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')
            ->acceptsMimeTypes(['image/jpeg', 'application/pdf']);
    }


    /* Central Logic */

    public function toggleLikeFrom(int $userId)
    {
        $changes = $this->likedUsers()->toggle($userId);
        $hasLiked = empty($changes['detached']);
        $this->timestamps = false;
        $this->user()->increment('points', $hasLiked ? 1 : -1);
        $this->increment('like_count', $hasLiked ? 1 : -1);
        $this->timestamps = true;
        return $hasLiked;
    }

    public function toggleBookmarkFrom(int $userId)
    {
        $changes = $this->bookmarkedUsers()->toggle($userId);
        return empty($changes['detached']);
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

    public function bookmarkedUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function bookmarkedBy(User $user)
    {
        return $this->belongsToMany(User::class, 'bookmarks')
            ->wherePivot('user_id', $user->id);
    }
}
