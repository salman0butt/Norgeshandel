<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChnageDateFormatForFlatWishesRented extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flat_wishes_renteds', function (Blueprint $table) {
            //
             $table->string('wanted_from')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flat_wishes_renteds', function (Blueprint $table) {
            //
        });
    }
}
