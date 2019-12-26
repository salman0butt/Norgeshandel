<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionAndPropertyTypeToFlatWishesRenteds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flat_wishes_renteds', function (Blueprint $table) {
            //
            $table->string('region')->nullable();
            $table->string('property_type')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flat_wishes_renteds', function (Blueprint $table) {
            //
        });
    }
}
