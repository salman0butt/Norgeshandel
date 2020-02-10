<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('gender')->nullable();
            $table->integer('zip')->nullable();
            $table->string('country')->nullable();
            $table->date('birthday')->nullable();
            $table->string('status')->default('pending');
            $table->string('image_path')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new \App\User(['first_name'=>'Digital', 'last_name'=>'Mediexpert', 'username'=>'digitalmx', 'email'=>'zaheer@digitalmx.no', 'password'=>\Illuminate\Support\Facades\Hash::make('gujrat786'), 'status'=>'active']);
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
