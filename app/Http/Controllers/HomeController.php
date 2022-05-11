<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Temporder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Charts\Daily;
use App\Charts\Monthly;
use Jenssegers\Date\Date;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // pada function index ini kita gunakan if sebab function ini nanti juga akan kita gunakan untuk hak akses owner. Fungsi ini akan menampilkan view dashboard. Data dari table temporders juga akan di passing ke view dashboard.
        $temp_orders = Temporder::all();

        $categories = Category::all();
        $today = date('Y-m-d');
        // strtotime() adalah Fungsi untuk mengubah string dari tanggal atau waktu ke dalam standar timestamp Unix. Dan Nilai keluarannya adalah jumlah detik yang dhitung sejak 1 Januari 1970
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $income_today = Order::where('created_at', 'LIKE', "$today%")->sum('total');
        $income_yesterday = Order::where('created_at', 'LIKE', "$yesterday%")->sum('total');
        $product = Product::count();
        // dd($product);

        //create date
        $startDate = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));

        $date = array();
        // dd($date);
        $income = array();

        for ($i = $startDate; $i <= $today; $i++) {
            $date[] = substr($i, 8);
            $paid = Order::where('created_at', 'LIKE', "$i%")->sum('total');
            $income[] = $paid;
        }

        //create chart harian
        $chart_daily = new Daily;
        $chart_daily->labels($date);
        $chart_daily->dataset('Grafik Penjualan Bulan Ini', 'line', $income);
        // dd($chart_daily);

        // create month
        $month = array();
        $income_monthly = array();
        for ($i = 1; $i <= 12; $i++) {
            // // mktime(hour,minute,second,month,day,year) Fungsi mktime() sendiri mengembalikan nilai timestamp sesuai dengan parameter yang digunakan. Jadi manfaat dari penggunaan fungsi mktime() kita dapat membuat sebuah tanggal baru sesuai dengan keinginan kita.
            $month[] = Date::parse(mktime(0, 0, 0, $i, 1, date('Y')))->format('F'); //F = bulan
            $paid_monthly = Order::select('created_at')
                ->whereBetween('created_at', array(date('Y-m-d', mktime(0, 0, 0, $i, 1, date('Y'))), date('Y-m-d', mktime(0, 0, 0, $i, 32, date('Y')))))
                ->sum('total');
            $income_monthly[] = $paid_monthly;
        }

        //create chart monthly
        $chart_monthly = new Monthly;
        $chart_monthly->labels($month);
        $chart_monthly->dataset('Grafik Penjualan Per Bulan', 'line', $income_monthly);
        // dd($chart_monthly);

        if (Auth::user()->hasRole('kasir')) {
            return view('dashboard', compact('temp_orders'));
        }

        if (Auth::user()->hasRole('owner')) {
            return view('dashboard', compact('categories', 'income_today', 'income_yesterday', 'product', 'chart_daily', 'chart_monthly', 'income_monthly'));
        }
    }

    // Function ini kita gunakan untuk pencarian data product, apabila data ditemukan maka akan dikirimkan dalam bentuk json.
    public function search(Request $request)
    {
        $search = $request->term;
        $data = Product::where('name', 'LIKE', '%' . $search . '%')->take(10)->get();
        $result = array();
        foreach ($data as $key => $value) {
            $result[] = ['price' => $value->price, 'id' => $value->id, 'value' => $value->name];
        }
        return response()->json($result);
    }
}
