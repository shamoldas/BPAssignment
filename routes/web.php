<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::resource('post', PostController::class);
Route::get('/post', 'App\Http\Controllers\PostController@create')->name('post.index');
Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('post.store');
Route::get('posts', 'App\Http\Controllers\PostController@index')->name('posts');
Route::get('post/show/{id}', 'App\Http\Controllers\PostController@show')->name('post.show');

Route::get('/post/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('post.edit');
Route::put('/post/edit/{id}', 'App\Http\Controllers\PostController@update')->name('post.update');

Route::resource('comment', CommentController::class);


Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('comment.add');
Route::post('/reply/store', 'App\Http\Controllers\CommentController@replyStore')->name('reply.add');

Route::get('display', 'App\Http\Controllers\CommentController@index')->name('display');



Route::get('mypost', 'App\Http\Controllers\PostController@myPost')->name('mypost');

Route::resource('blog', BlogController::class);
Route::get('/searchpost/', 'App\Http\Controllers\BlogController@searchpost')->name('searchpost');

Route::get('last5', 'App\Http\Controllers\BlogController@last5')->name('last5');


Route::get('blog', 'App\Http\Controllers\PostController@index')->name('blog');
Route::resource('blog', BlogController::class);

