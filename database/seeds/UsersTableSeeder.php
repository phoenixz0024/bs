<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            

        ]);

        DB::table('users')->insert([
            'name' => 'rafael van den berg',
            'email' => 'rafaelberg@gmail.com',
            'password' => bcrypt('secret'),

        ]);


        DB::table('users_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
            

        ]);
       
        
    }
}
