<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->integer('user_id')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_email')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('doctor_diagnosis')->nullable();
            $table->string('hids')->nullable();
            $table->boolean('open')->default(0);
            $table->boolean('click')->default(0);
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
        Schema::dropIfExists('mails');
    }
}
