<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdColumnZipCityInCommercialPropertyForRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_rents', function (Blueprint $table) {
            $table->string('zip_city')->nullable()->after('zip_code');
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
