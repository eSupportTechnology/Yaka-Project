<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HobbySportsAndKids extends Model
{
    use HasFactory;
    protected $table='_hobby_sports_and_kids';
    protected $fillable=['adsId','type','condition','gender'];
}
