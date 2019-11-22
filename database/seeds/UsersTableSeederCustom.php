<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $sellerRole = Role::where('name', 'seller')->firstOrFail();

        $userRole = Role::where('name', 'user')->firstOrFail();

        User::create([
            'name' => 'Seller 1',
            'email' => 'seller1@seller.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id' => $sellerRole->id,
        ]);

        User::create([
            'name' => 'Seller 2',
            'email' => 'seller2@seller.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id' => $sellerRole->id,
        ]);

        User::create([
            'name' => 'Seller 3',
            'email' => 'seller3@seller.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id' => $sellerRole->id,
        ]);

        $user = User::create([
            'name' => 'User 1',
            'email' => 'user1@user.com',
            'password' => bcrypt('z1x2c3v4'),
            'remember_token' => str_random(60),
            'role_id' => $userRole->id,
        ]);

        Customer::create([
            'user_id' => $user->id
        ]);
    }
}
