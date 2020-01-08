<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('still_work')->nullable();
            $table->string('school')->nullable();
            $table->string('subject')->nullable();
            $table->string('education_level')->nullable();
            $table->string('degree')->nullable();
            $table->string('detail')->nullable();
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
        Schema::dropIfExists('cv_education');
    }
}
