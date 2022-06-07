<?php

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
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', 'CustomAuthController@login');
    Route::post('/logout', 'CustomAuthController@logout');
    Route::post('/refresh', 'CustomAuthController@refresh');
    Route::get('/user-profile', 'CustomAuthController@me');
});

Route::prefix('author')->group(function () {
    $cr = "AuthorController";
    Route::post('/test', "$cr@test");
    Route::post('/store', "$cr@store");
    Route::any('/', "$cr@getAll");
    Route::any('/{id}', "$cr@getDetail");
    Route::get('/{id}/detail', "$cr@viewDetail");
    Route::get('/{id}/delete', "$cr@destroy");
});

Route::prefix('book')->group(function () {
    $cr = "BookController";
    Route::post('/store', "$cr@store");
    Route::any('/', "$cr@getAll");
    Route::any('/search', "$cr@searchBook");
    Route::any('/find-category', "$cr@findCategory");
    Route::get('/{id}/delete', "$cr@destroy");
    Route::any('/{id}', "$cr@getDetail");
});

Route::prefix('fav')->group(function () {
    $cr = "FavoriteController";
    Route::post('/store', "$cr@store");
    Route::any('/', "$cr@getAll");
    Route::any('/check', "$cr@check");
    Route::any('/delete', "$cr@deleteAndroid");
    Route::any('/find-category', "$cr@findCategory");
    Route::get('/{id}/delete', "$cr@destroy");
    Route::any('/{id}', "$cr@getDetail");
    Route::any('/user/{id}', "$cr@getByUser");
});

Route::prefix('auth')->group(function () {
    $cr = "ApiAuthController";
    Route::any('/login-unsafe', "$cr@login");
    Route::any('/register-unsafe', "$cr@register");
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
