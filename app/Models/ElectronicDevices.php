<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicDevices extends Model
{
    use HasFactory;

    protected $table = 'electronic_devices';

    protected $fillable = [
        'adsId',
        'condition',
        'brand',
        'model',
        'specialization',
        'type',
        'screen_size',
        'capacity',
    ];

}
