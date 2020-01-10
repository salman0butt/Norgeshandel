<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_preferences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prospective')->nullable();
            $table->string('job_type')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('disclaimer')->nullable();
            $table->string('willingness')->nullable();
            $table->string('travel_days')->nullable();
            $table->string('salary')->nullable();
            $table->string('termination_notice')->nullable();
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
        Schema::dropIfExists('cv_preferences');
    }
}
