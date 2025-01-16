<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAndGarden extends Model
{
    use HasFactory;
    protected $table='homeandgarden';
    protected $fillable=['adsId','type','condition','brand'];
}
