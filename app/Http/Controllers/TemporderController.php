<?php

namespace App\Http\Controllers;

use App\Models\Temporder;
use Illuminate\Http\Request;

class TemporderController extends Controller
{
    //Tabel temporders ini kita umpamakan sebagai keranjang belanja yang menjadi tempat untuk menyimpan sementara data menu yang dipilih oleh pembeli/customer
    public function addProduct(Request $request)
    {
        // fungsi ini digunakan untuk memasukkan data ke dalam tabel temporders
        Temporder::create([
            'product_id' => $request->id,
            'product_name' => $request->menu,
            'product_price' => $request->price,
            'qty'           => $request->qty,
            'subtotal'      => $request->price * $request->qty,
        ]);
        return redirect()->back();
    }
    // Function ini kita gunakan untuk menghapus data.
    public function destroy(Temporder $temporder)
    {
        $temporder->delete();
        return redirect()->back();
    }
}
