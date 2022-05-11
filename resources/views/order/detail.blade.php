@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('detailorder') }}
@endsection
@section('content')
<div class="row mb-4">
    <div class="col-sm-12">
        <div class="float-right">
            <input type="button" class="btn btn-default" id="print" onclick="printreceipt()" value="Cetak Nota">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header bg-secondary color-palette">
                <h3 class="card-title">Detail Transaksi</h3>
            </div>
            <div class="card-body">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>No. Invoice</td>
                            <td class="text-primary strong">{{ $lastOrder->invoice}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>{{ Date::parse($lastOrder->created_at)->format('j F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Nama Customer</td>
                            <td>{{ $lastOrder->customer_name }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>Rp. {{ number_format($lastOrder->total) }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Dibayar</td>
                            <td>Rp. {{ number_format($lastOrder->pay) }}</td>
                        </tr>
                        <tr>
                            <td>Kembalian</td>
                            <td>Rp. {{ number_format($lastOrder->pay - $lastOrder->total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header bg-secondary color-palette">
                <h3 class="card-title">Menu Yang Dipesan</h3>
            </div>
            <div class="card-body">
                <table class="table table condensed">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nama Menu</td>
                            <td>Harga</td>
                            <td>Qty</td>
                            <td>Subtotal</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=0;
                        @endphp
                        @foreach ($lastOrder->orderDetail as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->product_name}}</td>
                            <td>{{ number_format($item->product_price)}}</td>
                            <td>{{ $item->qty}}</td>
                            <td>{{ number_format($item->subtotal)}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total:</th>
                            <th>{{ number_format($lastOrder->total)}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    function printreceipt(){
        var URL = "{{route('receipt',$lastOrder)}}";
        var W = window.open(URL);
        W.window.print();
}
</script>
@endpush
