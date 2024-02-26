<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Corcel\Model\Post as Corcel;

class Post extends Corcel
{
  protected $connection = 'wordpress';
  protected $postType = 'medicalbrochure';
    /**
     * Run the migrations.
     *
     * @return void
     */
   

    
}