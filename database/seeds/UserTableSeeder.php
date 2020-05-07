<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('email', '=', 'developer@digitalmx.no')->first();
        if(!$user) {
            $user = new \App\User([
                'username' => 'Admin',
                'email' => 'developer@digitalmx.no',
                'password' => \Illuminate\Support\Facades\Hash::make('developer'),
                'email_verified_at' => now(),
                'status' => 'active'
            ]);
            $user->save();
        }
        $user2 = \App\User::where('email', '=', 'zaheer@digitalmx.no')->first();
        if(!$user2) {
            $user2 = new \App\User([
                'username' => 'Zaheer Iqbal',
                'email' => 'zaheer@digitalmx.no',
                'password' => \Illuminate\Support\Facades\Hash::make('gujrat786'),
                'email_verified_at' => now(),
                'status' => 'active'
            ]);
            $user2->save();
        }

        \Illuminate\Support\Facades\DB::table('roles')->truncate();
        $roles = array(
            ['name'=>'admin','display_name'=>'Administrator'],
            ['name'=>'manager','display_name'=>'Manager'],
            ['name'=>'vendor','display_name'=>'Vendor'],
            ['name'=>'company','display_name'=>'Company'],
            ['name'=>'subscriber','display_name'=>'Subscriber'],
            ['name'=>'agent','display_name'=>'Agent'],
        );
        foreach ($roles as $role){
            $obj = new \App\Role($role);
            $obj->save();
        }

        $user->detachRoles();
        $user->attachRole(1);
        $user2->detachRoles();
        $user2->attachRole(1);
    }
}
