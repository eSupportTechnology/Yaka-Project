<?php

namespace App\Models;

use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    protected $primaryKey = 'adsId';
    public $incrementing = false;

    protected $fillable = [
        'adsId',
        'invoice_id',
        'user_id',
        'created_by_staff_id',
        'title',
        'url',
        'location',
        'sublocation',
        'description',
        'price',
        'mainImage',
        'subImage',
        'cat_id',
        'sub_cat_id',
        'ads_package',
        'package_type',
        'view_count',
        'brand',
        'model',
        'price_type',
        'post_type',
        'package_expire_at',
        'bump_up_at',
        'condition',
        'status',
        'rotation_position',
        'last_rotated_at',
        'experience_years',         // <-- Add this
        'education',                // <-- Add this
        'application_deadline',     // <-- Add this
        'mobile_number',
    ];

    protected $casts = [
        'subImage' => 'array',
        'application_deadline' => 'date'
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
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

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }


    public function adDetail()
    {
        return $this->hasMany(AdDetail::class, 'adsId', 'adsId');
    }


    public function brand()
    {
        return $this->belongsTo(BrandsModels::class, 'brand', 'id');
    }

    public function model()
    {
        return $this->belongsTo(BrandsModels::class, 'model', 'id');
    }



    // Accessor for subImage to get it as an array
    public function getSubImageAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator for subImage to store it as a JSON string
    public function setSubImageAttribute($value)
    {
        $this->attributes['subImage'] = json_encode($value);
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






    // Relationship with AdsPackage
    public function adsPackage()
    {
        return $this->belongsTo(Package::class, 'ads_package');
    }

    // Relationship with PackageType
    public function packageType()
    {
        return $this->belongsTo(PackageType::class, 'package_type');
    }

}
