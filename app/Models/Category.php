<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'mainId',
        'name',
        'url',
        'description',
        'image',
        'status'
    ];

    public function ads()
    {
        return $this->hasMany(Ads::class, 'cat_id');
    }
    public function subcat()
    {
        return $this->hasMany(Category::class, 'mainId');
    }

    public function cat()
    {
        return $this->hasMany(Category::class, 'id' ,'mainId');
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }



    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'mainId');
    }

    public function brands()
    {
        return $this->hasMany(BrandsModels::class, 'sub_cat_id');
    }
    public function adtypes()
    {
        return $this->hasMany(AdsTypes::class, 'catergoryId');
    }


}
