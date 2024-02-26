<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up() {
   Schema::table('emails', function (Blueprint $table) {
            $table->string('message_id')->nullable();
            $table->string('read')->nullable();
            $table->string('opened')->nullable();
            $table->string('link')->nullable();
            $table->timestamp('opened_at')->nullable();



            
   });  
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
      public function down() {
   Schema::table('emails', function (Blueprint $table) {
      $table->dropColumn('user_id');
      $table->dropColumn('read');
      $table->dropColumn('opened');
      $table->dropColumn('link');
      $table->dropColumn('opened_at');
      
   });
}
}
