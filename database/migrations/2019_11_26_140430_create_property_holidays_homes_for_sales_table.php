<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyHolidaysHomesForSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_holidays_homes_for_sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('ad_headline')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('location')->nullable();

            $table->string('local_area_name')->nullable();
            $table->string('access_and_location')->nullable();
            $table->string('property_type')->nullable();
            $table->string('ownership_type')->nullable();

            $table->string('muncipal_number')->nullable();
            $table->string('farm_number')->nullable();
            $table->string('usage_number')->nullable();
            $table->string('section_number')->nullable();

            $table->string('party_number')->nullable();
            $table->string('use_area')->nullable();
            $table->string('primary_room')->nullable();
            $table->string('gross_area')->nullable();

            $table->string('base')->nullable();
            $table->string('housing_area')->nullable();
            $table->text('area_description')->nullable();
            $table->string('year_of_construction')->nullable();

            $table->string('renovated_year')->nullable();
            $table->string('energy_grade')->nullable();
            $table->string('heating_character')->nullable();
            $table->integer('number_of_bedrooms')->nullable();

            $table->integer('number_of_beds')->nullable();
            $table->integer('number_of_parking_spaces')->nullable();
            $table->string('standard')->nullable();
            $table->string('state_report_link')->nullable();

            $table->string('facilities')->nullable();
            $table->string('meter_above_sea_level')->nullable();
            $table->string('land')->nullable();
            $table->string('owned_site')->nullable();

            $table->string('party_fee')->nullable();
            $table->string('amenities')->nullable();
            $table->integer('number_of_tenants')->nullable();
            $table->text('character_description')->nullable();

            $table->string('common_costs')->nullable();
            $table->string('joint_board_after_interest_fee_period')->nullable();
            $table->string('shared_costs_include')->nullable();
            $table->string('asset_value')->nullable();

            $table->string('asking_price')->nullable();
            $table->string('cost')->nullable();
            $table->string('cost_includes')->nullable();
            $table->string('prcentage_of_joint_debt')->nullable();


            $table->string('total_price')->nullable();
            $table->string('value_rate')->nullable();
            $table->string('loan_rate')->nullable();
            $table->string('percentage_of_common_health')->nullable();

            $table->string('link_to_terif_documents')->nullable();
            $table->string('task_link')->nullable();
            $table->text('description')->nullable();
            $table->longText('essential_information')->nullable();
            $table->string('sales_quote')->nullable();

            $table->string('video')->nullable();

            $table->date('delivery_date')->nullable();
            $table->string('from_clock')->nullable();

            $table->string('clockwise')->nullable();
            $table->string('phone')->nullable();
            $table->string('published_on')->nullable();
            

          
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
        Schema::dropIfExists('property_holidays_homes_for_sales');
    }
}
