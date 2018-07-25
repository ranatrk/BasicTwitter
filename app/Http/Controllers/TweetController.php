<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Tweet_Comment;
use App\Tweet_like;



class TweetController extends Controller
{

    //
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

  public function store(Request $request)
  {
      $tweet = new Tweet;
      $tweet->user_id       = $request->input('user_id');
      $tweet->tweet_text    = $request->input('tweet_text');
      $tweet->save();

      return $tweet;
  }


  public function destroy($tweet_id)
  {
      $users_following = Tweet::where('tweet_id', '=', $tweet_id)
                  ->delete();
  }

  //Tweet Comments
  public function get_tweets_comment()
  {
    $tweets = Tweet::join('tweet_comments','tweets.tweet_id','=','tweet_comments.tweet_id')
                  ->get();

    return $tweets;
  }
  public function comment($id,Request $request)
  {
    $tweet_comment = new Tweet_Comment;
    $tweet_comment->tweet_id       = $id;
    $tweet_comment->user_id       = $request->input('user_id');
    $tweet_comment->comment       = $request->input('comment');
    $tweet_comment->save();

    return $tweet_comment;
  }

  public function like_tweet($id,Request $request)
  {
    $tweet_like = new Tweet_like;
    $tweet_like->tweet_id       = $id;
    $tweet_like->user_id       = $request->input('user_id');
    $tweet_like->save();

    return $tweet_like;
  }


}
