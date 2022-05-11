<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporder extends Model
{
    //Tabel temporders ini kita umpamakan sebagai keranjang belanja yang menjadi tempat untuk menyimpan sementara data menu yang dipilih oleh pembeli/customer
    protected $fillable = ['id', 'product_id', 'product_name', 'product_price', 'qty', 'subtotal'];
}
