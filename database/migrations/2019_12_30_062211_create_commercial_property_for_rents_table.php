<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialPropertyForRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_property_for_rents', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('property_type')->nullable();
            $table->string('countrty')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();

            $table->string('venue_description')->nullable();
            $table->string('location_description')->nullable();
            $table->string('municipal_number')->nullable();
            $table->string('usage_number')->nullable();

            $table->string('farm_number')->nullable();
            $table->string('gross_area_from')->nullable();
            $table->string('gross_area_to')->nullable();

            $table->string('use_area')->nullable();
            $table->string('land')->nullable();
            $table->string('number_of_office_space')->nullable();
            $table->string('number_of_parking_space')->nullable();
            $table->integer('floors')->nullable();

            $table->string('year_of_construction')->nullable();
            $table->string('rennovated_year')->nullable();
            $table->string('energy_grade')->nullable();
            $table->string('heating_character')->nullable();

            $table->string('standard_technical_information')->nullable();
            $table->string('facilities')->nullable();
            $table->date('availiable_from')->nullable();
            $table->string('rent_per_meter_per_year')->nullable();
            $table->string('display_information')->nullable();

            $table->string('heading')->nullable();
            $table->string('last_description')->nullable();
            $table->string('link')->nullable();
            $table->string('link_for_information')->nullable();

            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();

            $table->string('published-on')->nullable();

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
        Schema::dropIfExists('commercial_property_for_rents');
    }
}
