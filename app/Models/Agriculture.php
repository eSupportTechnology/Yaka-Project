<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agriculture extends Model
{
    use HasFactory;
    protected $table='_agriculture';
    protected $fillable=['adsId','condition'];
}
