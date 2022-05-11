@extends('template.default')
@section('content')
@section('breadcrumb')
{{ Breadcrumbs::render('product.create', $category) }}
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Produk Kategori {{ $category->name}}</h3>
            </div>
            <form role="form" action="{{ route('product.store', $category)}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group {{ $errors->has('name') ? 'invalid' : '' }}">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name')}}"
                            placeholder="Masukkan Nama Produk">
                        @if ($errors->has('name'))
                        <span class="text-red">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('price') ? 'invalid' : '' }}">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price')}}"
                            placeholder="Masukkan Harga Produk">
                        @if ($errors->has('price'))
                        <span class="text-red">
                            {{ $errors->first('price') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
