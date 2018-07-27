@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ url('/home') }}">Home</a>
            <a href="{{ url('users/news_feed_view') }}">News Feed</a>
            <a href="{{ url('users/activity_feed_view') }}">Activity Feed</a>
            <a href="{{ url('/tweets/my_tweets') }}">My Tweets</a>

            <div class="panel panel-default">
                <div class="panel-heading">User Found</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($user_info as $user_i)
                                <tr>
                                    <td class="table-text">
                                        <div>Name : {{ print_r($user_i->name) }}</div>
                                        <div>ID: {{ print_r($user_i->id)}}</div>
                                        <div>Username: {{ print_r($user_i->username) }}</div>
                                        <div>Email: {{ print_r($user_i->email) }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
