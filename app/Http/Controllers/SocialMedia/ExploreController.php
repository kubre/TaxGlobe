<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ExploreController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')->latest()->get();
        return view('social-media.explore', \compact('posts'));
    }
}
