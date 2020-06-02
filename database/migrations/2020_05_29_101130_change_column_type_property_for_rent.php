<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypePropertyForRent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_rent', function (Blueprint $table) {
            $table->integer('monthly_rent')->charset(null)->collation(null)->change();
            $table->integer('deposit')->charset(null)->collation(null)->change();
            $table->integer('primary_rom')->charset(null)->collation(null)->change();
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
