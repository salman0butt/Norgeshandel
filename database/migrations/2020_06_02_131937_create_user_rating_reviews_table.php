<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRatingReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rating_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('to_user_id');
            $table->integer('from_user_id');
            $table->integer('ad_id');
            $table->tinyInteger('communication_ratings');
            $table->tinyInteger('delivery_ratings');
            $table->tinyInteger('description_ratings');
            $table->tinyInteger('payment_ratings');
            $table->tinyInteger('general_ratings');
            $table->text('review');
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
        Schema::dropIfExists('user_rating_reviews');
    }
}
