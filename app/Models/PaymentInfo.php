<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $fillable = [
        'check_value',
        'invoice_id',
        'payment_status',
        'ad_data',
        'user_id',
        'payment_for',
        'status',
        'payable_transaction_id',
        'payable_order_id'
    ];
    protected $casts = [
        'ad_data' => 'array',
    ];
}
