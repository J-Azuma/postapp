<?php

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

Route::get('/', 'PostController@index')->name('home');
Route::get('/posts/index','PostController@index')->name('posts.index');
Route::post('/posts/create', 'PostController@create')->name('posts.create');
Route::get('/posts/detail/{post}', 'PostController@showDetail')->name('posts.showdetail');
Route::post('/posts/delete/{post}', 'PostController@delete')->name('posts.delete');
Route::post('/comments/create/{post}', 'CommentController@create')->name('comments.create');
Route::get('users/detail/{user}', 'UserController@showDetail')->name('users.showdetail');
Route::get('users/edit/{user}', 'UserController@showEditForm')->name('users.showeditform');
Auth::routes();
