<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Macbook Pro',
            'slug' => 'macbook-pro',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 2',
            'slug' => 'laptop-2',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 3',
            'slug' => 'laptop-3',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 4',
            'slug' => 'laptop-4',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 5',
            'slug' => 'laptop-5',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 6',
            'slug' => 'laptop-6',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 7',
            'slug' => 'laptop-7',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 8',
            'slug' => 'laptop-8',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);

        Product::create([
            'name' => 'Laptop 9',
            'slug' => 'laptop-9',
            'details' => 'blabla',
            'price' => 2400,
            'description' => 'loremlrome'
        ]);
    }
}
