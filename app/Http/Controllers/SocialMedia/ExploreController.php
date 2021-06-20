<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ExploreController extends Controller
{
    public function __invoke()
    {
        return view('social-media.explore');
    }
}
