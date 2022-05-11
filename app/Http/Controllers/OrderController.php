<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Profile;
use App\Models\Temporder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        $items  = new Orderdetail();
        // dd($items);
        return view('order.index', compact('orders', 'items'));
    }

    public function show(Order $order)
    {
        $profile = Profile::first();
        return view('order.show', compact('profile', 'order'));
    }

    // fungsi ini digunakan untuk memasukkan data ke dalam tabel orders dan orderdetails. Semua data yang ada di tabel temporders akan dipindahkan ke tabel orderdetails, jadi tabel temporders menjadi kosong dan bisa di isi untuk transaksi baru.
    public function process(Request $request)
    {
        $this->validate($request, [
            'customer'  => 'required'
        ], [
            'customer.required' => 'Nama Customer Belum Di Isi'
        ]);

        if ($request->pay < $request->total) {
            Alert::warning('Jumlah Pembayaran Kurang');
            return redirect()->back();
        }
        $lates = Order::orderBy('id', 'DESC')->first();
        if (!$lates) {
            $invoice = '0001';
        } else {
            //sprintf = menentukan format angka (decimal)
            $invoice = sprintf('%04d', $lates->invoice + 1);
        }

        $tem_order = Temporder::all();
        $order = Order::create([
            'invoice' => $invoice,
            'customer_name' => $request->customer,
            'total'   => $request->total,
            'pay'     => $request->pay,
            'user_id' => Auth::user()->id,
            'note'    => $request->note
        ]);
        foreach ($tem_order as $item) {
            Orderdetail::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product_id,
                'product_name'  => $item->product_name,
                'product_price' => $item->product_price,
                'qty'           => $item->qty,
                'subtotal'      => $item->subtotal
            ]);
        }
        // truncate =  Ngosongkan table (Menghapus semua record/baris yang ada didalam tabel tertentu)' (Termasuk kelompoknya DML)
        Temporder::query()->truncate();
        return redirect()->route('detailorder');
    }

    // Function ini kita gunakan untuk menampilkan detail order
    public function detailorder()
    {
        $lastOrder = Order::latest()->first();
        return view('order.detail', compact('lastOrder'));
    }

    // Fungsi ini akan digunakan untuk mencetak nota
    public function receipt(Order $order)
    {
        $profile = Profile::first();
        return view('order.receipt', compact('order', 'profile'));
    }
}
