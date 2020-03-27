<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCommercialPlotsChangeLocationDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_plots', function (Blueprint $table) {
            $table->text('location_description')->change();
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_plots', function (Blueprint $table) {
            //
        });
    }
}
