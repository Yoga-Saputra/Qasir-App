<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('template.default');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => 'role:kasir', 'auth'], function () {
    Route::get('search', 'HomeController@search')->name('search');
    // route ini digunakan untuk memasukkan data ke dalam tabel temporders
    Route::post('add-product', 'TemporderController@addProduct')->name('addProduct');
    // route ini digunakan untuk menghapus data yang dipilih pada tabel temporders.
    Route::delete('temporder/{temporder}/delete', 'TempOrderController@destroy')->name('temp_order.destroy');
    // route ini digunakan untuk memasukkan data ke dalam tabel orders sekaligus orderdetails.
    Route::post('process', 'OrderController@process')->name('process');
    // route ini digunakan untuk menampilkan detail order
    Route::get('detailOrder', 'OrderController@detailOrder')->name('detailorder');
    // route ini digunakan untuk melakukan cetak nota.
    Route::get('order/{order}/receipt', 'OrderController@receipt')->name('receipt');
});

Route::group(['middleware' => 'role:owner', 'auth'], function () {
    // Route Category
    Route::resource('category', 'CategoryController');

    // Route Product
    Route::get('product/category', 'ProductController@category')->name('product.category');
    Route::get('product/{category}/index', 'ProductController@index')->name('product.index');
    Route::get('product/{category}/index/create', 'ProductController@create')->name('product.create');
    Route::post('product/{category}/index/create', 'ProductController@store')->name('product.store');
    Route::get('product/{category}/index/product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('product/{category}/index/product/{product}/edit', 'ProductController@update')->name('product.update');
    Route::delete('product/{category}/index/product/{product}/delete', 'ProductController@destroy')->name('product.destroy');

    // Route Order
    Route::get('penjualan', 'OrderController@index')->name('order.index');
    Route::get('penjualan/{order}/detail', 'OrderController@show')->name('order.show');

    // Route Report
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report/changeperiode', 'ReportController@changePeriode')->name('report.changePeriode');

    // Route Profil
    Route::resource('profile', 'ProfileController');
});
