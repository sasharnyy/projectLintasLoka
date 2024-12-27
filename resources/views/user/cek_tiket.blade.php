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
            <select name="departure" id="departure" class="form-control" required>
                <option value="">Pilih Keberangkatan</option>
                <optgroup label="Jabodetabek">
                    <option value="Jakarta">Jakarta</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Depok">Depok</option>
                    <option value="Bogor">Bogor</option>
                </optgroup>
                <optgroup label="Bandung">
                    <option value="Buah Batu">Buah Batu</option>
                    <option value="Dipatiukur">Dipatiukur</option>
                    <option value="Pasteur">Pasteur</option>
                </optgroup>
            </select>
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">Tujuan</label>
            <select name="destination" id="destination" class="form-control" required>
                <option value="">Pilih Tujuan</option>
                <optgroup label="Jabodetabek">
                    <option value="Jakarta">Jakarta</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Depok">Depok</option>
                    <option value="Bogor">Bogor</option>
                </optgroup>
                <optgroup label="Bandung">
                    <option value="Buah Batu">Buah Batu</option>
                    <option value="Dipatiukur">Dipatiukur</option>
                    <option value="Pasteur">Pasteur</option>
                </optgroup>
            </select>
        </div>
        <div class="mb-3">
            <label for="departure_date" class="form-label">Tanggal Berangkat</label>
            <input type="date" name="departure_date" id="departure_date" class="form-control" required>
        </div>
        <div id="returnDateContainer" class="mb-3" style="display: none;">
            <label for="return_date" class="form-label">Tanggal Pulang</label>
            <input type="date" name="return_date" id="return_date" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3 w-100">Cari Tiket</button>
        </div>
    </form>
    @if(isset($searchPerformed) && $searchPerformed)
        @if($tickets->isNotEmpty())
            <h3 class="text-center mt-4">Hasil Pencarian Tiket</h3>
            <div class="row mt-3">
                @foreach($tickets as $ticket)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Keberangkatan: {{ $ticket->departure_time }}</h5>
                                <div class="mb-2">
                                    <strong>Rute:</strong>
                                    <div>{{ $ticket->departure }} → {{ $ticket->destination }}</div>
                                </div>

                                @if($tripType === 'pulang_pergi')
                                    <div class="mb-2">
                                        <strong>Tanggal Pulang:</strong> 
                                        {{ \Carbon\Carbon::parse($ticket->return_date)->format('d/m/Y') ?? 'Tidak tersedia' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Jam Pulang:</strong> {{ $ticket->return_time ?? 'Tidak tersedia' }}
                                    </div>
                                @endif

                                <div class="mb-2">
                                    <strong>Harga:</strong> Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                </div>
                                <button class="btn btn-primary w-100">Pesan</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center mt-4">Tidak ada tiket yang sesuai dengan pencarian Anda.</p>
        @endif
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const btnSekaliJalan = document.getElementById('btnSekaliJalan');
    const btnPulangPergi = document.getElementById('btnPulangPergi');
    const returnDateContainer = document.getElementById('returnDateContainer');
    const returnDateInput = document.getElementById('return_date');
    const resultsContainer = document.querySelector('.row'); 
    const searchResultsTitle = document.querySelector('h3'); 

    const tripType = '{{ $tripType ?? "sekali_jalan" }}';

    if (tripType === 'pulang_pergi') {
        returnDateContainer.style.display = 'block';
        returnDateInput.required = true;
        btnPulangPergi.classList.add('btn-selected');
        btnSekaliJalan.classList.remove('btn-selected');
    } else {
        returnDateContainer.style.display = 'none';
        returnDateInput.required = false;
        btnSekaliJalan.classList.add('btn-selected');
        btnPulangPergi.classList.remove('btn-selected');
    }

    btnSekaliJalan.addEventListener('click', () => {
        returnDateContainer.style.display = 'none';
        returnDateInput.value = '';
        returnDateInput.required = false;
        btnSekaliJalan.classList.add('btn-selected');
        btnPulangPergi.classList.remove('btn-selected');
        resultsContainer.style.display = 'none';
        searchResultsTitle.style.display = 'none'; 
    });

    btnPulangPergi.addEventListener('click', () => {
        returnDateContainer.style.display = 'block';
        returnDateInput.required = true;
        btnPulangPergi.classList.add('btn-selected');
        btnSekaliJalan.classList.remove('btn-selected');
        resultsContainer.style.display = 'none'; 
        searchResultsTitle.style.display = 'none'; 
    });
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

    .card {
        border-radius: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 25px;
        padding: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection
