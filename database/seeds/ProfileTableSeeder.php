<?php

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'name'  => 'Brams Store',
            'slug'  => 'brams store',
            'address' => 'Jl. Ngawen - Blora',
            'city'    => 'Ngawen',
            'phone'   => '081222333'
        ]);
    }
}
