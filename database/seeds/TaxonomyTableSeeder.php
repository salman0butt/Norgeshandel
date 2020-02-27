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
        ['name'=>'For Sale Property type', 'slug'=>'pfs_property_type'],
        ['name'=>'Ownership Type', 'slug'=>'pfs_tenure'],
        ['name'=>'Commercial Property type', 'slug'=>'cpfs_property_type'],
        ['name'=>'For Rent Property type', 'slug'=>'pfr_property_type'],
        ['name'=>'For Rent Facilities', 'slug'=>'pfr_facilities'],
        ['name'=>'Holiday Home Facilities', 'slug'=>'hhfs_facilities'],
        ['name'=>'Holiday Home Property Type', 'slug'=>'hhfs_property_type'],
        ['name'=>'Holiday Home Tenure', 'slug'=>'hhfs_tenure'],
        ['name'=>'Property for sale facilities', 'slug'=>'pfs_facilities'],
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
