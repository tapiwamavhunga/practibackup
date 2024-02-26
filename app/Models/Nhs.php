<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Nhs extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
        protected $table = 'nhs';

     protected $fillable = [
        'ID',
        'post_title',
        'excerpt',
        'description',
        'url',
        'image',
        'meta',
        'url',
        'password',
        'slug',
        'brochure_show_on_api'
        
        


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



