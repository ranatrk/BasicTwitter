<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Tweet;
use App\Mention;
use Auth;
use Response;

class UserController extends Controller
{
    protected $redirectTo = '/home';
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $users = User::all();
      return array('username' => $users);
    }

    public function show()
    {  $id = Auth::user()->id;
       $users = User::find($id);

      return Response::json(array('username' => $users));
    }

    public function destroy()
    {
        $id = Auth::user()->id;
        // $user = User::find($id);
        $users_following = User::where('id', '=', $id)
                    ->delete();

        return redirect('/home');

    }

    //Find a specific user using their username in a user_info view, to use their ID to find further details
    public function find_user(Request $request)
    {
        $user_info = User::where('username', '=', $request->input('username'))
                    ->get();

        return view('user_info', ['user_info' => $user_info]);
    }

    //Follow a certain user using their username
    public function follow(Request $request)
    {

        $id = Auth::user()->id;
        $follow = new Follow;
        $follow->follower_id  = $id;
        $followed_usernames = User::where('username', '=', $request->input('followed_username'))
                            ->select('id as followed_id')
                            ->get();
        foreach($followed_usernames as $followed_username) {
            $follow->followed_id = $followed_username->followed_id;
        }
        $follow->save();
        return redirect('/home');
    }

    //Show all the users that the current user is following
    public function show_following()
    {
        $follower_id = Auth::user()->id;
        $users_following = Follow::where('follower_id', '=', $follower_id)
                    ->join('users','follows.followed_id','=','users.id')
                    ->select('followed_id','users.name as followed_name','users.username as followed_username','users.email as followed_email')
                    ->get();
        return Response::json(array('users_following' => $users_following));
    }

    //Unfollow a certain user given their username
    public function unfollow(Request $request)
    {
        $id = Auth::user()->id;
        $followed_ids = User::where('username', '=', $request->input('followed_username'))
                            ->select('id')
                            ->get();
        $followed_ids_array = $followed_ids->toArray();

        Follow::where('follower_id','=',$id)
              ->whereIn('followed_id', $followed_ids_array)
              ->delete();

        return redirect('/home');
    }

    //Mention another user using their username and add the mention in the database
    public function mention(Request $request)
    {
        $id = Auth::user()->id;
        $mention = new Mention;
        $mention->mentioner_user_id  = $id;

        $mentioned_usernames = User::where('username', '=', $request->input('mentioned_username'))
                            ->select('id as followed_id')
                            ->get();
        foreach($mentioned_usernames as $mentioned_username) {
            $mention->mentioned_user_id = $mentioned_username->followed_id;
        }
        $mention->save();
        return redirect('/home');
    }

    //View the news feed data in the news feed view
    public function news_feed(){
      //return my followers and my tweets
      $id = Auth::user()->id;
      $news_feed_followers = User::where('users.id', '=', $id)
                    ->join('follows','follows.followed_id','=','users.id')
                    ->join('users as follower_users','follows.follower_id' , '=','follower_users.id')
                    ->select('follower_users.id as follower_id','follower_users.name as follower_name','follower_users.email as follower_email','follower_users.username as follower_username')
                    ->get();

      $news_feed_tweets = Tweet::where('user_id','=',$id)
                      ->get();
      $news_feed = array_merge($news_feed_followers->toArray(), $news_feed_tweets->toArray());

      return view('news_feed', ['news_feed' => $news_feed]);
    }

    // View the activity feed data in the activity feed view
    public function activity_feed(){
      //likes,twwets,mentions made by people I'm following
      $id = Auth::user()->id;
      $activity_feed = User::where('users.id', '=', $id)
                      ->join('follows as f','f.follower_id','=','users.id')
                      ->leftjoin('tweets as t','t.user_id','=','f.followed_id')
                      ->leftjoin('tweet_likes as l','l.user_id','=','f.followed_id')
                      ->leftjoin('tweets as liked_tweets','liked_tweets.tweet_id','=','l.tweet_id')
                      ->leftjoin('mentions as m','m.mentioner_user_id','=','f.followed_id')
                      ->leftjoin('users as mentioned_users','mentioned_users.id','=','m.mentioner_user_id')
                      ->get();

     return view('activity_feed', ['activity_feed' => $activity_feed->toArray()]);
    }
}
