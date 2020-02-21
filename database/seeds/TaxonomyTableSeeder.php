<?php

use Illuminate\Database\Seeder;

class TaxonomyTableSeeder extends Seeder
{
    private $taxes = [
        ['name'=>'industry','slug'=>'industry'],
        ['name'=>'Job Function','slug'=>'job_function'],
        ['name'=>'Sector','slug'=>'sector'],
        ['name'=>'Commitment type','slug'=>'commitment_type'],
        ['name'=>'Leadership category','slug'=>'leadership_category'],
        ['name'=>'Deadline','slug'=>'deadline'],
        ['name'=>'Country','slug'=>'country'],
        ['name'=>'Property type', 'slug'=>'pfs_property_type'],
        ['name'=>'Ownership Type', 'slug'=>'pfs_tenure'],
        ['name'=>'Commercial Property type', 'slug'=>'cpfs_property_type'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('taxonomies')->truncate();
        foreach($this->taxes as $tax){
            \App\Taxonomy::create($tax);
        }
    }
}
