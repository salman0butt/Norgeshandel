<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeFlatWishesRenteds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flat_wishes_renteds', function (Blueprint $table) {
            $table->integer('max_rent_per_month')->charset(null)->collation(null)->change();
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
