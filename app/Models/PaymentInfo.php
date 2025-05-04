<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $filable = [
        'check_value',
        'invoice_id',
        'payment_status',
    ];
}
