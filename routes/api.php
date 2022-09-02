<?php

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request )
{
    return $request->user();
} );

Route::get( '/patcher', function ()
{
    $news = News::orderByDesc( 'id' )->limit( 5 )->get();

    return response()->json( $news );
} );
