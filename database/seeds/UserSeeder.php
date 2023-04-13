<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'Administrator',
            'level' => 1,
            'email' =>  'admin@unidel.com',
            'password'  =>  Hash::make('123456789'),
            'remember_token'    =>  str_random(10)
        ]);
        User::create([
            'name'  => 'Lindie',
            'level' => 2,
            'email' =>  'lindie@unidel.com',
            'password'  =>  Hash::make('123456789'),
            'remember_token'    =>  str_random(10)
        ]);
    }
}
