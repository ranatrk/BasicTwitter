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
// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::resource('/users', 'UserController');
Route::get('/users/getUser/{username}','UserController@get_user');
Route::post('/users/follow/{follower_username}','UserController@follow');
Route::get('/users/following/{follower_username}','UserController@show_following');
Route::delete('/users/unfollow/{follower_username}','UserController@unfollow');
Route::post('/users/mention/{mentioner_username}','UserController@mention');


Route::resource('/tweets', 'TweetController');
Route::post('/tweets/comment/{tweet_id}','TweetController@comment');
Route::post('/tweets/tweets_comments','TweetController@get_tweets_comment');
Route::post('/tweets/like/{tweet_id}','TweetController@like_tweet');

// Route::post('/user', 'UserController');

// Route::get('/', function () {
//    return view('login');
// });

// Route::get('/allUsers', function () {
//    //return all users(ID and username)
// });

// Route::get('/userSearch/{user_id}', function () {
//    //
// });

// //Add A New follow
// Route::post('/follow/{user_id}', function (Request $request) {
//     //request contains the username/id of the user to be followed by user_id
//     $validator = Validator::make($request->all(), [
//         'username' => 'required|max:255',
//     ]);
//     if ($validator->fails()) {
//         return redirect('/')
//             ->withInput()
//             ->withErrors($validator);
//     }
// });




// // // Delete An Existing --
// // Route::delete('/task/{id}', function ($id) {
// //     //
// // });

// //Add A New tweet
// Route::post('/addTweet/{user_id}', function (Request $request) {
//     //request contains the tweet text
// });

// //Add A New comment on an existing tweet
// Route::post('/addTweet/{user_id}/{tweet_id}', function (Request $request) {
//     //request contains the comment text
// });

// //Add A New comment on an existing tweet
// Route::post('/likeTweet/{user_id}/{tweet_id}', function (Request $request) {
//     //
// });

// //Add A New comment on an existing tweet
// Route::post('/mentionUser/{user_id}/{comment_id}', function (Request $request) {
//     //request contains the mentionedUser ID
// });

// // Delete An Existing tweet
// Route::delete('/deleteTweet/{user_id}/{tweet_id}', function ($id) {
//     //
// });

// Route::get('/newsFeed/{user_id}', function () {
//    //get my followers and my own tweets
// });

// Route::get('/activityFeed/{user_id}', function () {
//    //get likes,tweets,mentions made by people im following
// });
