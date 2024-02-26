<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;
   protected $table = 'verify';
        public $fillable = [

        'user_id','name', 'email', 'practice_number'

    ];

}
