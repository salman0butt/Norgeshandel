<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('location_id');
            $table->string('post_category');
            $table->string('page_url')->nullable();
            $table->timestamp('time_start')->nullable();
            $table->timestamp('time_end')->nullable();
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
        Schema::dropIfExists('banner_groups');
    }
}
