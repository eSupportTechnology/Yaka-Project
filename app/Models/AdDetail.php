<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdDetail extends Model
{
    protected $fillable = [
        'adsId',
        'additional_info',
        'value',
    ];
}
