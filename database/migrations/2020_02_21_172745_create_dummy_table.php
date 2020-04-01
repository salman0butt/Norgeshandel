<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedummyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dummy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('zip_code')->nullable();
            $table->string('zip_city')->nullable();
            $table->string('municipal_code')->nullable();
            $table->string('municipal_number')->nullable();
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
        Schema::dropIfExists('dummy');
    }
}
