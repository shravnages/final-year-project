@extends('layouts.main');

@section('content');
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" id="welcome-message">
                </div>
                <div>
                    Stable Online Investments with Accurate Fiat Backing
                </div>
                <div>
                </div>
                <div class="links">
                    <a href="\pay">Purchase Tokens Now</a>
                    <a href="\about">About Digipound</a>
                </div>
            </div>
        </div>
        <script>
            token.name.call(function(err, name) {
                document.getElementById("welcome-message").innerHTML = "Welcome to " + name;
            });
        </script>
    </body>
@endsection
