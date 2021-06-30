<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __invoke(Post $post)
    {
        return \view('social-media.article', \compact('post'));
    }
}
