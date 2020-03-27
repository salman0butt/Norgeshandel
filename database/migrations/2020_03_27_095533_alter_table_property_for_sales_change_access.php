<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePropertyForSalesChangeAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_for_sales', function ($table) {
            $table->text('access')->change();
            $table->text('location')->change();
            $table->text('character')->change();
            $table->text('joint_debt_costs')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_for_sales', function ($table) {
        });
    }
}
