<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHolidayHomeForSaleDateColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_holidays_homes_for_sales', function (Blueprint $table) {
            //
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
        Schema::table('property_holidays_homes_for_sales', function (Blueprint $table) {
            //
        });
    }
}
