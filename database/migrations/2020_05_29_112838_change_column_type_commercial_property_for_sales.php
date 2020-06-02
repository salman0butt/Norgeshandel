<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeCommercialPropertyForSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_sales', function (Blueprint $table) {
            $table->integer('primary_room')->charset(null)->collation(null)->change();
            $table->integer('value_rate')->charset(null)->collation(null)->change();
            $table->integer('rental_income')->charset(null)->collation(null)->change();
            $table->integer('loan_rate')->charset(null)->collation(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_property_for_sales', function (Blueprint $table) {
            //
        });
    }
}
