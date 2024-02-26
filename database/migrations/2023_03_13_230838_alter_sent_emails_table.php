<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSentEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up() {
   Schema::table('sent_emails', function (Blueprint $table) {
            $table->string('user_id')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_email')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('doctor_diagnosis')->nullable();
            $table->string('hids')->nullable();
   });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down() {
   Schema::table('sent_emails', function (Blueprint $table) {
      $table->dropColumn('user_id');
      $table->dropColumn('doctor_name')->nullable();
      $table->dropColumn('doctor_email')->nullable();
      $table->dropColumn('patient_email')->nullable();
      $table->dropColumn('doctor_diagnosis')->nullable();
      $table->dropColumn('hids')->nullable();

   });
}
}
