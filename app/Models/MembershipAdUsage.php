<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipAdUsage extends Model
{
    protected $fillable = [
        'membership_package_id',
        'user_id',
        'year',
        'month',
        'ads_used',
    ];

    // Relationships
    public function membershipPackage()
    {
        return $this->belongsTo(MembershipPackage::class, 'membership_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
