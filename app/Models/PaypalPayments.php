<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaypalPayments extends Model
{
    protected $table = 'paypal_payments';

    protected $fillable = [
        'payment_id',
        'payer_id',
        'token',
        'state'
    ];
}
