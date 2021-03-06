<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSecondaryColsToPropertyForSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_sales', function (Blueprint $table) {
            //
            $table->string('secondary_deliver_date')->nullable();
            $table->string('secondary_from_clock')->nullable();
            $table->string('secondary_clockwise')->nullable();
            $table->string('secondary_note1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_for_sales', function (Blueprint $table) {
            //
        });
    }
}
