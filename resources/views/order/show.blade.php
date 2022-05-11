@extends('template.default')
@section('breadcrumb')
{{ Breadcrumbs::render('penjualan.detail', $order) }}
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>
                        {{ $profile->name}}
                        <small class="float-right">Date: {{ Date::parse($order->created_at)->format('j F Y') }}</small>
                    </h4>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Invoice
                    <strong>#{{ $order->invoice}}</strong><br>
                    Customer, {{$order->customer_name}}<br>
                    Kasir, {{$order->user->name}}
                </div>

            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetail as $item)
                            <tr>
                                <td>{{ $item->qty}}</td>
                                <td>{{ $item->product_name}}</td>
                                <td>{{ number_format($item->product_price)}}</td>
                                <td>{{ number_format($item->subtotal)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Total:</th>
                                <td>{{ number_format($order->total)}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Bayar:</th>
                                <td>{{ number_format($order->pay)}}</td>
                            </tr>
                            <tr>
                                <th>Kembalian:</th>
                                <td>{{ number_format($order->pay - $order->total) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
