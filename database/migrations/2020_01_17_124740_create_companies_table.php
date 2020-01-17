<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_name')->nullable();
            $table->string('emp_company_information')->nullable();
            $table->string('emp_website')->nullable();
            $table->string('emp_facebook')->nullable();
            $table->string('emp_linkedin')->nullable();
            $table->string('emp_twitter')->nullable();
            $table->string('country')->nullable();
            $table->integer('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('workplace_video')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('companies');
    }
}
