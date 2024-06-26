@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tampilan <?php echo (Auth::user()->level_id == 1) ? 'Admin' : 'Manager'; ?>
            </div>
            <div class="card-body">
                <h1>
                    Login sebagai <?php echo (Auth::user()->level_id == 1) ? 'Admin' : 'Manager'; ?>
                </h1>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
