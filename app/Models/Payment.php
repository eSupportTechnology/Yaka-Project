<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default 'payments'
    protected $table = 'payment';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'ad_id',
        'invoiceNo',
        'payableAmount',
        'payableCurrency',
        'statusMessage',
        'paymentType',
        'paymentScheme',
        'cardHolderName',
        'cardNumber',
        'paymentId',
        'checkValue',
    ];

    // Optionally, you can specify the primary key if it's not 'id'
    protected $primaryKey = 'id';
}
