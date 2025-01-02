@extends('layouts.user')

@section('title', 'Outlet Kami')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center text-primary">Outlet Kami</h1> 
    <div class="row">
        @foreach ($outlets as $outlet)
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-light">
                <div class="card-body">
                    <h5 class="text-uppercase text-muted">{{ $outlet->city }}</h5>
                    <h3 class="font-weight-bold">{{ $outlet->area }}</h3>
                    <div>
                        <span class="badge bg-danger">{{ $outlet->type }}</span>
                    </div>
                    <p class="mt-3">
                        <strong>Buka:</strong> {{ $outlet->opening_hours }} <br>
                        <strong>Tutup:</strong> {{ $outlet->closing_hours }}
                    </p>
                    <p>
                        <strong>Alamat:</strong> {{ $outlet->address }} <br>
                        <strong>Kode Pos:</strong> {{ $outlet->postal_code }}
                    </p>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
