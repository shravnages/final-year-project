<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;
use App\Transaction;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pay');
    }

    public function submit(Request $request)
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET'));
        try {
            $charge = Charge::create([
                'amount' => $_POST['amount']*100,
                'currency' => 'gbp',
                "source" => $_POST['token'],
                "description" => "test"
            ]);
            $new_balance = Auth::user()->balance;
            $new_balance += $_POST['amount'];
            Auth::user()->update(['balance' => $new_balance]);
            if ($charge->status == "succeeded") {
                $transaction = Transaction::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $_POST['amount'],
                    'stripe_transaction' => $charge->id
                ]);
                $request->session()->flash('status', 'Transaction Successful');
            }
            else {
                $request->session()->flash('error', 'Transaction failed');
            }
        }
        catch (\Stripe\Error\Card $e) {
            $request->session()->flash('error', 'Transaction failed');
        }
        return redirect()->route('home');
    }
}
