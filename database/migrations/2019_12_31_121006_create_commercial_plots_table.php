<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_plots', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('plot_type')->nullable();
            $table->string('country')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('location_description')->nullable();
            $table->string('municipal_number')->nullable();
            $table->string('usage_number')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('owned_plot_facilities')->nullable();
            $table->string('asking_price')->nullable();
            
            $table->string('verditakst')->nullable();
            $table->string('display_information')->nullable();
            $table->string('headline')->nullable();
            $table->string('description')->nullable();
            
            $table->string('link')->nullable();
            $table->string('text_for_information')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('e_post')->nullable();
            $table->string('published_on')->nullable();
            $table->string('farm_number')->nullable();
            $table->integer('ad_id')->nullable();
            $table->integer('user_id')->nullable();

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
        Schema::dropIfExists('commercial_plots');
    }
}
