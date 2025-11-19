<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'valid_month',
        'price',
        'ads_per_month',
        'promotion_voucher_cost',
        'start_date',
        'expiry_date',
        'voucher_code',
        'business_name',
        'business_email',
        'business_phone',
        'order_id',
        'payment_status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
        'price' => 'decimal:2',
        'promotion_voucher_cost' => 'decimal:2',
    ];

    /**
     * Get the user that owns the membership.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the membership is active.
     */
    public function isActive()
    {
        return $this->payment_status === 'paid'
            && Carbon::now()->between($this->start_date, $this->expiry_date);
    }

    /**
     * Check if the membership is expired.
     */
    public function isExpired()
    {
        return Carbon::now()->isAfter($this->expiry_date);
    }

    /**
     * Get days remaining in membership.
     */
    public function daysRemaining()
    {
        if ($this->isExpired()) {
            return 0;
        }
        return Carbon::now()->diffInDays($this->expiry_date);
    }

    /**
     * Scope to get active memberships.
     */
    public function scopeActive($query)
    {
        return $query->where('payment_status', 'paid')
            ->where('start_date', '<=', Carbon::now())
            ->where('expiry_date', '>=', Carbon::now());
    }

    /**
     * Scope to get expired memberships.
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', Carbon::now());
    }
}
