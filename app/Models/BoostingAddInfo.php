<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoostingAddInfo extends Model
{
    protected $fillable = [
    'ad_id',
    'ad_title',
    'ad_description',
    'ad_price',
    'current_package_id',
    'current_package_name',
    'current_package_type_id',
    'current_package_duration',
    'current_package_expiry',
    'new_package_id',
    'new_package_name',
    'new_package_type_id',
    'new_package_duration',
    'amount',
    'payment_status',
    'invoice_id' 
];
}
