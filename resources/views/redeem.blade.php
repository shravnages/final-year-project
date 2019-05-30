@extends('layouts.main');

@section('content');
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
        <form class="content" id="payment-form" method="POST" id="payment-form"  action="/redeem">
            {{ csrf_field() }}
        <h2>Redeem Tokens Here</h2>
        <p>How many Tokens would you like to redeem?</p>
        <p>Conversion Rate: 1 Digipound/GBP</p>
        <p>  
        <label><b>Enter Amount</b></label>
        <input type="text" name="amount" placeholder="Enter amount" />
          <div id="card-element"></div>
          <button id="sub" type="submit">Redeem</button>
          <div id="spinner" style="display:none;">
            <img id="img-spinner" src="spinner.gif" alt="Loading" />
          </div>
        </form>
        <br />
	    <div id="results"></div>
    </div>
  </div>