<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandsModels extends Model
{
    use HasFactory;
    protected $table = 'brands_models';

    protected $fillable = [
        'brandsId',
        'name',
        'url',
        'sub_cat_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'sub_cat_id');
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }
}
