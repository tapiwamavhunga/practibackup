<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('nhs', function (Blueprint $table) {
            $table->id();
            
            $table->integer('ID')->nullable();
            $table->string('post_title')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('nhs');
    }
}
