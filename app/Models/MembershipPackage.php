<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'expiry_date',
        'ads_per_month',
        'voucher_code',
        'price',
        'promotion_voucher_cost',
        'valid_month'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
