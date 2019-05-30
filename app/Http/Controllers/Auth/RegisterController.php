<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Stripe\Stripe, Stripe\Charge, Stripe\Token, Stripe\Account, Stripe\File, Stripe\Payout, Stripe\Transfer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'account' => ['required', 'string', 'max:255', 'unique:users'],
            'routing' => ['required', 'string', 'max:255'],
            'account_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET'));
        try {
            $bank = Account::create([
                "type" => "custom",
                "country" => "GB",
                "email" => $data['email'],
                "business_type" => "individual",
                "individual" => [
                    "first_name" => $data['name'],
                    "last_name" => $data['surname'],
                    "address" => [
                        "line1" => "Imperial College London",
                        "line2" => "Exhibition Road",
                        "city" => "London",
                        "country" => "GB",
                        "postal_code" => "SW7 2AZ"
                    ],
                    "dob" => [
                        "day" => 1,
                        "month" => 1,
                        "year" => 1990
                    ]
                ],
                "external_account" => [
                    "object" => "bank_account",
                    "country" => "GB",
                    "currency" => "gbp",
                    "account_holder_name" => $data['name'] . " " . $data['surname'],
                    "routing_number" => $data['routing'],
                    "account_number" => $data['account_no']
                ],
                "tos_acceptance" => [
                    "date" => time(),
                    "ip" => $_SERVER['REMOTE_ADDR'],
                ]
            ]);
            try {
                $file1 = File::create([
                    'purpose' => 'identity_document',
                    'file' => fopen($_SERVER['DOCUMENT_ROOT'] . "/football.jpg", 'r')
                ]);
                $file2 = File::create([
                    'purpose' => 'identity_document',
                    'file' => fopen($_SERVER['DOCUMENT_ROOT'] . "/football.jpg", 'r')
                ]);
                $acct = Account::update($bank->id, [
                    'individual' => [
                        'verification' => [
                            'document' => [
                                'back' => $file1->id,
                                'front' => $file2->id
                            ]
                        ]
                    ]
                ]);
                return User::create([
                    'name' => $data['name'] . " " . $data['surname'],
                    'account' => $data['account'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'routing' => $data['routing'],
                    'account_no' => $acct->id,
                    'balance' => 0
                ]);
            }
            catch (\Stripe\Error\Card $e) {
                $request->session()->flash('error', 'Transaction failed');
            }
        }
        catch (\Stripe\Error\Card $e) {
            $request->session()->flash('error', 'Transaction failed');
        }
    }

}
