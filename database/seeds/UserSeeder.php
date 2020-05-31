<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'demo',
            'email'             => 'demo@gmail.com',
            'username'          => 'demo',
            'password'          => Hash::make('demo'),
            'balance'           => 50000,
            'role'              => 'admin',
            'status'            => 'active'
        ]);
    }
}
