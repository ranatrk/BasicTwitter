<?php

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
//Registeration and log in routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register_view', function () {
    return view('auth/register');
})->name('register_view');

//Routes to user controller functions
Route::get('/users/news_feed_view','UserController@news_feed');
Route::get('/users/activity_feed_view','UserController@activity_feed');
Route::get('/users/find_user','UserController@find_user');
Route::post('/users/follow','UserController@follow');
Route::get('/users/following','UserController@show_following');
Route::delete('/users/unfollow','UserController@unfollow');
Route::post('/users/mention','UserController@mention');
Route::resource('/users', 'UserController');

//Routes to tweets controller functions
Route::post('/tweets/delete','TweetController@destroy');
Route::get('/tweets/my_tweets','TweetController@my_tweets');
Route::post('/tweets/like','TweetController@like_tweet');
Route::resource('/tweets', 'TweetController');




