<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Tabel products ini nanti akan kita pergunakan untuk menyimpan data menu yang dimiliki oleh restoran/café
    protected $fillable = ['category_id', 'name', 'slug', 'price'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
