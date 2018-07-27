@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ url('/home') }}">Home</a>
            <a href="{{ url('/users/news_feed_view') }}">News Feed</a>
            <a href="{{ url('/users/activity_feed_view') }}">Activity Feed</a>
            <a href="{{ url('/tweets/my_tweets') }}">My Tweets</a>

            <div class="panel panel-default">
                <div class="panel-heading">Activity Feed</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($activity_feed as $item)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ print_r(json_encode($item,JSON_PRETTY_PRINT)) }}</div>
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
