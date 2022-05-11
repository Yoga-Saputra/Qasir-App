<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // untuk menampilkan semua data product pada file product/category.blade.php
    public function category()
    {
        $categories = Category::all();
        return view('product.category', compact('categories'));
    }

    // untuk menampilkan semua data product berdasarkan category pada file product /index.blade.php
    public function index(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        return view('product.index', compact('products', 'category'));
    }

    // untuk menampilkan form tambah data product.
    public function create(Category $category)
    {
        return view('product.create', compact('category'));
    }

    // untuk menyimpan data kedalam tabel products. Pada fungsi ini juga ditambahkan untuk melakukan validasi form. Syntax alert digunakan untuk mengirimkan sweetalert.
    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Nama Product Harus DI Isi',
            'price.require' => 'Harga Product Harus Di Isi'
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
        ]);
        Alert::success('Data Produk Baru Berhasil Ditambahkan');
        return redirect()->route('product.index', $category);
    }

    // Untuk menampilkan form edit data pada data yang dipilih oleh user.
    public function edit(Category $category, Product $product)
    {
        return view('product.edit', compact('category', 'product'));
    }

    // untuk menyimpan perubahan data kedalam tabel products.
    public function update(Request $request, Category $category, Product $product)
    {
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Nama Product Harus DI Isi',
            'price.require' => 'Harga Product Harus Di Isi'
        ]);
        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);
        Alert::success('Data Produk Berhasil Diperbarui');
        return redirect()->route('product.index', $category);
    }

    // Untuk menghapus data yang dipilih oleh user.
    public function destroy(Category $category, Product $product)
    {
        $product->delete();
        return redirect()->route('product.index', $category);
    }
}
