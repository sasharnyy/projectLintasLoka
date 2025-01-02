@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Pemesanan Tiket</h2>

    <div class="row">
        <div class="col-md-6">
            <h3>{{ $ticket->departure }} → {{ $ticket->destination }}</h3>
            <p>{{ \Carbon\Carbon::parse($ticket->departure_time)->format('d/m/Y H:i') }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('booking.store', ['ticketId' => $ticket->id]) }}" method="POST" class="form-container shadow p-4 rounded">
        @csrf
        
        <div class="mb-3">
            <label for="number_of_passengers" class="form-label">Jumlah Penumpang</label>
            <input type="number" name="number_of_passengers" id="number_of_passengers" class="form-control" required min="1" max="9">
        </div>

        <div id="seatSelection" class="my-4">
            <h4 class="text-center">Pilih Kursi</h4>
            <div class="seat-grid">
                <div class="row">
                    <div class="steering">
                        <span>✇</span>
                    </div>
                    @foreach ([3, 5, 7, 9] as $seatNumber)
                        <div class="seat" id="seat{{ $seatNumber }}" onclick="selectSeat({{ $seatNumber }})">
                            <span>{{ $seatNumber }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    @foreach ([1, 2, 4, 6, 8] as $seatNumber)
                        <div class="seat" id="seat{{ $seatNumber }}" onclick="selectSeat({{ $seatNumber }})">
                            <span>{{ $seatNumber }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <input type="hidden" name="seat_details" id="seat_details">

        <div id="passengerDetails" class="mt-4">
            <h4 class="text-center">Data Penumpang</h4>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3 w-100">Pesan Tiket</button>
        </div>
    </form>
</div>

<script>
    let selectedSeats = [];
const maxSeatsInput = document.getElementById('number_of_passengers');
const passengerDetailsContainer = document.getElementById('passengerDetails');

maxSeatsInput.addEventListener('input', () => {
    const maxSeats = parseInt(maxSeatsInput.value) || 0;
    if (selectedSeats.length > maxSeats) {
        selectedSeats.splice(maxSeats);
        updateSeatSelection();
    }
    generatePassengerInputs(maxSeats);
});

function selectSeat(seatId) {
    const seatElement = document.getElementById(`seat${seatId}`);
    const maxSeats = parseInt(maxSeatsInput.value) || 0;

    if (seatElement.classList.contains('selected')) {
        seatElement.classList.remove('selected');
        selectedSeats = selectedSeats.filter(seat => seat !== seatId);
    } else if (selectedSeats.length < maxSeats) {
        seatElement.classList.add('selected');
        selectedSeats.push(seatId);
    } else {
        alert(`Anda hanya dapat memilih ${maxSeats} kursi.`);
    }

    document.getElementById('seat_details').value = JSON.stringify(selectedSeats);
}

function updateSeatSelection() {
    document.querySelectorAll('.seat').forEach(seat => {
        const seatId = parseInt(seat.id.replace('seat', ''));
        if (selectedSeats.includes(seatId)) {
            seat.classList.add('selected');
        } else {
            seat.classList.remove('selected');
        }
    });
}

function generatePassengerInputs(count) {
    passengerDetailsContainer.innerHTML = ''; 

    for (let i = 1; i <= count; i++) {
        const passengerForm = `
            <div class="mb-3">
                <label for="passenger_name_${i}" class="form-label">Nama Penumpang ${i}</label>
                <input type="text" name="passenger_details[${i}][name]" id="passenger_name_${i}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="passenger_age_${i}" class="form-label">Umur Penumpang ${i}</label>
                <input type="number" name="passenger_details[${i}][age]" id="passenger_age_${i}" class="form-control" required>
            </div>
        `;
        passengerDetailsContainer.innerHTML += passengerForm;
    }
}

</script>

<style>
.seat-grid {
    display: grid;
    grid-template-rows: repeat(2, auto);
    gap: 15px;
    justify-content: center;
    margin-top: 20px;
}

.row {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.steering {
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    border: 2px solid #ccc;
    border-radius: 50%;
    background-color: #f0f0f0;
    margin-right: 3px;
}

.seat {
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.seat:hover:not(.taken) {
    background-color: #e2e6ea;
}

.seat.selected {
    background-color: #4caf50;
    color: white;
    border-color: #4caf50;
}

.seat.taken {
    background-color: #dc3545;
    color: white;
    cursor: not-allowed;
}
</style>

@endsection
