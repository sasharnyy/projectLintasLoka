@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Pemesanan Berhasil!</h2>

    <p>Terima kasih telah memesan tiket. Berikut adalah detail pemesanan Anda:</p>

    <ul>
        <li><strong>Tiket:</strong> {{ $booking->ticket->departure }} → {{ $booking->ticket->destination }}</li>
        <li><strong>Jumlah Penumpang:</strong> {{ count(json_decode($booking->passenger_details)) }}</li>
        <li><strong>Kursi yang Dipilih:</strong> {{ implode(', ', json_decode($booking->seat_details)) }}</li>
        <li><strong>Metode Pembayaran:</strong> {{ $booking->payment_method }}</li>
    </ul>

    <p>Anda akan menerima email konfirmasi dalam beberapa saat.</p>
</div>
@endsection
