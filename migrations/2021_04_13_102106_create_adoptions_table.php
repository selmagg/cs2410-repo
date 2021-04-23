<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
          $table->bigIncrements('id');
          //user_id -> foreignkey
          $table->bigInteger('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');

          //$table->foreign('user_name')->references('name')->on('users');
          //animal_id -> foreignkey
          $table->bigInteger('animal_id')->unsigned();
          $table->foreign('animal_id')->references('id')->on('animals');
          //status
          $table->enum('status', ['waiting', 'approved', 'denied'])->default('waiting');
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
        Schema::dropIfExists('adoptions');
    }
}
