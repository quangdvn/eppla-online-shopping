<?php

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'user_id' => 2
        ]);
        
        Seller::create([
            'user_id' => 3
        ]);
        
        Seller::create([
            'user_id' => 4
        ]);
        
    }
}
