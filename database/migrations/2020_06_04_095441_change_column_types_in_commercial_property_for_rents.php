<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypesInCommercialPropertyForRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_rents', function (Blueprint $table) {
            $table->integer('gross_area_from')->charset(null)->collation(null)->change();
            $table->integer('gross_area_to')->charset(null)->collation(null)->change();
            $table->integer('use_area')->charset(null)->collation(null)->change();
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
