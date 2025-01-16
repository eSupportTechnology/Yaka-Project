<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
         'name',
        'last_name',
        'email',
        'password',
        'first_name',
        'last_name',
        'url',
        'phone_number',
        'roles',
        'google_id',
        'facebook_id',
        'location',
        'sub_location',
        'web_roles',
        'key',
        'status',
    ];

    public function ads()
    {
        return $this->hasMany(Ads::class);
    }

    public function main_location()
    {
        return $this->belongsTo(Districts::class, 'location');
    }

    // Relationship with Sublocation
    public function sublocation()
    {
        return $this->belongsTo(Cities::class, 'sub_location');
    }

    public function createUrl($valve)
    {
        $url = strtolower($valve);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        return $url;
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function IsAdmin()
    {
        return $this->roles == ADMIN ? true : false;
    }
}
