<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FashionAndBeauty extends Model
{
    use HasFactory;
    protected $table='fashion_and_beauty';
    protected $fillable=['adsId','type','condition','gender'];
}
