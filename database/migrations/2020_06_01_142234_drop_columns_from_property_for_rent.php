<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsFromPropertyForRent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_rent', function (Blueprint $table) {
            $table->dropColumn('delivery_date');
            $table->dropColumn('from_clock');
            $table->dropColumn('clockwise_clock');
            $table->dropColumn('note');

            $table->dropColumn('secondary_delivery_date');
            $table->dropColumn('secondary_from_clock');
            $table->dropColumn('secondary_clockwise_clock');
            $table->dropColumn('secondary_note');
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
            $table->date('delivery_date')->nullable();
            $table->string('from_clock')->nullable();
            $table->string('clockwise_clock')->nullable();
            $table->string('note')->nullable();

            $table->string('secondary_delivery_date')->nullable();
            $table->string('secondary_from_clock')->nullable();
            $table->string('secondary_clockwise_clock')->nullable();
            $table->string('secondary_note')->nullable();
        });
    }
}
