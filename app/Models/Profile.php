<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Tabel profiles ini nanti akan kita pergunakan untuk menyimpan data profil dari restoran/café
    protected $fillable = ['id', 'name', 'slug', 'address', 'city', 'phone'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
