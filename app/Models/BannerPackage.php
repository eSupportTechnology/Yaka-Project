<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banners;

class BannerPackage extends Model
{
    protected $fillable = [
        'name',
        'status',
        'no_of_days',
    ];

    public function banners()
{
    return $this->hasMany(Banners::class, 'package'); // 'package' is the foreign key in banners table
}
}
