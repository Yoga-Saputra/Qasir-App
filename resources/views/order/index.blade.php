@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('penjualan') }}
@endsection
@section('content')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Penjualan</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Jumlah Bayar</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=0;
                        @endphp
                        @foreach ($orders as $order)
                        @php
                        $no++;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ Date::parse($order->created_at)->format('j F Y') }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $items->item($order->id) }}</td>
                            <td>{{ number_format($order->total) }}</td>
                            <td>{{ number_format($order->pay) }}</td>
                            <td>{{ $order->user->name}}</td>
                            <td><a href="{{ route('order.show', $order)}}" class="btn btn-success btn-sm"><i
                                        class="fas fa-eye"></i></a></td>

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
@endpush
