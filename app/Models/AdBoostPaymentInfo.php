<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdBoostPaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'check_value',
        'ads_id',
        'user_id',
    ];
}
