<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypePropertyHolidaysHomesForSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_holidays_homes_for_sales', function (Blueprint $table) {
            $table->integer('common_costs')->charset(null)->collation(null)->change();
            $table->integer('joint_board_after_interest_fee_period')->charset(null)->collation(null)->change();
            $table->integer('asset_value')->charset(null)->collation(null)->change();
            $table->integer('asking_price')->charset(null)->collation(null)->change();
            $table->integer('cost')->charset(null)->collation(null)->change();
            $table->integer('prcentage_of_joint_debt')->charset(null)->collation(null)->change();
            $table->integer('value_rate')->charset(null)->collation(null)->change();
            $table->integer('loan_rate')->charset(null)->collation(null)->change();
            $table->integer('percentage_of_common_health')->charset(null)->collation(null)->change();
            $table->integer('primary_room')->charset(null)->collation(null)->change();
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
