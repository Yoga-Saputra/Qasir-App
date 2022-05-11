<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = User::create([
            'name'  => 'yoga',
            'email' =>  'yoga@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        $owner->assignRole('owner');

        $kasir = User::create([
            'name'  => 'kasir',
            'email' =>  'kasir@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        $kasir->assignRole('kasir');
    }
}
