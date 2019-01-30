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

Route::get('/', function() {
    return view('welcome');
});

Route::get('/paywithpaypal', function() {
    return view('paywithpaypal');
});

Route::post('/payment/add-funds/paypal', 'PaymentController@payWithPaypal');
Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
