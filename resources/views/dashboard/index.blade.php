@extends('layouts.app')

@section('page-header')
<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1>Dashboard</h1>
                        <p>Ringkasan stok barang, transaksi persediaan, dan kondisi barang saat ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="{{ asset('hope-ui/assets/images/dashboard/yangini.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <p class="mb-0 text-secondary">Total Barang</p>
                    <h4>{{ $totalProducts }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <p class="mb-0 text-secondary">Total Stok</p>
                    <h4>{{ $totalStock }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <p class="mb-0 text-success">Barang Masuk</p>
                    <h4>{{ $totalStockIn }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <p class="mb-0 text-danger">Barang Keluar</p>
                    <h4>{{ $totalStockOut }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Grafik Transaksi Bulan Ini</h4></div>
                <div class="card-body">
                    <canvas id="chartTransaksi" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Transaksi Terbaru</h4></div>
                <div class="card-body">
                    @foreach($transactions as $t)
                    <div class="d-flex mb-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $t->product->name }}</h6>
                            <small class="text-muted">{{ $t->created_at->diffForHumans() }}</small>
                        </div>
                        <span class="badge {{ $t->type == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ $t->quantity }} {{ $t->product->unit }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartTransaksi').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Masuk',
                data: {!! json_encode($chartIn) !!},
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)'
            }, {
                label: 'Keluar',
                data: {!! json_encode($chartOut) !!},
                borderColor: '#EF4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)'
            }]
        }
    });
</script>
@endpush