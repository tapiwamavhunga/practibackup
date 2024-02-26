<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Emails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('doctor_name')->nullable();
            $table->string('doctor_email')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('doctor_diagnosis')->nullable();
            $table->string('hids')->nullable();
            $table->string('sub_region')->nullable();
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
        //

                Schema::dropIfExists('emails');

    }
}
