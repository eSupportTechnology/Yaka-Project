<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $table='jobs';
    protected $fillable=[
        'adsId',
        'job_type',
        'role',
        'education',
        'application_deadline',
        'experience',
        'salary_per_month',
        'cv_sent_email',
        'condition'
    ];
}
