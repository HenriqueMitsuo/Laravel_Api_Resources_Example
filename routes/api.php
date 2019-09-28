<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Article Routes
 */

// List all articles
Route::get('articles', 'ArticleController@index')->middleware('cors', 'apilogger');
// List one article
Route::get('article/{id}', 'ArticleController@show')->middleware('cors', 'apilogger');
// Create new article
Route::post('article', 'ArticleController@store');
// Update article
Route::put('article', 'ArticleController@store');
// Delete article
Route::delete('article/{id}', 'ArticleController@destroy');

/**
 * User Routes
 */
// Rota para teste
Route::get('user/{id}', 'UserController@show')->middleware('jwt','cors');

Route::post('user', 'UserController@store')->middleware('cors');
Route::post('user/login', 'UserController@login')->middleware('cors');

