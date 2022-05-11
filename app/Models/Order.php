<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //Tabel orders ini akan digunakan untuk menyimpan data pembelian customer.
    protected $fillable = ['id', 'user_id', 'invoice', 'customer_name', 'total', 'pay', 'note'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function orderDetail()
    {
        return $this->hasMany(Orderdetail::class);
    }
    public function income($date)
    {
        return $this->where('created_at', 'LIKE', "$date%")->sum('total');
    }
}
