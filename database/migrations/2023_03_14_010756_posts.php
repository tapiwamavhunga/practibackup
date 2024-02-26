<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 60)->nullable();
            $table->string('content')->nullable();
            $table->boolean('show')->nullable();
            $table->string('link')->nullable();
            $table->boolean('featured_brochures')->nullable();
            $table->boolean('main_landing_brochures')->nullable();
            $table->boolean('current_campaign')->nullable();
            $table->string('image')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');

    }
}
