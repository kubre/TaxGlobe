<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    // use TwoFactorAuthenticatable;
    // use AuthMustVerifyEmail;

    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profession',
        'gender',
        'address',
        'city',
        'state',
        'area',
        'professional_email',
        'contact',
        'whatsapp_contact',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    /* Functions */
    public function toggleFollow($user)
    {
        $this->followings()->toggle($user);
    }

    public function isFollowing(User $user)
    {
        return $this->followings()
            ->where('following_id', $user->id)
            ->exists();
    }

    public function hasFollower(User $user)
    {
        return $this->followers()
            ->where('follower_id', $user->id)
            ->exists();
    }

    /* Relations */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'connections', 'following_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'connections', 'follower_id', 'following_id');
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks');
    }

    public function hasBookmarked(Post $post)
    {
        return $this->belongsToMany(Post::class, 'bookmarks')
            ->wherePivot('post_id', $post->id);
    }
}
