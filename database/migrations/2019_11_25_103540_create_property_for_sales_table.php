<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyForSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_for_sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('headline')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('access')->nullable();

            $table->string('location')->nullable();
            $table->string('local_area_name')->nullable();
            $table->string('property_type')->nullable();
            $table->string('tenure')->nullable();

            $table->string('municipality_number')->nullable();
            $table->string('farm_number')->nullable();
            $table->string('usage_number')->nullable();
            $table->string('party_number')->nullable();

            $table->string('section_number')->nullable();
            $table->string('apartment_number')->nullable();
            $table->integer('use_area')->nullable();
            $table->integer('primary_room')->nullable();

            $table->integer('Base')->nullable();
            $table->string('area_description')->nullable();
            $table->string('year')->nullable();
            $table->string('renovated_year')->nullable();

            $table->string('energy_grade')->nullable();
            $table->string('heating_character')->nullable();
            $table->integer('number_of_bedrooms')->nullable();

            $table->integer('number_of_rooms')->nullable();
            $table->string('floor')->nullable();

            $table->string('approved_rental_part')->nullable();
            $table->string('facilities')->nullable();
            $table->string('housing_team')->nullable();
            $table->string('owner_of_housing')->nullable();
            $table->string('housing_type_org_number')->nullable();

            $table->string('housing_cooperative_share_number')->nullable();
            $table->integer('land')->nullable();
            $table->string('holiday_year')->nullable();

            $table->integer('party_fee')->nullable();
            $table->string('facilities2')->nullable();
            $table->string('character')->nullable();
            $table->integer('rent_shared_cost')->nullable();
            $table->string('shared_costs_include')->nullable();

            $table->string('common_costs_after_interest_free_period')->nullable();
            $table->integer('asset_value')->nullable();
            $table->integer('asking_price')->nullable();
            $table->integer('expenses')->nullable();
            $table->string('costs_include')->nullable();

            $table->string('percentage_of_public_debt')->nullable();
            $table->string('value_rate')->nullable();
            $table->string('loan_rate')->nullable();
            $table->string('percentage_of_common_wealth')->nullable();
            $table->string('muncipal_fees_per_year')->nullable();
            

            $table->string('facilities3')->nullable();
            $table->string('joint_debt_costs')->nullable();
            $table->string('pre_empt_right')->nullable();
            $table->string('facilities4')->nullable();
            $table->string('description2')->nullable();

            $table->string('essential_information')->nullable();
            $table->string('video')->nullable();
            $table->date('deliver_date')->nullable();
            $table->string('from_clock')->nullable();
            $table->string('clockwise')->nullable();

            $table->string('note1')->nullable();
            $table->string('phone')->nullable();
            $table->string('published-on')->nullable();

            $table->string('user_id')->nullable();
            $table->string('ad_id')->nullable();



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
        Schema::dropIfExists('property_for_sales');
    }
}
