@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('category') }}
@endsection
@section('content')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kategori</h3>
                <div class="float-right">
                    <a class="btn btn-success btn-sm" href="{{ route('category.create')}}"><i class="fas fa-plus"></i>
                        Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=0;
                        @endphp
                        @foreach ($categories as $category)
                        @php
                        $no++;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category)}}" class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <button id="delete" data-title="{{ $category->name}}"
                                    href="{{ route('category.destroy',$category)}}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i></button>
                            </td>
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
                title: "Apakah Kamu Yakin Akan Menghapus Kategori " + title + "?",
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
