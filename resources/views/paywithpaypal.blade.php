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
    <form class="content" method="POST" id="payment-form"  action="/payment/add-funds/paypal">
        {{ csrf_field() }}
    <h2>Purchase Tokens Here</h2>
    <p>How many Tokens would you like to purchase?</p>
    <p>      
    <label><b>Enter Amount</b></label>
    <input name="amount" type="text"></p>      
    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="Buy Now">
    <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
    </form>
  </div>
</body>
</html>