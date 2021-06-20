<?php

use App\Http\Controllers\Shop;
use App\Http\Controllers\SocialMedia;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', SocialMedia\ExploreController::class)->name('explore.index');
Route::get('/explore', SocialMedia\ExploreController::class)->name('explore.explore');
Route::get('/connections', SocialMedia\ConnectionController::class)->name('connection.index');
Route::get('/feed', SocialMedia\FeedController::class)->name('feed.index');
Route::get('/shop', Shop\StoreFrontController::class)->name('shop.index');


Route::view('/about', 'about')->name('about.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
