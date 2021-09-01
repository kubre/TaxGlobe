<?php

use App\Http\Livewire\Shop;
use App\Http\Controllers\SocialMedia;
use App\Http\Livewire\Admin;
use App\Http\Livewire\SocialMedia as SocialMediaComponents;
use App\Http\Livewire\Common;
use App\Http\Livewire\Shop\Storefront;
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

Route::get('/shop', Shop\Storefront::class)
    ->name('shop.index');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/feed', SocialMediaComponents\PostList::class)
        ->name('feed.index');

    Route::get('/posts/create/{type}/{post?}', SocialMediaComponents\PostForm::class)
        ->name('posts.form');

    Route::get('/users', Common\UserList::class)
        ->name('users.index');

    Route::get('/users/{user}', SocialMediaComponents\PostList::class)
        ->name('user.profile');
    Route::get('/users/{user}/bookmarks', SocialMediaComponents\PostList::class)
        ->name('user.bookmarks');

    Route::get('/users/{user}/followers', Common\UserList::class)
        ->name('users.followers');
    Route::get('/users/{user}/followings', Common\UserList::class)
        ->name('users.followings');

    Route::get('/users/{user}/suggestions', Common\UserList::class)
        ->name('users.suggestions');

    Route::get('checkout', Shop\Checkout::class)
        ->name('shop.checkout');

    Route::get('order-status/{order}', Shop\OrderStatus::class)
        ->name('shop.order.status');

    Route::get('purchases', Shop\OrderList::class)
        ->name('shop.order.list');

    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function () {
        Route::get('dashboard', Admin\Dashboard::class)
            ->name('dashboard');

        Route::get('/users', Admin\UserManagement::class)
            ->name('users.list');

        Route::get('/posts', Admin\PostManagement::class)
            ->name('posts.list');

        Route::get('/tax-dates', Admin\TaxCalendarManagement::class)
            ->name('tax-date.list');

        Route::get('/products', Admin\ProductManagement::class)
            ->name('products.list');

        Route::get('/products/form/{product?}', Admin\ProductForm::class)
            ->name('products.form');

        Route::get('/tax-date/{taxDate?}', Admin\TaxDateForm::class)
            ->name('tax-date.edit');

        Route::get('/settings', Admin\WebsiteManagement::class)
            ->name('website.list');
    });
});

Route::get('/posts/{slug}', SocialMediaComponents\PostList::class)
    ->name('post.show');

Route::get('/products/{product:slug}', Shop\ProductDetails::class)
    ->name('products.show');

Route::view('/about', 'about')->name('about.show');

Route::post('/imageUpload', [SocialMedia\MediaController::class, 'uploadArticleImage'])->name('article.image.upload');

Route::get('/download/{media}', [SocialMedia\MediaController::class, 'download'])->name('article.image.download');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');