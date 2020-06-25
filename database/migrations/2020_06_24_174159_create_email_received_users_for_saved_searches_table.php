<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailReceivedUsersForSavedSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_received_users_for_saved_searches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ad_id');
            $table->bigInteger('search_id');
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
        Schema::dropIfExists('email_received_users_for_saved_searches');
    }
}
