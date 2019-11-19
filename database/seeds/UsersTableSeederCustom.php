<?php
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
        $role = Role::where('name', 'seller')->firstOrFail();
        
        User::create([
            'name'           => 'Seller 1',
            'email'          => 'seller1@admin.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id'        => $role->id,
        ]);

        User::create([
            'name'           => 'Seller 2',
            'email'          => 'seller2@admin.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id'        => $role->id,
        ]);

        User::create([
            'name'           => 'Seller 3',
            'email'          => 'seller3@admin.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id'        => $role->id,
        ]);
    }
}