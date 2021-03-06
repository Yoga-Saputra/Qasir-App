<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  => 'Pakaian',
            'slug'  => 'pakaian',
            'description' => 'Kategori pakaian'
        ]);
        Category::create([
            'name'  => 'Tas',
            'slug'  => 'tas',
            'description' => 'Kategori tas'
        ]);
    }
}
