<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GMController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemshopController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RefillController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManageController;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware( 'force.redirect' )->group( function ()
// {
Route::get( '/', [PagesController::class, 'index'] )->name( 'index' );

Auth::routes();

Route::resource( 'signup', SignupController::class, ['name' => 'signup'] );
Route::get( '/home', [HomeController::class, 'index'] )->name( 'home' );
Route::get( '/download', [PagesController::class, 'download'] )->name( 'download' );
Route::get( '/information', [PagesController::class, 'information'] )->name( 'information' );
Route::get( '/ranking', [PagesController::class, 'ranking'] )->name( 'ranking' );
Route::get( '/view/{url}', [PagesController::class, 'viewpage'] )->name( 'view-page' );
Route::get( '/news-view/{id}', [PagesController::class, 'viewnews'] )->name( 'view-news' );
Route::get( '/event-view/{id}', [PagesController::class, 'viewevent'] )->name( 'view-event' );

Route::get( '/news-all', [PagesController::class, 'news_all'] )->name( 'news-all' );
Route::get( '/event-all', [PagesController::class, 'event_all'] )->name( 'event-all' );
Route::get( '/pages-all', [PagesController::class, 'pages_all'] )->name( 'pages-all' );

Route::get( '/patcher', [PagesController::class, 'patcher'] );
// } );

Route::middleware( 'auth', 'login.control', 'banned', )->group( function ()
{
    Route::get( '/account', [UserController::class, 'account'] )->name( 'account' );

    Route::get( '/premium', [UserController::class, 'premium'] )->name( 'premium' );
    Route::post( '/premium_update', [UserController::class, 'premium_update'] )->name( 'premium_update' );
    Route::get( '/buycash', [UserController::class, 'buycash'] )->name( 'buycash' );
    Route::post( '/buycash_update', [UserController::class, 'buycash_update'] )->name( 'buycash_update' );
    Route::middleware( 'refill.control' )->group( function ()
    {
        Route::get( '/topup', [TopupController::class, 'index'] )->name( 'topup' );
        Route::post( '/topup', [TopupController::class, 'store'] );
    } );

    Route::middleware( 'shop.control' )->group( function ()
    {
        Route::get( '/shop', [UserController::class, 'shop'] )->name( 'shop' );
    } );
} );

Route::prefix( 'admin' )->middleware( 'auth', 'is.admin' )->group( function ()
{
    Route::resource( 'refill', RefillController::class, ['name' => 'refill'] );
    Route::resource( '/setting', SettingController::class, ['name' => 'setting'] );
    Route::resource( '/news', NewsController::class, ['name' => 'news'] );
    Route::resource( '/event', EventController::class, ['name' => 'event'] );
    Route::resource( '/page-content', PageContentController::class, ['name' => 'page-content'] );
    Route::resource( '/slide', SlideController::class, ['name' => 'slide'] );
    Route::resource( '/gallery', GalleryController::class, ['name' => 'gallery'] );
    //
    Route::resource( '/itemshop', ItemshopController::class, ['name' => 'itemshop'] );

    // manage
    Route::resource( '/gm', GMController::class, ['name' => 'gm'] );
    Route::resource( '/users', UserManageController::class, ['name' => 'users'] );
    Route::post( 'search-user', [UserController::class, 'search_user'] )->name( 'search_user' );
} );

Route::get( 'banned-account', function ()
{
    return view( 'pages.banned' );
} )->name( 'banned' );