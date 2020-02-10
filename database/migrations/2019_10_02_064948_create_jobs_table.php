<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('job_type')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->integer('positions')->nullable();
            $table->string('commitment_type')->nullable();
            $table->string('sector')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description', 2500)->nullable();
            $table->date('deadline')->nullable();
            $table->date('accession')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('emp_company_information', 2500)->nullable();
            $table->string('emp_website')->nullable();
            $table->string('emp_facebook')->nullable();
            $table->string('emp_linkedin')->nullable();
            $table->string('emp_twitter')->nullable();
            $table->string('country')->nullable();
            $table->integer('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('workplace_video')->nullable();
            $table->string('app_receive_by')->nullable();
            $table->string('app_link_to_receive')->nullable();
            $table->string('app_email_to_receive')->nullable();
            $table->string('app_contact')->nullable();
            $table->string('app_contact_title')->nullable();
            $table->string('app_mobile')->nullable();
            $table->string('app_phone')->nullable();
            $table->string('app_email')->nullable();
            $table->string('app_linkedin')->nullable();
            $table->string('app_twitter')->nullable();
            $table->integer('ad_id')->unsigned();
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
        Schema::dropIfExists('jobs');
    }
}
