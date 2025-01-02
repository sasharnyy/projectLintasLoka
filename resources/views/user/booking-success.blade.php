@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Pemesanan Berhasil!</h2>

    <p class="text-center">Terima kasih telah memesan tiket. Berikut adalah detail pemesanan Anda:</p>

    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item"><strong>Tiket:</strong> {{ $booking->ticket->departure }} → {{ $booking->ticket->destination }}</li>
                <li class="list-group-item"><strong>Jumlah Penumpang:</strong> {{ count(json_decode($booking->passenger_details, true)) }}</li>
                <li class="list-group-item"><strong>Kursi yang Dipilih:</strong> {{ implode(', ', json_decode($booking->seat_details)) }}</li>
                <li class="list-group-item"><strong>Metode Pembayaran:</strong> {{ $booking->payment_method }}</li>

                @if ($booking->payment_method == 'virtual_account')
                    <li class="list-group-item"><strong>Bank:</strong> {{ ucfirst($booking->bank_account) }}</li>
                    <li class="list-group-item"><strong>Nomor Virtual Account:</strong> {{ $booking->va_number }}</li>
                @elseif ($booking->payment_method == 'dana')
                    <li class="list-group-item"><strong>Nomor Telepon (Dana):</strong> {{ $booking->dana_number }}</li>
                @endif
            </ul>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Rincian Pembayaran</h5>
                    <p><strong>Harga Tiket (per orang):</strong> Rp. {{ number_format($booking->ticket_price, 0, ',', '.') }}</p>
                    <p><strong>Total Harga:</strong> Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    <p>Anda akan menerima email konfirmasi dalam beberapa saat.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
