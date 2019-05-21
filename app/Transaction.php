<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'user_id', 'amount', 'stripe_transaction', 'account'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
