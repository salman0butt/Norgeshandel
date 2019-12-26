<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealestateBusinessPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realestate_business_plots', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('type_plot')->nullable();
            $table->string('location')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();

            $table->string('location_description')->nullable();
            $table->string('muncipal_number')->nullable();
            $table->string('usage_number')->nullable();
            $table->string('farm_number')->nullable();

            $table->string('plot_size')->nullable();
            $table->string('facilities')->nullable();
            $table->string('asking_price')->nullable();
            $table->string('valuation1')->nullable();

            $table->string('valuation2')->nullable();
            $table->string('display_information')->nullable();
            $table->string('head_line')->nullable();
            $table->string('description')->nullable();

            $table->string('text_on_link')->nullable();
            $table->string('link_for_information')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();

            $table->string('email')->nullable();
            $table->string('published-on')->nullable();

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
        Schema::dropIfExists('realestate_business_plots');
    }
}
