@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Konfirmasi Pembayaran</h2>

    <h3>Detail Pemesanan:</h3>
    <p><strong>Tiket:</strong> {{ $booking->ticket->departure }} → {{ $booking->ticket->destination }}</p>
    <p><strong>Jumlah Penumpang:</strong> {{ count(json_decode($booking->passenger_details, true)) }}</p>
    <p><strong>Kursi yang Dipilih:</strong> {{ implode(', ', json_decode($booking->seat_details)) }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $booking->payment_method }}</p>

    <div class="text-center">
        <form action="{{ route('booking.complete', $booking->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success mt-3 w-100">Selesaikan Pembayaran</button>
        </form>
    </div>
</div>
@endsection
