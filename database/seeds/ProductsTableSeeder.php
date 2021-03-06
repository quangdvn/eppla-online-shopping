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
        //* Laptops
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Laptop ' . $i,
                'slug' => 'laptop-' . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
                'price' => rand(149999, 249999),
                'image' => 'products\November2019\laptop-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/laptop-2.jpg","products\/November2019\/laptop-3.jpg","products\/November2019\/laptop-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(1);
        }

        //* Add a random product to 2 categories for Testing
        $product = Product::findOrFail(1);
        $product->categories()->attach(2);

        //* Desktops
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Desktop ' . $i,
                'slug' => 'desktop-' . $i,
                'details' => [24, 25, 27][array_rand([24, 25, 27])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
                'price' => rand(249999, 449999),
                'image' => 'products\November2019\desktop-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/desktop-2.jpg","products\/November2019\/desktop-3.jpg","products\/November2019\/desktop-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(2);
        }

        //* Phones
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Phone ' . $i,
                'slug' => 'phone-' . $i,
                'details' => [16, 32, 64][array_rand([16, 32, 64])] . 'GB, 5.' . [7, 8, 9][array_rand([7, 8, 9])] . ' inch screen, 4GHz Quad Core',
                'price' => rand(79999, 149999),
                'image' => 'products\November2019\phone-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/phone-2.jpg","products\/November2019\/phone-3.jpg","products\/November2019\/phone-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(3);
        }

        //* Tablets
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Tablet ' . $i,
                'slug' => 'tablet-' . $i,
                'details' => [16, 32, 64][array_rand([16, 32, 64])] . 'GB, 5.' . [10, 11, 12][array_rand([10, 11, 12])] . ' inch screen, 4GHz Quad Core',
                'price' => rand(49999, 149999),
                'image' => 'products\November2019\tablet-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/tablet-2.jpg","products\/November2019\/tablet-3.jpg","products\/November2019\/tablet-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(4);
        }

        //* TVs
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'TV ' . $i,
                'slug' => 'tv-' . $i,
                'details' => [46, 50, 60][array_rand([7, 8, 9])] . ' inch screen, Smart TV, 4K',
                'price' => rand(79999, 149999),
                'image' => 'products\November2019\tv-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/tv-2.jpg","products\/November2019\/tv-3.jpg","products\/November2019\/tv-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(5);
        }

        //* Cameras
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Camera ' . $i,
                'slug' => 'camera-' . $i,
                'details' => 'Full Frame DSLR, with 18-55mm kit lens.',
                'price' => rand(79999, 249999),
                'image' => 'products\November2019\camera-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/camera-2.jpg","products\/November2019\/camera-3.jpg","products\/November2019\/camera-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(6);
        }

        //* Appliances
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'seller_id' => rand(1, 3),
                'name' => 'Appliance ' . $i,
                'slug' => 'appliance-' . $i,
                'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, dolorum!',
                'price' => rand(79999, 149999),
                'image' => 'products\November2019\appliance-' . $i . '.jpg',
                'extra_images' => '["products\/November2019\/appliance-2.jpg","products\/November2019\/appliance-3.jpg","products\/November2019\/appliance-4.jpg"]',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->attach(7);
        }

        //* Select random products to set as featured
        Product::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53, 61, 69, 73, 80, 46, 76])
                ->update(['featured' => true]);
    }
}
