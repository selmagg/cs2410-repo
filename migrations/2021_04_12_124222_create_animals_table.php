<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
              $table->bigIncrements('id');
              $table->bigInteger('animal_id')->unassigned()->nullable();
              $table->bigInteger('user_id')->unsigned()->nullable();
              //foreignkey
              $table->foreign('user_id')->references('id')->on('users');
              $table->string('name', 30);
              $table->date('dob');
              $table->string('description', 256)->nullable();
              $table->string('image', 256)->nullable();
          $table->enum('availability', ['available', 'unavailable'])->default('available');
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
        Schema::dropIfExists('animals');
    }
}
