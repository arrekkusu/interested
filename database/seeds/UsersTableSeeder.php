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
        DB::table('users')->insert([
            'username' => 'Arrekkusualex',
            'name' => 'Alex Hutchings',
            'email' => 'arrekkusualex2@gmail.com',
            'password' => bcrypt('test1234'),
        ]);
    }
}
