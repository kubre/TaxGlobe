<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreFrontController extends Controller
{
    public function __invoke()
    {
        return view('shop.storefront');
    }
}
