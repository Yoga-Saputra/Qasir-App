@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('product', $category) }}
@endsection
@section('content')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Product Kategori {{ $category->name }}</h3>
                <div class="float-right">
                    <a class="btn btn-success btn-sm" href="{{ route('product.create', $category)}}"><i
                            class="fas fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=0;
                        @endphp
                        @foreach ($products as $product)
                        @php
                        $no++;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>
                                <a href="{{ route('product.edit',[$category, $product])}}"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                                <button id="delete" data-title="{{ $product->name}}"
                                    href="{{ route('product.destroy',[$category, $product])}}"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                <form action="" method="post" id="deleteForm">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" value="" style="display:none">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

@endpush

@push('scripts')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('button#delete').on('click', function () {
        var href = $(this).attr('href');
        var title = $(this).data('title')

        swal({
                title: "Apakah Kamu Yakin Akan Menghapus Prouct " + title + "?",
                text: "Data yang terhapus tidak bisa dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();
                    swal("Data Berhasil Dihapus", {
                        icon: "success",
                    });
                }
            });

    });

</script>
@endpush
