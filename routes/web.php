<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AuditController@index');

Route::post('/payment/add-funds/paypal', 'PaymentController@payWithPaypal');
Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homeTransfer', 'HomeController@transferindex')->name('homeTransfer');


Route::get('/pay', 'StripeController@index');
Route::post('/pay', 'StripeController@submit');

Route::get('/transfer', 'TransferController@index');
Route::post('/transfer', 'TransferController@submit');

Route::get('/redeem', function() {
    return view('redeem');
});
Route::post('/redeem', 'RedeemController@submit');

Route::get('/audit', 'AuditController@index');

Route::get('/acct', 'StripeController@addBankAccount');
Route::get('/verify', 'StripeController@submitAcctVerification');
Route::get('/send', 'StripeController@sendMoney');

Route::get('/about', function() {
    return view('about');
});

