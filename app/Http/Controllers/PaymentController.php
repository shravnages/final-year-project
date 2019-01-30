<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Session;
use Redirect;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PaymentController extends Controller
{
    private $_api_context;
    public function __construct() {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['sandbox_client_id'],
            $paypal_conf['sandbox_secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function payWithPaypal(Request $request) {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1') 
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
            $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) 
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenienCE');
                return Redirect::route('paywithpaypal');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }


        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::back();
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            return Redirect::back();
        }

        \Session::put('error', 'Payment failed');
        return Redirect::back();
}
}
