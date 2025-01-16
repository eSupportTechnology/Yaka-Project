<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workoverseas extends Model
{
    use HasFactory;
    protected $table = 'workoverseas';
    protected $fillable = [
        'adsId',
        'industry',
        'type',
        'apply_via',
        'company_web',
        'application_deadline',
        'study_area',
        'university',
        'study_destination',

    ];
}
