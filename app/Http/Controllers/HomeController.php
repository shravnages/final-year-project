<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
        $account = Auth::user()->account;
        $last_transaction = null;
        if (!$transactions->isEmpty()) {
            $last_transaction =  $transactions->last();
        }
        $receive_amount = 0;
        if ($last_transaction) {
            $receive_amount = $last_transaction->amount;
        }

        return view('home', [
            'balance' => $balance,
            'transactions' => $transactions,
            'id' => $id,
            'account' => substr($account, 2),
            'receive_amount' => $receive_amount
        ]);
    }

    public function transferIndex() {

        $balance = Auth::user()->balance;
        $transactions = Auth::user()->transactions;
        $id = Auth::user()->id;
        $account = Auth::user()->account;
        $last_transaction = null;
        if (!$transactions->isEmpty()) {
            $last_transaction =  $transactions->last();
        }
        $receive_account = $last_transaction->account;
        $receive_amount = $last_transaction->amount * -1;

        return view('home', [
            'balance' => $balance,
            'transactions' => $transactions,
            'id' => $id,
            'account' => substr($account, 2),
            'receive_account' => substr($receive_account, 2),
            'receive_amount' => $receive_amount
        ]);
    }
}
