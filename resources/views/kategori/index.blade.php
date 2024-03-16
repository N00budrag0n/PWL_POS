@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

{{-- Customize layout sections --}}

@section('content_body')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>
            <div class="card-body">
                <div class="mb-2">
                    <a href="{{url('kategori/create')}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Tambah Kategori
                    </a>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
