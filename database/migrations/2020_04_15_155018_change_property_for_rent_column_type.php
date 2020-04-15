<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePropertyForRentColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_rent', function (Blueprint $table) {
            //
            $table->string('rented_from')->change();
            $table->string('rented_to')->change();
            $table->string('delivery_date')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_for_rent', function (Blueprint $table) {
            //
        });
    }
}
