<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // mktime(hour,minute,second,month,day,year) Fungsi mktime() sendiri mengembalikan nilai timestamp sesuai dengan parameter yang digunakan. Jadi manfaat dari penggunaan fungsi mktime() kita dapat membuat sebuah tanggal baru sesuai dengan keinginan kita.
        $startDate = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $endDate = date('Y-m-d');
        $income = new Order;
        return view('report.index', compact('startDate', 'endDate', 'income'));
    }


    public function changePeriode(Request $request)
    {
        $startDate = null;
        $endDate   = null;
        $income = new Order;

        if (!empty($request->daterange)) {
            // Fungsi substr() adalah fungsi PHP untuk memotong string, atau untuk mengambil sebagian nilai dari sebuah string. Fitur ini cukup sering digunakan dalam proses pembuatan program PHP, terutama yang membutuhkan manipulasi string.
            $startDate = substr($request->daterange, 0, 10);
            $endDate   = substr($request->daterange, 12);
        }
        return view('report.changePeriode', compact('startDate', 'endDate', 'income'));
    }
}
