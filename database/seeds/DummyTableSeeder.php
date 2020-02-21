<?php

use Illuminate\Database\Seeder;

class DummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('dummy')->truncate();
        \Illuminate\Support\Facades\DB::table('dummy')->insert(['detail'=>'x']);
        \Illuminate\Support\Facades\DB::table('dummy')->insert(['detail'=>'y']);
    }
}
