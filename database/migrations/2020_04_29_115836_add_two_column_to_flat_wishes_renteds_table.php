<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumnToFlatWishesRentedsTable extends Migration
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
            $table->string('full_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
