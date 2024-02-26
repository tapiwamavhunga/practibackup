<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 60)->nullable();
            $table->string('description')->nullable();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->string('practice_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('logo')->nullable();

            $table->string('accessToken')->nullable();
            $table->string('email_message')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->string('image')->nullable();
            $table->string('image_signature')->nullable();
            $table->string('image_logo')->nullable();

            $table->string('company')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('region')->nullable();
             $table->string('sub_region')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
