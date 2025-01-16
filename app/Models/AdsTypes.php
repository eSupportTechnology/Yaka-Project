<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsTypes extends Model
{
    use HasFactory;
    protected $table='table_ad_types';
    protected $fillable=['name','url','status','catergoryId'];
    public function category()
    {
        return $this->belongsTo(Category::class,'catergoryId');
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }
}
