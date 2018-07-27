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
                <div class="panel-heading">My tweets</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($my_tweets as $my_tweet)
                                <tr>
                                    <td class="table-text">
                                        <div>Tweet ID:  {{print_r($my_tweet->tweet_id) }}</div>
                                        <div>{{ print_r($my_tweet->tweet_text) }}</div>
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
