<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $taxes = [['name'=>'industry','slug'=>'industry'],['name'=>'Job Function','slug'=>'job-function'],['name'=>'Sector','slug'=>'sector'],['name'=>'Commitment type','slug'=>'commitment-type'],['name'=>'Leadership category','slug'=>'leadership-category'],];
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('detail')->nullable();
            $table->timestamps();
        });
        foreach($this->taxes as $tax){
            \App\Taxonomy::create($tax);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
