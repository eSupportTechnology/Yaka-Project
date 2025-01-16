<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $fillable = [
        'province_id',
        'url',
        'name_en',
        'name_si',
        'name_ta',
    ];

    // Relationship with Province
    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }
    public function cities()
    {
        return $this->hasMany(Cities::class);
    }
    public function ads()
    {
        return $this->hasMany(Ads::class);
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }
}
