<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    // untuk menampilkan semua data category pada file category/index.blade.php
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    // untuk menampilkan form tambah data category.
    public function create()
    {
        return view('category.create');
    }

    // untuk menyimpan data kedalam tabel categories. Pada fungsi ini juga ditambahkan untuk melakukan validasi form. Syntax alert digunakan untuk mengirimkan sweetalert.
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Nama Kategori Harus Di Isi',
            'description.required' => 'Deskripsi Kategori Harus Di Isi'
        ]);

        Category::create([
            'name'  => $request->name,
            'description' => $request->description,
            'slug'        => Str::slug($request->name)
        ]);

        Alert::success('Data Kategori Berasil Ditambahkan');
        return redirect()->route('category.index');
    }

    // Untuk menampilkan form edit data pada data yang dipilih oleh user.
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }
    // untuk menyimpan perubahan data kedalam tabel categories
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'  => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Nama Kategori Harus Di Isi',
            'description.required' => 'Deskripsi Kategori Harus Di Isi'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug'        => Str::slug($request->name)
        ]);

        Alert::success('Data Kategori Berasil Diubah');
        return redirect()->route('category.index');
    }

    // Untuk menghapus data yang dipilih oleh user.
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
