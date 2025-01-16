<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id',
        'name_en',
        'url',
        'name_si',
        'name_ta',
        'sub_name_en',
        'sub_name_si',
        'sub_name_ta',
        'postcode',
        'latitude',
        'longitude',
    ];

    /**
     * Get the district that owns the city.
     */
    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id');
    }

    /**
     * Get the ads for the city.
     */
    public function ads()
    {
        return $this->hasMany(Ads::class ,'sublocation');
    }
}
