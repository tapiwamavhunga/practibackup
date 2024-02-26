<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SMS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('msidn')->nullable();
            $table->string('doctor_diagnosis')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('hids')->nullable();
            $table->string('medium')->nullable();
            $table->text('original_url');
            $table->string('hash')->unique();
            $table->integer('clicks')->default(0);
            $table->integer('open')->default(0);
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

                Schema::dropIfExists('sms');

    }
}
