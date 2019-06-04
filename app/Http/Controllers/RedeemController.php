<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe, Stripe\Charge, Stripe\Token, Stripe\Account, Stripe\File, Stripe\Payout, Stripe\Transfer;
use Auth;
use App\Transaction;

class RedeemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('redeem');
    }

    public function submit(Request $request) {
        if($_POST['amount'] <= Auth::user()->balance) {
            if ($_POST['amount'] >= 0) {
                $new_balance = Auth::user()->balance;
                $new_balance -= $_POST['amount'];
                Auth::user()->update(['balance' => $new_balance]);
                Stripe::setApiKey(getenv('STRIPE_SECRET'));
                $transfer = Transfer::create([
                    "amount" => $_POST["amount"]*100,
                    "currency" => "gbp",
                    "destination" => Auth::user()->account_no
                ]);
                $payout = Payout::create([
                    "amount" => $_POST["amount"]*100,
                    "currency" => "gbp",
                    "description" => "Test Payment"
                ], ['stripe_account' => Auth::user()->account_no]);
                $transaction = Transaction::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $_POST['amount'],
                    'stripe_transaction' => $payout->id,
                    'account' => Auth::user()->account
                ]);
                $request->session()->flash('refund_status', 'Refund Pending...');
                return redirect()->route('home');
            }
            else {
                $request->session()->flash('error', 'Transaction failed: Invalid number.');
            }
        } 
        else {
            $request->session()->flash('error', 'Transaction failed: Not enough funds.'); 
        }
        return redirect()->route('home');
    }
}
