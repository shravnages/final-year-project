<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digipound</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/home') }}">Home</a>
                </div>
            @endif

            <div class="content">
                <h1>What are Digipounds?</h1>
                <div>
                </div>
                <h3>
                Digipounds are digital representations of GBP, currently trading at a 1:1 ratio.
                </h3>
                <h4>
                They are a form of stablecoin, as there will always be sufficient GBP in our reserve to redeem digipounds at any time.
                </h4>
                <h4>
                Confirm with our  <a href="{{ url('/') }}">audit</a>, updating in real-time.
                </h4>
                <h5>
                Easily purchase, redeem, and trade digipounds with other users. Soon to come - opportunity to invest in markets!
                </h5>
            </div>
        </div>
    </body>
</html>
