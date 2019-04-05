<!DOCTYPE html>
<html>
<head>
    <title>Purchase Tokens</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
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
    <div class="top-right links">
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
        
        @if ($message = Session::get('success'))
            <div>
                <span onclick="this.parentElement.style.display='none'">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('success');?>
        @endif
        @if ($message = Session::get('error'))
            <div>
                <span onclick="this.parentElement.style.display='none'">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('error');?>
        @endif

    </div>
    <div id="token-transfer">
        <form class="content" id="transfer-form" method="POST" id="transfer-form"  action="/transfer">
            {{ csrf_field() }}
        <h2>Transfer Tokens Here</h2>
        <p>You have a balance of {{ $balance }} DGP.</p>
        <p>  
        <label><b>Enter ID of user to transfer DigiPounds to.</b></label>
        <input type="number" name="id" placeholder="ID" />
        <input type="number" name="amount" placeholder="DGP" />
        <input type="hidden" id="token" name="token" />
          <div id="card-element"></div>
          <button id="sub" type="submit">Transfer</button>
        </form>
    </div>
  </div>

</body>
</html>