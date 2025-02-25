<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PackageType extends Model
{
    protected $table='table_package_typess';
    protected $fillable = ['package_id', 'url', 'name', 'duration', 'price', 'status'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }
}
