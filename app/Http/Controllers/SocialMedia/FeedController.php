<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')->latest()->get();
        return view('social-media.feed', \compact('posts'));
    }
}
