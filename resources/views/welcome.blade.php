<!doctype html>
<html>
  <head>
  <title>Digipound</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
        <noscript><link rel="stylesheet" href="{{ asset('css/noscript.css') }}" /></noscript>
        <script src="https://cdn.jsdelivr.net/npm/web3@0.20.1/dist/web3.min.js"></script>
   </head>
	<body class="homepage is-preload">
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
            var contract = web3.eth.contract(erc20abi);
            var token = contract.at(contractAddress);
            token.name.call(function(err, name) {
                document.getElementById("welcome").innerHTML = name;
            });
        </script>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="new-header" style="background-image: url('/london.jpg')">
					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><div id="welcome"></div></h1>
								<hr />
								<p>Currency for the 21st Century</p>
							</header>
							<footer>
								<a href="#banner" class="button circled scrolly">Start</a>
							</footer>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="/">Digipound</a></li>
								<li><a href="#banner">Learn More</a></li>
                                @if (Route::has('login'))
                                    @auth
                                        <li><a href="{{ url('/home') }}">Home</a></li>
                                    @else
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                        @endif
                                    @endauth
                                    </div>
                                @endif
							</ul>
						</nav>

				</div>

			<!-- Banner -->
            <section id="banner">
                <header>
                    <h2>Welcome to <strong>Digipound</strong>.</h2>
                    <p>
                        Stable Online Investments with Accurate Fiat Backing.
                    </p>
                </header>
            </section>

			<!-- Main -->
				<div class="wrapper style2">

					<article id="main" class="container special">
						<a href="#" class="image featured"><img src="images/pic06.jpg" alt="" /></a>
						<header>
							<h2>Modern Day Cryptocurrency.</h2>
							<p>
								Digipounds are digital representations of GBP, currently trading at a 1:1 ratio.
							</p>
						</header>
						<p>
							Invest in the future of money today! The Digipound (DGP) is an ERC20 token that serves as a form of stablecoin. It is guaranteed to be fully 
                            collateralised. Just take a look at our <a href="{{ url('/audit') }}">audit</a>, updated in real time after every single transaction.
                            Easily purchase and return Digipounds, and trade them with other users or over any ERC20 market. <a href="#cycle"><underline>How does the cycle work?</underline></a>
                        </p>

					</article>

				</div>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

							<!-- Tweets -->
								<section id="cycle" class="col-4 col-12-mobile">
									<header>
										<!--<h2 class="icon fa-twitter circled"><span class="label">Tweets</span></h2>-->
                                        <h2><span class="label">Issue</span></h2>
									</header>
									<ul class="divided">
										<li>
											<article class="tweet">
												Using any bank card, purchase an appropriate amount of DGP with GBP.
											</article>
										</li>
										<li>
											<article class="tweet">
												A transaction will immediately be created on the Ethereum blockchain issuing you Digipounds.
											</article>
										</li>
										<li>
											<article class="tweet">
												Your ERC20 balance will be updated.
											</article>
										</li>
									</ul>
								</section>

							<!-- Posts -->
								<section class="col-4 col-12-mobile">
									<header>
										<h2><span class="label">Trade</span></h2>
									</header>
									<ul class="divided">
										<li>
											<article class="tweet">
												The DGP is an ERC20 token, which you can use however you wish.
											</article>
										</li>
                                        <li>
											<article class="tweet">
												Invest them, trade them - the possibilities are endless!
											</article>
										</li>
										<li>
											<article class="tweet">
												Direct transfers of DGP are also supported through the Digipound website.
											</article>
										</li>
									</ul>
								</section>

							<!-- Photos -->
								<section class="col-4 col-12-mobile">
									<header>
										<h2><span class="label">Redeem</span></h2>
									</header>
									<ul class="divided">
										<li>
											<article class="tweet">
												You will always be able to redeem any amount of DGP.
											</article>
										</li>
										<li>
											<article class="tweet">
												Simply make a request and a new transaction will be created and processed.
											</article>
										</li>
                                        <li>
											<article class="tweet">
												The DGP reserve will immediately issue a payout of GBP into your bank account.
											</article>
										</li>
									</ul>
								</section>

						</div>
						<hr />
						<div class="row">
							<div class="col-12">
								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; Shravan Nageswaran</li><li>Imperial College London</a></li>
										</ul>
									</div>

							</div>

						</div>
					</div>
				</div>
		</div>

		<!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

	</body>
</html>
