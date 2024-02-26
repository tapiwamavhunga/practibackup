<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable = [
        'original_url',
        'hash',
        'clicks',
        'open',
        'user_id',
        'doctor_name',
        'patient_email',
        'doctor_diagnosis',
        'doctor_name',
        'hids',
        'medium',
        'region',
        'sub_region',
    ];
}
