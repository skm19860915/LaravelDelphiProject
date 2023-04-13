<?php

use Illuminate\Database\Seeder;
use App\Models\Authority;

class AuthoritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Authority::create([
            'name'  => 'Administrator'
        ]);
        Authority::create([
            'name'  => 'Manager'
        ]);
        Authority::create([
            'name'  => 'Customer'
        ]);
    }
}
