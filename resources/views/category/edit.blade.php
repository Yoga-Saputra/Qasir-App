@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('category.edit', $category) }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Kategori {{ $category->name}}</h3>
            </div>
            <form role="form" action="{{ route('category.update', $category)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group {{ $errors->has('name') ? 'invalid' : '' }}">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name ?? old('name')}}"
                            placeholder="Masukkan Nama Kategori">
                        @if ($errors->has('name'))
                        <span class="text-red">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'invalid' : '' }}">
                        <label>Deskripsi Kategori</label>
                        <input type="text" class="form-control" name="description"
                            value="{{ $category->description ?? old('description')}}"
                            placeholder="Masukkan Deskripsi Kategori">
                        @if ($errors->has('description'))
                        <span class="text-red">
                            {{ $errors->first('description') }}
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
