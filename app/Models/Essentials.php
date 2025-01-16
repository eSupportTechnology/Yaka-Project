<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Essentials extends Model
{
    use HasFactory;
    protected $table='_essentials';
    protected $fillable=['adsId','type','condition'];
}
