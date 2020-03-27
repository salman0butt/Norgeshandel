<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCommercialPropertyForSalesChangeDescripionAccessColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_property_for_sales', function (Blueprint $table) {
            $table->text('descripion_access')->change();
            $table->text('standard_technica_information')->change();
            $table->text('description_simple')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_property_for_sales', function (Blueprint $table) {
            //
        });
    }
}
