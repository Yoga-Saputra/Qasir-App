@extends('template.default')
@section('breadcrumb')
@if (Auth::user()->hasRole('kasir'))
{{ Breadcrumbs::render('transaction') }}
@endif
@endsection
@section('content')
@include('sweetalert::alert')

@if (Auth::user()->hasRole('kasir'))
<div class="">
    <div class="row">
        <div class="col-12">
            <div id="custom-search-input">
                <div class="input-group">
                    <input id="product" name="product" type="text" class="form-control" placeholder="Search" />
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('addProduct')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" name="menu" id="menu">
                    <input type="hidden" class="form-control" name="id" id="id">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="price" id="price">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Qty</label>
                    <input type="text" class="form-control" name="qty" id="qty">
                </div>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-success" style="margin-top: 32px">Tambah</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Menu Yang Dipesan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=0;
                            $total=0;
                            @endphp
                            @foreach ($temp_orders as $order)
                            @php
                            $no++;
                            $subtotal=$order->subtotal;
                            $total = $total+$subtotal;
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $order->product_name}}</td>
                                <td>{{ number_format($order->product_price)}}</td>
                                <td>{{ $order->qty}}</td>
                                <td>{{ number_format($order->subtotal)}}</td>
                                <td>
                                    <form action="{{ route('temp_order.destroy',$order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total : </b></td>
                                <td>
                                    <b>{{ number_format($total)}}</b>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Transaksi</h3>
                </div>
                <form action="{{ route('process')}}" method="post">
                    @csrf
                    <input type="hidden" id="total" name="total" value="{{$total}}" onkeyup="sum();">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('customer') ? 'invalid' : '' }}">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" name="customer">
                                @if ($errors->has('customer'))
                                <span class="text-red">
                                    {{ $errors->first('customer') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Bayar</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" name="pay" id="pay" onkeyup="sum();">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Kembalian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" name="back" id="back">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control"  name="note" id="note" cols="50" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary"> Proses Transaksi </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rp. {{number_format($income_today)}}</h3>

                <p>Pendapatan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp. {{number_format($income_yesterday)}}</h3>
                <p>Pendapatan Kemarin</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $categories->count()}}</h3>

                <p>Jumlah Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-list"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$product}}</h3>

                <p>Jumlah Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-ol"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>
                    Penjualan Bulan Ini</h3>
            </div>
            <div class="card-body">
                <div class="app">
                    <center>
                        {{  $chart_daily->container()  }}

                    </center>
                </div>
                {{  $chart_daily->script()  }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>
                    Penjualan Per Bulan</h3>
            </div>
            <div class="card-body">
                <div class="app">
                    <center>
                        {{ $chart_monthly->container() }}

                    </center>
                </div>
                {{  $chart_monthly->script()  }}
            </div>
        </div>
    </div>
</div>
@endif

@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


<script type="text/javascript">
    $('#product').autocomplete({
        source: "{{ route('search') }}",
        minlenght: 1,
        autoFocus: true,
        select: function (e, last) {
            $('#menu').val(last.item.value);
            $('#price').val(last.item.price);
            $('#id').val(last.item.id);
        }

    });

</script>
<script>
    function sum() {
        var pay = document.getElementById('pay').value;
        var total = document.getElementById('total').value;
        // Fungsi parseInt merupakan fungsi dari javascript untuk mengubah String menjadi Integer atau mengubah kebilangan bulat. Artinya jika bilangan didalamnya mengandung desimal maka akan dikonversikan ke bilangan bulat.
        var result = parseInt(pay) - parseInt(total);
        // isNan() merupakan sebuah function yang menguji apakah nilai dari parameter expression itu adalah bukan angka. Kalau nilai expression tersebut adalah bukan angka maka fungsi ini akan mengembalikan nilai true. Jika nilai nilai tersebut adalah angka maka fungsi ini akan akan mengembalikan nilai false.
        if (!isNaN(result)) {
            document.getElementById('back').value = result;
        }
    }

</script>
@endpush
@endsection
