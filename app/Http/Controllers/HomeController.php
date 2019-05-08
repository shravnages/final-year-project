<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use EthereumRPC\EthereumRPC;
use ERC20\ERC20;
use Web3\Web3;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $balance = Auth::user()->balance;
        $transactions = Auth::user()->transactions;
        $id = Auth::user()->id;

        //token
        
        /*$geth = new EthereumRPC('127.0.0.1', 8545);
        $erc20 = new ERC20($geth);
        $token = $erc20->token("0xf5e7f08c91b5d8579746eaad70ac509e94e2f1d3");
        var_dump($token);*/

        $web3 = new Web3('http://localhost:8545');
        $eth = $web3->eth;

        


        return view('home', [
            'balance' => $balance,
            'transactions' => $transactions,
            'id' => $id,
            //'token_name' => $token_name
        ]);
    }
}
