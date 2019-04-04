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
    <div id="token-purchase">
        <form class="content" id="payment-form" method="POST" id="payment-form"  action="/pay">
            {{ csrf_field() }}
        <h2>Purchase Tokens Here</h2>
        <p>How many Tokens would you like to purchase?</p>
        <p>Conversion Rate: 1 Digipound/GBP</p>
        <p>  
        <label><b>Enter Amount</b></label>
        <input type="text" name="amount" placeholder="Enter amount" />
        <input type="hidden" id="token" name="token" />
          <div id="card-element"></div>
          <button id="sub" type="submit">Pay</button>
          <div id="spinner" style="display:none;">
            <img id="img-spinner" src="spinner.gif" alt="Loading" />
          </div>
        </form>
    </div>
  </div>

  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  <script>
  var stripe = Stripe('<?=getenv("STRIPE_PUBLIC")?>');
  var elements = stripe.elements();
  var card = elements.create('card');
  card.mount('#card-element');

  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event){
    event.preventDefault();
    stripe.createToken(card).then(function (result) {
        if (result.error) {
            alert("WRONG");
        }
        else {
            document.getElementById('token').setAttribute('value', result.token.id);
            form.submit();
        }
    });
  });
  </script>
</body>
</html>