@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools"></div>
    </div>
    <div class="card-body">
    @if (@session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (@session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @empty($penjualan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('penjualan/'.$penjualan->penjualan_id) }}" class="form-horizontal">
            @csrf
            {!! method_field('PUT')!!}
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Kode Penjualan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                @error('penjualan_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Nama Pembeli</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                @error('pembeli')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Staff</label>
                <div class="col-11">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">- Pilih Staff -</option>
                    @foreach($user as $item)
                        <option value="{{ $item->user_id }}" @if($item->user_id == $penjualan->user_id) selected @endif>{{ $item->nama}}</option>
                    @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Tanggal Penjualan</label>
                <div class="col-11">
                    <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}" required>
                @error('penjualan_tanggal')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                </div>
            </div>
            {{-- detail --}}
                @foreach ($details as $i => $detail)
                <div id="row"> <div class="input-group m-3">
                    <input type="hidden" name="inputs[@php echo $i @endphp][detail_id]" value="{{ $detail->detail_id }}">
                    <select class="form-control" id="barang_id" name="inputs[@php echo $i @endphp][barang_id]" required>
                                    <option value="">- Barang -</option>
                                    @foreach($barang as $item)
                                        <option value="{{ $item->barang_id }}" @if($item->barang_id == $detail->barang_id) selected @endif>{{ $item->barang_nama }}</option>
                                    @endforeach
                                </select>
                    <input type="number" class="form-control" id="jumlah" name="inputs[@php echo $i @endphp][jumlah]" placeholder = "Jumlah" value="{{ old('jumlah', $detail->jumlah) }}">
                                    @error("jumlah")
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) location.href='{{ url('detail/'.$detail->detail_id) }}?_method=DELETE'">Hapus</button>
                    </div> </div>
                @endforeach
            {{-- detail end --}}

            {{-- barang baru --}}
            <div class="">
                <div class="col-lg-12">
                    <div id="newinput"></div>
                    <button id="rowAdder" type="button" class="btn btn-dark">
                        <span class="bi bi-plus-square-dotted">
                        </span> Tambah Barang
                    </button>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script type="text/javascript">
    var i = 0;
    $("#rowAdder").click(function() {
        newRowAdd =
            '<div id="row"> <div class="input-group m-3">' +
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button> </div>' +
            '<select class="form-control" id="barang_id" name="news[' + i + '][barang_id]" required>' +
                            '<option value="">- Barang -</option>' +
                            '@foreach($barang as $item)' +
                                '<option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>' +
                            '@endforeach' +
                        '</select>' +
            '<input type="number" class="form-control" id="jumlah" name="news[' + i + '][jumlah]" placeholder = "Jumlah">' +
                            '@error("jumlah")' +
                                '<small class="form-text text-danger">{{ $message }}</small>' +
                            '@enderror'+
            '</div> </div>';

        i++;
        $('#newinput').append(newRowAdd);

    });
    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#row").remove();
    })
</script>
@endpush
