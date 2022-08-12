<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\CommentController;


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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();
Route::resource('post', PostController::class);
Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('post.store');
Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts');
Route::get('/post/show/{id}', 'App\Http\Controllers\PostController@show')->name('post.show');

Route::get('/post/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('post.edit');
Route::put('/post/edit/{id}', 'App\Http\Controllers\PostController@update')->name('post.update');