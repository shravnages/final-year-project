<?php

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
        return view('home', [
            'balance' => '&pound;' . number_format($balance, 2),
            'transactions' => $transactions,
            'id' => $id
        ]);
    }
}
