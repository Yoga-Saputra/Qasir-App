@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('report') }}
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Pendapatan {{ Date::parse($startDate)->format('j F Y') }} s/d
                    {{ Date::parse($endDate)->format('j F Y') }}</h3>
            </div>
            <div class="float-left mt-2 ml-2">
                <a href="{{ route('report.changePeriode')}}" class="btn btn-success">Ubah Periode</a>
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
                        @while (strtotime($startDate) <= strtotime($endDate))
                            @php
                                $no++;
                                $date=$startDate;
                                $startDate=date('Y-m-d', strtotime("+1 day", strtotime($startDate)));
                                $subtotal=$income->income($date);
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
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
