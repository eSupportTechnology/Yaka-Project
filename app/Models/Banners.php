<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BannerPackage;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = ['img', 'type', 'url', 'package', 'expired_at'];

    public function bannerPackage()
    {
        return $this->belongsTo(BannerPackage::class, 'package'); // 'package' is the foreign key
    }
}
