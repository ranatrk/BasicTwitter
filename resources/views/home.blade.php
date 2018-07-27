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
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content">
                        <form action="/tweets" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">New Tweet</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tweet_text" id="tweet_text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Find/Follow User</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content">
                        <form action="/users/follow" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="followed_username" id="followed_username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Follow User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content">
                        <form action="/users/find_user" method="GET" class="form-horizontal">
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Find User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="content">
                        <form action="/users/mention" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="mentioned_username" id="mentioned_username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Mention User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Like/Delete Tweets</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content">
                        <form action="/tweets/like" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Tweet ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tweet_id" id="tweet_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Like Tweet
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content">
                        <form action="/tweets/destroy" method="POST"  class="form-horizontal">
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Tweet ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tweet_id" id="tweet_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i>Delete Tweet
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">All Usernames</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ print_r($user->username)}}</div>
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
