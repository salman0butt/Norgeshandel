<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatWishesRentedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_wishes_renteds', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->integer('number_of_tenants')->nullable();
            $table->string('furnishing')->nullable();
            $table->date('wanted_from')->nullable();
            $table->string('max_rent_per_month')->nullable();
            $table->string('headline')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->integer('ad_id')->nullable();
            $table->integer('user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_wishes_renteds');
    }
}
