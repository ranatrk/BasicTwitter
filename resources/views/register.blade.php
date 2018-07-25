
@extends('layouts.main')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <form action="{/users}" method="post">
                    Username:<br>
                    <input type="text" name="username" >
                    <br>
                   Password:<br>
                    <input type="text" name="password">
                    <br><br>
                   Email:<br>
                    <input type="text" name="email">
                    <br><br>
                   Name:<br>
                    <input type="text" name="name">
                    <br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <!-- TODO: Current Tasks -->
@endsection
