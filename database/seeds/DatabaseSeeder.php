<?php

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TaxonomyTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
    }
}
