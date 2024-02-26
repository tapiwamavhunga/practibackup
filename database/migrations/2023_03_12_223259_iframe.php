<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Iframe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('iframe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename')->nullable();
            $table->string('redirect_url')->nullable();
            $table->longText('featured_brochures')->nullable();
            $table->longText('main_landing_brochures')->nullable();
            $table->longText('current_campaign')->nullable();
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
        Schema::dropIfExists('iframe');
    }
}
