<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;
use App\Transaction;
use App\User;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $balance = Auth::user()->balance;
        return view('transfer', [
            'balance' => $balance
        ]);
    }

    public function submit(Request $request)
    {
        if($_POST['amount'] <= Auth::user()->balance) {
            if ($_POST['amount'] >= 0) {
                $recipient = User::where('id', $_POST['id'])->first();
                if (!$recipient) {
                    $request->session()->flash('error', 'Transaction failed: Invalid recipient.');
                }
                else {
                    $new_balance = Auth::user()->balance;
                    $new_balance -= $_POST['amount'];
                    Auth::user()->update(['balance' => $new_balance]);
                    $recipient_balance = $recipient->balance;
                    $recipient_balance += $_POST['amount'];
                    $recipient->update(['balance' => $recipient_balance]);
                    $transaction1 = Transaction::create([
                        'user_id' => Auth::user()->id,
                        'amount' => $_POST['amount']*-1,
                        'stripe_transaction' => 'Transfer ' . $recipient->name,
                        'account' => $recipient->account
                    ]);
                    $transaction2 = Transaction::create([
                        'user_id' => $_POST['id'],
                        'amount' => $_POST['amount'],
                        'stripe_transaction' => 'Transfer ' . Auth::user()->name,
                        'account' => Auth::user()->account
                    ]);
                    $request->session()->flash('transfer_status', 'Transaction Pending...');
                    return redirect()->route('homeTransfer');
                }
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
