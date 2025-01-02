@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Konfirmasi Pembayaran</h2>

    <h3>Detail Pemesanan:</h3>
    <p><strong>Tiket:</strong> {{ $booking->ticket->departure }} → {{ $booking->ticket->destination }}</p>
    <p><strong>Jumlah Penumpang:</strong> {{ count(json_decode($booking->passenger_details, true)) }}</p>
    <p><strong>Kursi yang Dipilih:</strong> {{ implode(', ', json_decode($booking->seat_details)) }}</p>

    <p><strong>Harga Tiket:</strong> Rp. {{ number_format($booking->ticket->price, 0, ',', '.') }}</p>

    <p><strong>Total Harga:</strong> Rp. <span id="total_price"></span></p>

    <form action="{{ route('booking.complete', $booking->id) }}" method="POST" class="form-container shadow p-4 rounded">
        @csrf
        <input type="hidden" name="ticket_price" value="{{ $booking->ticket->price }}">  
        <input type="hidden" name="total_price" id="total_price_input" value="{{ $booking->ticket->price * count(json_decode($booking->passenger_details, true)) }}">  

        <div class="mb-3">
            <label for="payment_method" class="form-label">Pilih Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="virtual_account">Virtual Account</option>
                <option value="dana">Dana</option>
            </select>
        </div>

        <div id="virtual_account_div" class="mb-3" style="display: none;">
            <label for="bank_account" class="form-label">Pilih Bank</label>
            <select name="bank_account" id="bank_account" class="form-control">
                <option value="bca">BCA</option>
                <option value="bni">BNI</option>
                <option value="mandiri">Mandiri</option>
                <option value="briva">BRI</option>
            </select>
        </div>

        <div id="virtual_account_number" class="mb-3" style="display: none;">
            <label for="va_number" class="form-label">Nomor Virtual Account</label>
            <input type="text" id="va_number" class="form-control" readonly disabled />
        </div>

        <div id="dana_div" class="mb-3" style="display: none;">
            <label for="dana_number" class="form-label">Nomor Telepon (Dana)</label>
            <input type="text" name="dana_number" id="dana_number" class="form-control" placeholder="Nomor Telepon Dana" />
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success mt-3 w-100">Selesaikan Pembayaran</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function () {
        var paymentMethod = this.value;

        document.getElementById('virtual_account_div').style.display = 'none';
        document.getElementById('dana_div').style.display = 'none';
        document.getElementById('virtual_account_number').style.display = 'none';

        if (paymentMethod === 'virtual_account') {
            document.getElementById('virtual_account_div').style.display = 'block';
        } else if (paymentMethod === 'dana') {
            document.getElementById('dana_div').style.display = 'block';
        }
    });

    document.getElementById('bank_account').addEventListener('change', function () {
        var bank = this.value;
        var vaNumberField = document.getElementById('va_number');

        var vaNumber = '';
        if (bank === 'bca') {
            vaNumber = '123456789012';  
        } else if (bank === 'bni') {
            vaNumber = '987654321098';  
        } else if (bank === 'mandiri') {
            vaNumber = '112233445566';  
        } else if (bank === 'briva') {
            vaNumber = '556677889900';  
        }

        if (vaNumber) {
            vaNumberField.value = vaNumber;
            document.getElementById('virtual_account_number').style.display = 'block';
        }
    });

    function calculateTotalPrice() {
        var ticketPrice = {{ $booking->ticket->price }};
        var passengerCount = {{ count(json_decode($booking->passenger_details, true)) }};
        var totalPrice = ticketPrice * passengerCount;

        document.getElementById('total_price').textContent = totalPrice.toLocaleString();
        document.getElementById('total_price_input').value = totalPrice;
    }

    calculateTotalPrice();
</script>
@endsection
