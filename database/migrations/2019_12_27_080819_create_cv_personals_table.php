<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_personals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('tell')->nullable();
            $table->string('mobile')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupational_status')->nullable();
            $table->string('website')->nullable();
            $table->string('driving_license')->nullable();
            $table->integer('user_id');
            $table->integer('cv_id');
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
        Schema::dropIfExists('cv_personals');
    }
}
