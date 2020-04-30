<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumnToCommercialPropertyForRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_rents', function (Blueprint $table) {
            //
            $table->string('full_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
