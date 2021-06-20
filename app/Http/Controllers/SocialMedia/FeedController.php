<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __invoke()
    {
        return view('social-media.feed');
    }
}
