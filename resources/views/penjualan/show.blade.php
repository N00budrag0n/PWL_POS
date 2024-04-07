@extends('layouts.template')

@section('content')
{{-- <div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools"></div>
    </div>
    <div class="card-body">
    @empty($penjualan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
        </div>
        @else
    <table class="table table-bordered table-striped table-hover tablesm">
        <tr>
            <th>ID</th>
            <td>{{ $penjualan->detail_id }}</td>
        </tr>
        <tr>
            <th>ID Penjualan</th>
            <td>{{ $penjualan->penjualan_id}}</td>
        </tr>
        <tr>
            <th>Nama Pembeli</th>
            <td>{{ $penjualan->pembeli}}</td>
        </tr>
        <tr>
            <th>Staff yang menangani</th>
            <td>{{ $penjualan->user->nama }}</td>
        </tr>
        <tr>
            <th>Tanggal Penjualan (Transaksi)</th>
            <td>{{ $penjualan->penjualan_tanggal }}</td>
        </tr>
        </table>
    @endempty
    </div>
</div> --}}

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools"></div>
    </div>
    <div class="card-body">
    @empty($detail)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Tidak ada Detail Penjualan untuk data ini!.
        </div>
    @else
    <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
        <thead>
            <tr><th>ID</th><th>Kode Penjualan</th><th>Penanggung Jawab</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Tanggal</th><th>Total</th></tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach ($detail as $detail)
                <tr>
                    <td>{{ $detail->detail_id }}</td>
                    <td>{{ $detail->penjualan->penjualan_kode }}</td>
                    <td>{{ $detail->penjualan->user->level->level_nama }}</td>
                    <td>{{ $detail->barang->barang_nama }}</td>
                    <td>{{ $detail->harga }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->penjualan->penjualan_tanggal }}</td>
                    <td>{{ $detail->harga * $detail->jumlah }}</td>
                </tr>
                @php $total += $detail->harga * $detail->jumlah @endphp
            @endforeach
            <tr>
                <td colspan="7"><b>Grand Total</b></td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
    </table>
    @endempty
    <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush

