<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Digipound</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/skel.min.js') }}"></script>
		<script src="{{ asset('js/skel-layers.min.js') }}"></script>
        <script src="{{ asset('js/init.js') }}"></script>
        <link rel="stylesheet" href="http://github.hubspot.com/odometer/themes/odometer-theme-plaza.css" />
        <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
        <script src="http://github.hubspot.com/odometer/odometer.js"></script>
		<noscript>
			<link rel="stylesheet" href="{{ asset('css/skel.css') }}" />
			<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
			<link rel="stylesheet"href="{{ asset('css/style-xlarge.css') }}" />
        </noscript>

        <script src="https://cdn.jsdelivr.net/npm/web3@0.20.1/dist/web3.min.js"></script>
        
        <script>
        var web3;
        if (typeof web3 !== 'undefined') {
            web3 = new Web3(web3.currentProvider);
        } else {
            web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
        }
        web3.eth.defaultAccount = web3.eth.accounts[0];
        var erc20abi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"a","type":"uint256"},{"name":"b","type":"uint256"}],"name":"safeSub","outputs":[{"name":"c","type":"uint256"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"a","type":"uint256"},{"name":"b","type":"uint256"}],"name":"safeDiv","outputs":[{"name":"c","type":"uint256"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"},{"name":"data","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"a","type":"uint256"},{"name":"b","type":"uint256"}],"name":"safeMul","outputs":[{"name":"c","type":"uint256"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":true,"inputs":[],"name":"newOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"a","type":"uint256"},{"name":"b","type":"uint256"}],"name":"safeAdd","outputs":[{"name":"c","type":"uint256"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"tokenOwner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Approval","type":"event"}];
        var contractAddress = "0xf6cd47EB9ca7e1a94e3B70722E9D7964fE14A811";
        var token = web3.eth.contract(erc20abi).at(contractAddress);
        </script>
        <?php use App\User ?>

	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header">
				<h1><a href="/">Digipound</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="#about">About</a></li>
                        <li><a href="#audit">Audit</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ url('/home') }}" class="button special">Home</a></li>
                            @else
                                @if (Route::has('register'))
                                    <li><a href="#register">Register</a></li>
                                @endif
                                <li><a href="{{ route('login') }}" class="button special">Login</a></li>
                            @endauth
                            </div>
                        @endif
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner" opacity="0.3">
                @auth
                    <h2>Welcome, {{Auth::user()->name}}.</h2>
                @else
                    <h2>Digipound.</h2>
                @endauth
                <img src="{{ asset('GBP.png') }}" width="200" style="opacity: 0.1" />
                @auth
                    <p>Unlock the possibilities of Digipound.</p>
                @else
                    <p>The Future of Money.</p>
                @endauth
				<ul class="actions">
                    @auth
                    <li>
						<a href="/home" class="button big">Start Investing!</a>
                    </li>
                    @else
					<li>
						<a href="#register" class="button big">Register Now!</a>
                    </li>
                    @endauth
				</ul>
			</section>

		<!-- About -->
			<section id="about" class="wrapper style1 special">
				<div class="container">
					<header class="major">
						<h2>Currency for the 21st Century.</h2>
						<p>Invest in the future of money today! The Digipound (DGP) is an ERC20 token that serves as a form of stablecoin. It is guaranteed to be fully 
                            collateralised. Just take a look at our <a href="#audit">audit</a>, updated in real time after every single transaction.
                            Easily purchase and return Digipounds, and trade them with other users or over any ERC20 market.</p>
					</header>
					<div class="row 150%">
						<div class="4u 12u$(medium)">
							<section class="box">
                            <i><img src="{{ asset('handshake.png') }}" width="125" /></i>
								<h3>Issue</h3>
								<ul>
                                    <li>
                                        <p>Using any bank card, purchase an appropriate amount of DGP with GBP.</p>
                                    </li>   
                                    <li>
                                        <p>A transaction will immediately be created on the Ethereum blockchain issuing you Digipounds.</p>
                                    </li>
                                    <li>
                                        <p>Your ERC20 balance will be updated promptly.</p>
                                    </li>  
                                </ul>
							</section>
						</div>
						<div class="4u 12u$(medium)">
							<section class="box">
                                <i><a href="https://ropsten.etherscan.io/token/0xf6cd47eb9ca7e1a94e3b70722e9d7964fe14a811"><img src="{{ asset('ethereum.png') }}" width="125" /></a></i>
								<h3>Trade</h3>
								<ul>
                                    <li>
                                        <p>The DGP is an ERC20 token, which you can use however you wish.</p>
                                    </li>   
                                    <li>
                                        <p>Invest them, trade them - the possibilities are endless!</p>
                                    </li>
                                    <li>
                                        <p>Direct transfers of DGP are also supported through the Digipound website.</p>
                                    </li>  
                                </ul>
                            </section>
						</div>
						<div class="4u$ 12u$(medium)">
							<section class="box">
                            <i><img src="{{ asset('GBP.png') }}" width="125" /></i>
								<h3>Redeem</h3>
                                <ul>
                                    <li>
                                        <p>You will always be able to redeem any amount of DGP.</p>
                                    </li>   
                                    <li>
                                        <p>Simply make a request and a new transaction will be created and processed.</p>
                                    </li>
                                    <li>
                                        <p>The DGP reserve will immediately issue a payout of GBP into your bank account.</p>
                                    </li>  
                                </ul>
                            </section>
						</div>
					</div>
				</div>
			</section>

		<!-- Audit -->
			<section id="audit" class="wrapper style2 special">
				<div class="container">
					<header class="major">
						<h1>1 : 1</h1>
						<p>Always transparent. Digipounds are digital representations of GBP, currently trading at an equal valuation. Here's proof:</p> 
	        		</header>
					<div class="row 150%">
						<div class="6u 18u$(medium)">
							<section class="box">
                            <div classname="odometer" id="odometer1" name="odometer1" style="font-size: 60px"></div>
                                <h3>GBP in the reserve account.</h3>
                                <table>
                                <thead>
                                    <th><strong>Current Inbound Payments:</strong> </th>
                                    <th><strong>Current Outbound Payouts:</strong> </th>
                                </thead>
                                <tbody>
                                <tr>
                                <td>
                                    <ul>
                                        @foreach ($transactions as $transaction)
                                            @if (strpos($transaction->stripe_transaction, 'ch') !== false)
                                                <li><a href="https://dashboard.stripe.com/test/payments/{{$transaction->stripe_transaction}}" title="Transcation ID: {{$transaction->stripe_transaction}}" style="color: #006697">&pound;{{ number_format($transaction->amount, 2) }}</a> 
                                                    <br> => {{ $transaction->created_at }}.</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td width="50%">
                                    <ul>
                                        @foreach ($transactions as $transaction)
                                            @if (strpos($transaction->stripe_transaction, 'po') !== false or strpos($transaction->stripe_transaction, 'Refund') !== false)
                                                <li><a href="https://dashboard.stripe.com/{{User::where('id', $transaction->user_id)->first()->account_no}}/test/payouts/{{$transaction->stripe_transaction}}" title="Transcation ID: {{$transaction->stripe_transaction}}" style="color: #006697">&pound;{{ number_format($transaction->amount, 2) }}</a> 
                                                    <br> => {{ $transaction->created_at }}.</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                </tbody>
                                </table>
                            <div class="footer">Verified by    <a href="https://stripe.com/gb"><i style="font-size:25px" class="fab fa-cc-stripe"></i></a>.
                            </div>
							</section>
						</div>
						<div class="6u$ 18u$(medium)">
							<section class="box">
                            <div classname="odometer" id="odometer2" name="odometer2" style="font-size: 60px"></div>
								<h3>DGP issued.</h3>
                                <ul>
                                    <strong>Current Holders:</strong>
                                    @foreach ($users as $user)
                                        @if ($user-> balance > 0)
                                        <li>
                                            <p><a href="https://ropsten.etherscan.io/address/{{$user->account}}" style="color: #006697">{{$user->account}}</a>
                                                <br> => {{$user->balance}} DGP.</p>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="footer"><small><div id="remaining"></div>Last transaction on {{$date}}.</small><div>
                                <div class="footer">Verified by 
                                    <a href="https://ropsten.etherscan.io/token/0xf6cd47eb9ca7e1a94e3b70722e9d7964fe14a811#balances" style="color: #006697">
                                    Etherscan. </a><small>*</small>
                                    
                                </div>
                                <div class="footer">
                                    <smaller style="color: #dddddd">*Exact totals of users may be subject to independent transactions, but total amount of DGP issued always correct.</smaller>
                                </div>
                            </section>
						</div>
					</div>
				</div>
            </section>

            <script>

                window.odometerOptions = {
                    auto: false, 
                    selector: '.my-numbers',
                    format: '(,ddd).dd',
                    duration: 5,
                };

                var el = document.getElementById('odometer1');
 
                od = new Odometer({
                    el: el,
                    value: 0,
                });

                var el = document.getElementById('odometer1');
 
                od = new Odometer({
                    el: el,
                    value: 0,
                });

                var el2 = document.getElementById('odometer2');

                od2 = new Odometer({
                    el: el2,
                    value: 0,
                });
                

                var balance = 0;
                var accountAddress =  "0x0b5e6646f3665e5132fddaabf1af95386e70148f";
                token.balanceOf.call(accountAddress, function(err, bal) {
                    if (!err) {
                        balance = bal.toNumber(); 
                        balance /= 1000000000000000000;
                        currentbalance = Math.round(100000000 - balance); //total supply
                        el2.innerHTML = currentbalance.toFixed(2);
                        document.getElementById("remaining").innerText = balance + " DGP remaining in stock.";
                    }
                });


                el.innerHTML = (<?php echo $balance ?>).toFixed(2);
            
            </script>

		<!-- Three -->
        @auth
                
        @else
			<section id="register" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>Welcome to Digipound.</h2>
						<p>Join a community of intelligent investors in seconds!</p>
						<p>Please provide us with your ERC20 address so we can issue you digipounds, and your bank details so we can redeem them at any time!</p>
					</header>
				</div>
				<div class="container 50%">
					<form method="POST" action="{{ route('register') }}">
                        @csrf

						<div class="row uniform">
                            <div class="6u 12u$(small)">
                                <input placeholder="First Name." id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Last Name." id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Email." id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="ERC20 Account." id="account" type="text" class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}" name="account" value="{{ old('account') }}" required>

                                @if ($errors->has('account'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Sortcode (no hyphens!)." id="routing" type="text" class="form-control{{ $errors->has('routing') ? ' is-invalid' : '' }}" name="routing" value="{{ old('routing') }}" required>

                                @if ($errors->has('routing'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('routing') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Bank Account Number." id="account_no" type="text" class="form-control{{ $errors->has('account_no') ? ' is-invalid' : '' }}" name="account_no" value="{{ old('account_no') }}" required>

                                @if ($errors->has('account_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Password." placeholder="id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="6u 12u$(small)">
                                <input placeholder="Confirm Password." id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="12u$">
                                <input value="Register" type="submit" class="special big">
                            </div>

						</div>
					</form>
				</div>
			</section>
        @endauth
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="4u 6u$(medium)">
							<ul class="copyright">
								<li>&copy; Digipound. All rights reserved.</li>
							</ul>
						</div>
                        <div class="4u$ 6u$(medium)">
							<ul class="copyright">
								<li>Shravan Nageswaran.</a></li>
								<li>Imperial College London 2019</a></li>
							</ul>
						</div>
					</div>
				</div>
            </footer>

	</body>
</html>