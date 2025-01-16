<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table='property';
    protected $fillable=[
        'adsId',
        'condition',
        'brand',
        'size_of_land',
        'size_sf',
        'unit',
        'address',
        'rooms',
        'bathrooms',
        'type',
    ];
}
