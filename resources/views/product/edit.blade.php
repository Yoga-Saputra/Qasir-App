@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('product.edit',$category,$product) }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Produk {{ $product->name }} Kategori {{ $category->name}}</h3>
            </div>
            <form role="form" action="{{ route('product.update', [$category, $product])}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group {{ $errors->has('name') ? 'invalid' : '' }}">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name ?? old('name')}}"
                            placeholder="Masukkan Nama Produk">
                        @if ($errors->has('name'))
                        <span class="text-red">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('price') ? 'invalid' : '' }}">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control" name="price"
                            value="{{ $product->price ?? old('price')}}" placeholder="Masukkan Harga Produk">
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
