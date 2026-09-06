@extends('layouts.app')
@section('page-header')
<!—DataTables Buttons Css →
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
<style>
    .dt-buttons .dt-button {
        border: 0 !important;
        border-radius: .5rem !important;
        padding: .45rem .85rem !important;
        margin-right: .35rem !important;
        background: var(--bs-primary) !important;
        color: #fff !important;
    }
</style>
<div class="iq-navbar-header" style="height:215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1>Laporan Persediaan</h1>
                        <p>Lihat laporan transaksi barang masuk dan barang keluar berdasarkan periode tanggal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="{{ asset('hope-ui/assets/images/dashboard/yangini.png') }}"
            alt="header"
            class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>
@endsection

@section('content')
<style>
    /* 1. Warna kotak halaman yang sedang aktif (terpilih) */
    .page-item.active .page-link {
        background-color: #46136b !important;
        border-color: #46136b !important;
        color: white !important;
    }

    /* 2. Warna teks tulisan Previous, Next, dan angka yang tidak aktif */
    .page-link {
        color: #46136b !important;
    }

    /* 3. Warna saat kursor menyentuh tombol halaman (hover) */
    .page-link:hover {
        background-color: rgba(70, 19, 107, 0.1) !important;
        color: #46136b !important;
    }
</style>

<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Filter --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title mb-1">Filter Laporan</h4>
                        <p class="mb-0 text-secondary">
                            Pilih jenis transaksi dan rentang tanggal untuk menampilkan laporan.
                        </p>
                          </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.index') }}" method="GET">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Jenis Transaksi</label>
                                <select name="type" class="form-select">
                                    <option value="">Semua Transaksi</option>
                                    <option value="Masuk" {{ request('type') == 'Masuk' ? 'selected' : '' }}>
                                        Barang Masuk
                                    </option>
                                    <option value="Keluar" {{ request('type') == 'Keluar' ? 'selected' : '' }}>
                                        Barang Keluar
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date"
                                    name="start_date"
                                    class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date"
                                    name="end_date"
                                    class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn text-white" style="background-color: #46136b; border-color: #46136b;">
    Filter
</button>
                                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Summary --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card" data-aos="fade-up" data-aos-delay="450">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Total Transaksi</p>
                    <h3 class="mb-0">{{ number_format($totalTransactions) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" data-aos="fade-up" data-aos-delay="500">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Total Barang Masuk</p>
                    <h3 class="mb-0 text-success">{{ number_format($totalIn) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" data-aos="fade-up" data-aos-delay="550">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Total Barang Keluar</p>
                    <h3 class="mb-0 text-danger">{{ number_format($totalOut) }}</h3>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabel Laporan --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card" data-aos="fade-up" data-aos-delay="650">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="header-title">
                        <h4 class="card-title mb-1">Data Laporan Transaksi</h4>
                        <p class="mb-0 text-secondary">
                            Daftar transaksi persediaan sesuai filter yang dipilih.
                        </p>
                    </div>
                </div>


                <div class="card-body">
                    @if (request('type') || request('start_date') || request('end_date'))
                    <div class="alert alert-light border">
                        <strong>Filter aktif:</strong>
                        Jenis:
                        <strong>
                            @if (request('type') == 'Masuk')
                            Barang Masuk
                            @elseif (request('type') == 'Keluar')
                            Barang Keluar
                            @else
                            Semua Transaksi
                            @endif
                        </strong>,
                        Tanggal:
                        <strong>
                            {{ request('start_date') ?: 'Awal' }}
                            s/d
                            {{ request('end_date') ?: 'Akhir' }}
                        </strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="laporanTable" class="table table-striped table-hover word-wrap">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Petugas</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $transaction->created_at ? $transaction->created_at->format('d-m-Y') : ' - ' }}
                                    </td>
                                    <td>
                                        <span class="badge" style="background-color: #46136b; color: white;">
    {{ $transaction->product->code ?? ' - ' }}
</span>
                                    </td>
                                    <td>
                                        <strong>{{ $transaction->product->name ?? ' - ' }}</strong>
                                    </td>
                                    <td>
                                        {{ $transaction->product->category->name ?? ' - ' }}
                                    </td>
                                    <td>
                                        @if (strtolower($transaction->type) === 'Masuk')
                                        <span class="badge bg-success">Barang Masuk</span>
                                        @else
                                        <span class="badge bg-danger">Barang Keluar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ number_format($transaction->quantity) }}</strong>
                                        <small class="text-muted">
                                            {{ $transaction->product->unit ?? ' pcs' }}
                                              </small>
                                    </td>
                                    <td>{{ $transaction->user->name ?? ' - ' }}</td>
                                    <td>
                                        @if ($transaction->note)
                                        {{ Str::limit($transaction->note, 60) }}
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        Tidak ada data transaksi sesuai filter.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.jQuery && $.fn.DataTable) {
            $('#laporanTable').DataTable({
                pageLength: 25,
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, 'ALL']
                ],
                dom: '<"row align-items-center mb-3"<"col-md-4"l><"col-md-4 text-center"B><"col-md-4"f>>rt<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        title: 'Laporan_Stok_GadgetZ_' + new Date().toISOString().slice(0,10),
                        className: 'btn btn-success btn-sm' // Tambahan class biar makin rapi
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        title: 'Laporan_Stok_GadgetZ_' + new Date().toISOString().slice(0,10),
                        orientation: 'landscape',
                        pageSize: 'A4',
                        className: 'btn btn-danger btn-sm'
                    },
                    {
                        extend: 'print',
                        text: 'Print / Cetak',
                        title: 'Laporan_Stok_GadgetZ_' + new Date().toISOString().slice(0,10),
                        className: 'btn btn-info btn-sm'
                    }
                ]
            });
        }
    });
</script>
@endpush
@endsection
