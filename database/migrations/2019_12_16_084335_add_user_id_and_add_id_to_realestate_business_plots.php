<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndAddIdToRealestateBusinessPlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('realestate_business_plots', function (Blueprint $table) {
            
            //
            $table->integer('ad_id')->nullable();
            $table->integer('user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('realestate_business_plots', function (Blueprint $table) {
            //
        });
    }
}
