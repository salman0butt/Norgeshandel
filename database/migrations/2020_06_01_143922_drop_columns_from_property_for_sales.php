<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsFromPropertyForSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_sales', function (Blueprint $table) {
            $table->dropColumn('deliver_date');
            $table->dropColumn('from_clock');
            $table->dropColumn('clockwise');
            $table->dropColumn('note1');

            $table->dropColumn('secondary_deliver_date');
            $table->dropColumn('secondary_from_clock');
            $table->dropColumn('secondary_clockwise');
            $table->dropColumn('secondary_note1');
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
            $table->string('deliver_date')->nullable();
            $table->string('from_clock')->nullable();
            $table->string('clockwise')->nullable();
            $table->string('note1')->nullable();

            $table->string('secondary_deliver_date')->nullable();
            $table->string('secondary_from_clock')->nullable();
            $table->string('secondary_clockwise')->nullable();
            $table->string('secondary_note1')->nullable();
        });
    }
}
