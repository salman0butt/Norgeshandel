<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeCommercialPlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_plots', function (Blueprint $table) {
            $table->integer('plot_size')->charset(null)->collation(null)->change();
            $table->integer('asking_price')->charset(null)->collation(null)->change();
            $table->integer('verditakst')->charset(null)->collation(null)->change();
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
