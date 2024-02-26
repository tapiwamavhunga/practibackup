<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SMS extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
        protected $table = 'sms';

     protected $fillable = [
        'user_id',
        'msidn',
        'doctor_diagnosis',
        'doctor_name',
        'hids',
        'original_url',
        'hash',
        'clicks',
        'open',
        'medium',
        'region',
        'sub_region',
        


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }


}



