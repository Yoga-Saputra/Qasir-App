@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('change.periode') }}
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ubah Periode</h3>
            </div>
            <form action="{{ route('report.changePeriode')}}" method="GET">
                <div class="card-body">
                    <div class="form-group">
                        <label>Pilih Periode</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="daterange" name="daterange">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (!empty($startDate))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Laporan Pendapatan {{ Date::parse($startDate)->format('j F Y') }} s/d
                    {{ Date::parse($endDate)->format('j F Y') }}
                </h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=0;
                        $total=0;
                        @endphp
                        {{-- strtotime() adalah Fungsi untuk mengubah string dari tanggal atau waktu ke dalam standar timestamp Unix. Dan Nilai keluarannya adalah jumlah detik yang dhitung sejak 1 Januari 1970. --}}
                        @while (strtotime($startDate) <= strtotime($endDate)) @php $no++; $date=$startDate;
                            $startDate=date('Y-m-d', strtotime("+1 day", strtotime($startDate))); $subtotal=$income->
                            income($date);
                            $total= $total+$subtotal;
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ Date::parse($date)->format('j F Y') }}</td>
                                <td>{{ number_format($income->income($date))}}</td>
                            </tr>
                            @endwhile
                            <tr>
                                <td></td>
                                <td>Total Pendapatan</td>
                                <td>{{ number_format($total)}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
@endpush

@push('scripts')
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    $(function () {
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
    });

</script>
@endpush
