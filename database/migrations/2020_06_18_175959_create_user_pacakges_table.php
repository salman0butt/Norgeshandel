<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPacakgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('package_id');
            $table->integer('total_ads');
            $table->integer('available_ads');
            $table->integer('total_price');
            $table->integer('ad_expiry');
            $table->string('ad_expiry_unit');
            $table->date('purchased_date');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('user_packages');
    }
}
