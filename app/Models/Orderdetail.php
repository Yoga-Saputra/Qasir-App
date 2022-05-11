<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    //Tabel orderdetails ini digunakan untuk menyimpan detail dari pembelian yang dilakukan oleh customer
    protected $fillable = ['id', 'order_id', 'product_id', 'product_name', 'product_price', 'qty', 'subtotal'];

    public function item($order)
    {
        return $this->where('order_id', $order)->count();
    }
}
