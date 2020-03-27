<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCommercialPropertyForRentsChangeVenueDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_rents', function (Blueprint $table) {
            $table->text('venue_description')->change();
            $table->text('location_description')->change();
            $table->text('standard_technical_information')->change();
            $table->text('last_description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_property_for_rents', function (Blueprint $table) {
            //
        });
    }
}
