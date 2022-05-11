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
            'category_id'   => '1',
            'name'          => 'Kemeja Lengan Panjang',
            'slug'          => 'kemeja-lengan-panjang',
            'price'         => '150000'
        ]);
        Product::create([
            'category_id'   => '1',
            'name'          => 'Kemeja Lengan Pendek',
            'slug'          => 'kemeja-lengan-pendek',
            'price'         => '170000'
        ]);
        Product::create([
            'category_id'   => '2',
            'name'          => 'Tas Slempang',
            'slug'          => 'tas-slempang',
            'price'         => '200000'
        ]);
        Product::create([
            'category_id'   => '2',
            'name'          => 'Tas Punggung',
            'slug'          => 'tas-punggung',
            'price'         => '250000'
        ]);
    }
}
