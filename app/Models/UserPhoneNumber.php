<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoneNumber extends Model
{
    protected $fillable = ['user_id', 'phone_number', 'is_primary'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
