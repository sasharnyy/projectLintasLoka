@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Cek Tiket</h2>

    <div class="d-flex justify-content-center mb-4">
        <button id="btnSekaliJalan" class="btn btn-option btn-selected" type="button">Sekali Jalan</button>
        <button id="btnPulangPergi" class="btn btn-option" type="button">Pulang Pergi</button>
    </div>

    <form action="{{ route('cek.tiket.search') }}" method="POST" class="form-container shadow p-4 rounded">
        @csrf
        <div class="mb-3">
            <label for="departure" class="form-label">Keberangkatan</label>
            <input type="text" name="departure" id="departure" class="form-control" required placeholder="Pilih Keberangkatan">
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">Tujuan</label>
            <input type="text" name="destination" id="destination" class="form-control" required placeholder="Pilih Tujuan">
        </div>
        <div class="mb-3">
            <label for="departure_date" class="form-label">Tanggal Berangkat</label>
            <input type="date" name="departure_date" id="departure_date" class="form-control" required>
        </div>
        <div id="returnDateContainer" class="mb-3" style="display: none;">
            <label for="return_date" class="form-label">Tanggal Pulang</label>
            <input type="date" name="return_date" id="return_date" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3 w-100">Cari Tiket</button>
        </div>
    </form>

    @if(isset($tickets) && $tickets->isNotEmpty())
        <h3 class="text-center mt-4">Hasil Pencarian Tiket</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Tanggal Berangkat</th>
                    <th>Jam Berangkat</th>
                    @if($tickets->first()->return_date) 
                        <th>Tanggal Pulang</th>
                        <th>Jam Pulang</th>
                    @endif
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $index => $ticket)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ticket->departure }}</td>
                        <td>{{ $ticket->destination }}</td>
                        <td>{{ $ticket->departure_date }}</td>
                        <td>{{ $ticket->departure_time }}</td>
                        @if($ticket->return_date)
                            <td>{{ $ticket->return_date }}</td>
                            <td>{{ $ticket->return_time }}</td>
                        @endif
                        <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center mt-4">Tidak ada tiket yang sesuai dengan pencarian Anda.</p>
    @endif
</div>

<script>
    const btnSekaliJalan = document.getElementById('btnSekaliJalan');
    const btnPulangPergi = document.getElementById('btnPulangPergi');
    const returnDateContainer = document.getElementById('returnDateContainer');
    const returnTimeContainer = document.getElementById('returnTimeContainer');
    const departureTimeInput = document.getElementById('departure_time');
    const returnTimeInput = document.getElementById('return_time');

btnSekaliJalan.addEventListener('click', () => {
    returnDateContainer.style.display = 'none';
    departureTimeInput.required = true;
    returnTimeInput.required = false; 
    btnSekaliJalan.classList.add('btn-selected');
    btnPulangPergi.classList.remove('btn-selected');
});

btnPulangPergi.addEventListener('click', () => {
    returnDateContainer.style.display = 'block';
    departureTimeInput.required = true;
    returnTimeInput.required = false; 
    btnPulangPergi.classList.add('btn-selected');
    btnSekaliJalan.classList.remove('btn-selected');
});


    document.querySelector('form').addEventListener('submit', function(e) {
    if (btnPulangPergi.classList.contains('btn-selected')) {
        if (!document.getElementById('return_date').value) {
            alert('Tanggal pulang harus diisi untuk tiket Pulang Pergi.');
            e.preventDefault();
        }
    }
});

</script>

<style>
    .btn-option {
        padding: 10px 20px;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 25px;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-option:hover {
        background-color: #e2e6ea;
        border-color: #adb5bd;
    }

    .btn-selected {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .form-container {
        background-color: #ffffff;
        border: 1px solid #e6e6e6;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    h2 {
        color: #007bff;
        font-weight: 700;
    }
</style>
@endsection
