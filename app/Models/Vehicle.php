<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';

    protected $fillable = [
        'adsId',
        'condition',
        'brand',
        'model',
        'type',
        'manufacture_year',
        'engine_capacity',
        'gears_up',
        'fragment_type',
        'Mileage',
        'edition',
        'model_year',
        'fuel_Type',
        'transmission',
    ];
}
