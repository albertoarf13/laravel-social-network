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

/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', "PagesController@index");

Route::get('/about', "PagesController@about");

Route::get('/services', "PagesController@services");

Route::resource('/posts', "PostsController");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}', 'HomeController@profile');

Route::post('/comments/{post}', 'CommentsController@store');
Route::delete('/comments/{id}', 'CommentsController@destroy');

Route::get('/follows/allUsers', 'FollowsController@allUsers');
Route::get('/follows/{followee_id}', 'FollowsController@store');
Route::delete('/follows/{followee_id}', 'FollowsController@destroy');
