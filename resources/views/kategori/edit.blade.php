@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Edit Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit Kategori')

{{-- Customize layout sections --}}

@section('content_body')
<div class="row">
    <div class="col-md-12">

      <div class="card">

        <div class="card-body">

          <form method="POST" action="{{ url('/kategori/update/'.$data->kategori_id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}

            <div class="form-group">
                <label>ID Kategori:</label>
                <input type="text" class="form-control" name="id" value="{{ $data->kategori_id }}" readonly>
            </div>

            <div class="form-group">
              <label>Kode Kategori:</label>
              <input type="text" class="form-control" name="kategori_kode" value="{{ $data->kategori_kode }}">
            </div>

            <div class="form-group">
              <label>Nama Kategori:</label>
              <input type="text" class="form-control" name="kategori_nama" value="{{ $data->kategori_nama }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>

        </div>

      </div>

    </div>
</div>
@endsection
