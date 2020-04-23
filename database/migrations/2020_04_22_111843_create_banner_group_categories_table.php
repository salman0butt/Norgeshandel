<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerGroupCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_group_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('banner_group_id');
            $table->string('post_category');
            $table->foreign('banner_group_id')->references('id')->on('banner_groups')->onDelete('cascade');

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
        Schema::dropIfExists('banner_group__categories');
    }
}
