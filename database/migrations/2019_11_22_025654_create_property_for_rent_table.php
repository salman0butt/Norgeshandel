<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyForRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_for_rent', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('heading')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('property_type')->nullable();

            $table->string('primary_rom')->nullable();
            $table->string('gross_area')->nullable();
            $table->string('area_of_use')->nullable();
            $table->string('number_of_bedrooms')->nullable();

            $table->string('floor')->nullable();
            $table->string('furnishing')->nullable();
            $table->string('facilities')->nullable();
            $table->string('energy_label_class')->nullable();

            $table->string('energy_label_color')->nullable();
            $table->string('facilities2')->nullable();
            $table->string('monthly_rent')->nullable();
            $table->string('deposit')->nullable();

            $table->string('include_in_rent')->nullable();
            $table->date('rented_from')->nullable();
            $table->date('rented_to')->nullable();
            $table->string('description')->nullable();

            $table->date('delivery_date')->nullable();
            $table->string('from_clock')->nullable();
            $table->string('clockwise_clock')->nullable();

            $table->string('note')->nullable();
            $table->integer('published_on')->nullable();

            $table->string('secondary_delivery_date')->nullable();
            $table->string('secondary_from_clock')->nullable();
            $table->string('secondary_clockwise_clock')->nullable();
            $table->string('secondary_note')->nullable();

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
        Schema::dropIfExists('property_for_rent');
    }
}
