<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'province_id',
        'name_en',
        'name_si',
        'name_ta',
    ];
    
    /**
     * Get the cities for the district.
     */
    public function cities()
    {
        return $this->hasMany(Cities::class, 'district_id');
    }
}
