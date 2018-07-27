<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tweet;
use App\User;
use App\Tweet_like;


class TweetController extends Controller
{
  protected $redirectTo = '/home';

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $tweets = Tweet::all();
    return array('tweet' => $tweets);
  }

  public function show($tweet_id)
  {
     $tweets = Tweet::where('tweet_id', '=', $tweet_id)
                  ->get();

    return array('tweets' => $tweets);
  }

  //Create a new tweet for the current user and save it in the database then redirect to home view
  public function store(Request $request)
  {
      if (Auth::check())
      {
        $tweet = new Tweet;
        $tweet->user_id       = Auth::user()->id;
        $tweet->tweet_text    = $request->input('tweet_text');
        $tweet->save();

      // return $tweet;
      return redirect('/home');
    }
  }

  //Delete from the database one of the current users' tweets then redirect to home view
  public function destroy(Request $request)
  {
    $user_id = Auth::user()->id;
    $users_following = Tweet::where('tweet_id', $request->input('tweet_id'))
                  ->where('user_id',$user_id)
                  ->delete();
    return redirect('/home');
  }

  //Create a new tweet like for the current user and save it in the database
  public function like_tweet(Request $request)
  {
    $tweet_like = new Tweet_like;
    $tweet_like->tweet_id       = $request->input('tweet_id');
    $tweet_like->user_id       = Auth::user()->id;
    $tweet_like->save();

    return redirect('/home');
  }

  // view all the tweets the current user posted in the my_tweets view
  public function my_tweets()
  {
    $user_id = Auth::user()->id;
    $my_tweets = Tweet::where('user_id', '=', $user_id)
                  ->get();

    return view('my_tweets', ['my_tweets' => $my_tweets]);
  }

}
