<?php

use App\Http\Controllers\Shop;
use App\Http\Controllers\SocialMedia;
use App\Http\Livewire\SocialMedia as SocialMediaComponents;
use App\Http\Livewire\Common;
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

Route::get('/', SocialMediaComponents\PostList::class)
    ->name('explore.index');
Route::redirect('/explore', '/')
    ->name('explore.explore');
Route::get('/shop', Shop\StoreFrontController::class)
    ->name('shop.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/connections', SocialMedia\ConnectionController::class)
        ->name('connection.index');

    Route::get('/feed', SocialMediaComponents\PostList::class)
        ->name('feed.index');

    Route::get('/posts/create/{type}/{post?}', SocialMediaComponents\PostForm::class)
        ->name('posts.form');

    Route::get('/users', Common\UserList::class)
        ->name('users.index');
    Route::get('/users/{user}', SocialMediaComponents\PostList::class)
        ->name('user.profile');

    Route::get('/users/{user}/followers', Common\UserList::class)
        ->name('users.followers');
    Route::get('/users/{user}/followings', Common\UserList::class)
        ->name('users.followings');
});

Route::get('/posts/{post:slug}', SocialMedia\ArticleController::class)
    ->name('post.show');

Route::view('/about', 'about')->name('about.show');


Route::post('/imageUpload', [SocialMedia\MediaController::class, 'uploadArticleImage'])->name('article.image.upload');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');