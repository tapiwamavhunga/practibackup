<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
     protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'is_admin',
        'is_verified',
        'practice_number',
        'phone_number',
        'whatsapp_number',
        'email_message',
        'company',
        'type',
        'image',
        'image_signature',
        'image_logo',
        'region',
        'sub_region',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

      public function UserSettings()
    {
        return $this->hasOne('App\Models\UserSettings');
    }


    
    public function getJWTCustomClaims()
    {
        return [];
    }


}



