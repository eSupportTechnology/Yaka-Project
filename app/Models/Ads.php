<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = [
        'title',
        'url',
        'adsId',
        'location',
        'sublocation',
        'bump_up_at',
        'description',
        'price',
        'mainImage',
        'subImage',
        'cat_id',
        'cat_name',
        'sub_cat_id',
        'sub_cat_name',
        'user_id',
        'ads_package',
        'package_type',
        'view_counr',
        'click_counr',
        'price_type',
        'post_type',
        'package_expire_at',
        'status',
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }


    public function ads_electronics() {
        return $this->hasMany(ElectronicDevices::class, 'adsId', 'adsId');
    }

    public function ads_vehicles() {
        return $this->hasMany(Vehicle::class, 'adsId', 'adsId');
    }

    public function ads_property() {
        return $this->hasMany(Property::class, 'adsId', 'adsId');
    }

    public function ads_animals() {
        return $this->hasMany(Animal::class, 'adsId', 'adsId');
    }

    public function ads_homegarden() {
        return $this->hasMany(HomeAndGarden::class, 'adsId', 'adsId');
    }

    public function ads_services() {
        return $this->hasMany(Services::class, 'adsId', 'adsId');
    }

    public function ads_otherads() {
        return $this->hasMany(Other::class, 'adsId', 'adsId');
    }

    public function ads_businessandindustry() {
        return $this->hasMany(BusinessAndIndustry::class, 'adsId', 'adsId');
    }
    public function ads_hobbysportsandkids() {
        return $this->hasMany(HobbySportsAndKids::class, 'adsId', 'adsId');
    }
    public function ads_fashionandbeauty() {
        return $this->hasMany(FashionAndBeauty::class, 'adsId', 'adsId');
    }
    public function ads_essentials() {
        return $this->hasMany(Essentials::class, 'adsId', 'adsId');
    }
    public function ads_education() {
        return $this->hasMany(Education::class, 'adsId', 'adsId');
    }
    public function ads_agriculture() {
        return $this->hasMany(Agriculture::class, 'adsId', 'adsId');
    }

    public function ads_jobs() {
        return $this->hasMany(Jobs::class, 'adsId', 'adsId');
    }


    // Relationship with Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Location
    public function main_location()
    {
        return $this->belongsTo(Districts::class, 'location');
    }

    // Relationship with Sublocation
    public function sub_location()
    {
        return $this->belongsTo(Cities::class, 'sublocation');
    }

    // Relationship with AdsPackage
    public function adsPackage()
    {
        return $this->belongsTo(AdsPackage::class, 'ads_package');
    }

    // Relationship with PackageType
    public function packageType()
    {
        return $this->belongsTo(PackageType::class, 'package_type');
    }

}
