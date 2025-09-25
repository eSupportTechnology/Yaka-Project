<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsLimitation extends Model
{
    use HasFactory;

    protected $table = 'ads_limitations';

    protected $fillable = [
        'name',
        'limit',
        'status'
    ];
}
