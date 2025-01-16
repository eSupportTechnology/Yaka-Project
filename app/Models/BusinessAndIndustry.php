<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAndIndustry extends Model
{
    use HasFactory;
    protected $table='business_and_industry';
    protected $fillable=['adsId','type','status'];
}
