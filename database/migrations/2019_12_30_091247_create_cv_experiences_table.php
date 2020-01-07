<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('still_work')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->string('industry')->nullable();
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
        Schema::dropIfExists('cv_experiences');
    }
}
