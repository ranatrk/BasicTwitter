<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Http\Controllers\Auth\RegisterController.php

class UserController extends Controller
{
    //

    public function index()
    {
      $users = User::all();
      return array('username' => $users);
    }

    public function show($id)
    {
       $users = User::find($id);

      // return view('login', array('user' => $users));
      return array('username' => $users);
    }

    public function store(Request $request)
    {
      $rules = array(
        'name'       => 'required',
        'email'      => 'required|email',
        'password'   => 'required',
        'username'   => 'required'
      );

      // run the validation rules on the inputs from the form
      $validator = Validator::make(Input::all(), $rules);

      // if the validator fails, redirect back to the form
      if ($validator->fails()) {
          return Redirect::to('login')
              ->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {
          $user = new User;
          $user->username       = $request->input('username');
          $user->password       = $request->input('password');
          $user->name       = $request->input('name');
          $user->email      = $request->input('email');
          $user->save();

          // redirect
          // Session::flash('message', 'Successfully created user!');
          return $user;

          // attempt to do the login
          if (Auth::attempt($user)) {

              // validation successful!
              echo 'SUCCESS!';

          } else {
              // validation not successful, send back to form
              return Redirect::to('login');
          }
      }
    }


    public function destroy($username)
    {
        // $user = User::find($id);
        $users_following = User::where('username', '=', $username)
                    ->delete();

        // redirect
        // Session::flash('message', 'Successfully deleted the user!');
        // return Redirect::to('user');

    }

    public function get_user($username)
    {
        $user = User::where('username', '=', $username)
                    ->get();
        // redirect
        // Session::flash('message', 'Successfully created user!');
        return $user;
    }



    //Follow
    public function follow($id,Request $request)
    {
        $follow = new Follow;
        $follow->follower_id  = $id;
        $follow->followed_id  = $request->input('followed_id');
        $follow->save();

        // $follow = new Follow;
        // $follower = User::select('users.id as follower_id')
        //               ->where('username', '=', $follower_username)
        //               ->get();
        // $followed= User::select('users.id as followed_id')
        //               ->where('username', '=', $request->input('followed_username'))
        //               ->get();

        // $follow = $follower->union($followed)
        // $follow->save();

        // redirect
        // Session::flash('message', 'Successfully created user!');
        return $follow;
    }

    //users user in $id is following
    public function show_following($follower_id)
    {
        $users_following = Follow::where('follower_id', '=', $follower_id)
                    ->join('users','follows.followed_id','=','users.id')
                    ->select('followed_id','users.name as followed_name','users.username as followed_username','users.email as followed_email')
                    ->get();
        // redirect
        // Session::flash('message', 'Successfully created user!');
        return $users_following;
    }

    public function unfollow($id,Request $request)
    {
        // $followed_ids = User::where('username', '=', $request->input('followed_username'))
        //                     ->get();
        // $users_following = Follow::where('follower_id', '=', $id)
        //             ->where('followed_id', 'IN', $followed_ids)
        //             ->delete();
        // $user->delete();

        // redirect
        // Session::flash('message', 'Successfully deleted the user!');
        // return Redirect::to('user');
        return $followed_ids;

    }

    //users user in $id is being followed by


    public function mention($id,Request $request)
    {
        $mention = new Mention;
        $mention->mentioner_user_id  = $id;

        $mention->mentioned_user_id  = $request->input('mentioned_user_id');
        $mention->save();

    }


    public function news_feed($id){
      //return my followers and my tweets
    }

    public function activity_feed(){
      //likes,twwets,mentions made by people I'm following
    }






}
