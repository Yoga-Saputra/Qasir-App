<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Tabel categories ini nanti akan kita pergunakan untuk menyimpan data kategori menu dari restoran/café.
    protected $fillable = ['name', 'slug', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
