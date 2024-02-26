<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up() {
   Schema::table('usersettings', function (Blueprint $table) {
            $table->longText('featured_brochures')->nullable();
            $table->longText('main_landing_brochures')->nullable();
            $table->longText('current_campaign')->nullable();
            $table->longText('brochures_allowed')->nullable();
   });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down() {
   Schema::table('usersettings', function (Blueprint $table) {
      $table->dropColumn('featured_brochures');
      $table->dropColumn('main_landing_brochures');
      $table->dropColumn('current_campaign');
      $table->dropColumn('brochures_allowed');

   });
}
}
