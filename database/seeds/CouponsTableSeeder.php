<?php

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 3000,
        ]);

        Coupon::create([
            'code' => 'DEF456',
            'type' => 'fixed',
            'value' => 2000,
        ]);

        Coupon::create([
            'code' => 'GHI789',
            'type' => 'percent',
            'percentOff' => 50,
        ]);
    }
}
