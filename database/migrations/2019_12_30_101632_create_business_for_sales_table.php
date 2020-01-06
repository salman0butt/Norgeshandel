<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessForSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_for_sales', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('industry')->nullable();
            $table->string('alternative_industry')->nullable();
            $table->string('country')->nullable();

            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('company_name')->nullable();

            
            $table->string('organiztion_number')->nullable();
            $table->string('price')->nullable();
            
            $table->string('headline')->nullable();
            $table->string('description')->nullable();

              
            $table->string('link')->nullable();
            $table->string('link_for_information')->nullable();

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
        Schema::dropIfExists('business_for_sales');
    }
}
