<?php

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleType::create([
            'name'  => 'TRIAXLE'
        ]);
        VehicleType::create([
            'name'  => 'REARAXLE'
        ]);
        VehicleType::create([
            'name'  => 'FRONTAXLE'
        ]);
    }
}
