


 
{{-- @extends('display.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Select Seats on {{ $bus->bus_name }}</h2>
    <form action="{{ route('bus.confirm') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="bus_id" value="{{ $bus->id }}">
        <input type="hidden" name="date" value="{{ $date }}">
        
        <div class="bus-layout">
            @foreach ($seats as $seat)
                <div class="seat-container">
                    @if ($seat->is_booked)
                        <div class="seat booked" data-seat-number="{{ $seat->seat_number }}">
                            Seat {{ $seat->seat_number }}
                        </div>
                    @else
                        <div class="seat available" data-seat-number="{{ $seat->seat_number }}">
                            Seat {{ $seat->seat_number }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        <input type="hidden" name="seat_number" id="selected-seats" value="">
        
        <button type="submit" class="btn btn-primary btn-block">Confirm Booking</button>
    </form>
</div>

<style>
    .bus-layout {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    .seat-container {
        width: 20%;
        text-align: center;
        margin: 10px;
    }
    .seat {
        padding: 10px;
        margin: 5px;
        cursor: pointer;
        border: 1px solid #ccc;
    }
    .seat.available {
        background-color: #dff0d8;
    }
    .seat.booked {
        background-color: #f2dede;
        cursor: not-allowed;
    }
    .seat.selected {
        background-color: #d9edf7;
    }
</style>

<script>
    document.querySelectorAll('.seat.available').forEach(seat => {
        seat.addEventListener('click', function () {
            this.classList.toggle('selected');
            updateSelectedSeats();
        });
    });

    function updateSelectedSeats() {
        const selectedSeats = Array.from(document.querySelectorAll('.seat.selected'))
            .map(seat => seat.getAttribute('data-seat-number'));
        document.getElementById('selected-seats').value = JSON.stringify(selectedSeats); ;
    }
</script>
@endsection --}}



@extends('display.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Select Seats on {{ $bus->bus_name }}</h2>
    <form action="{{ route('bus.confirm') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="bus_id" value="{{ $bus->id }}">
        <input type="hidden" name="date" value="{{ $date }}">
        
        <div class="bus-layout">
            @foreach ($seats as $seat)
                <div class="seat-container">
                    @if ($seat->is_booked)
                        <div class="seat booked" data-seat-number="{{ $seat->seat_number }}">
                            Seat {{ $seat->seat_number }}
                        </div>
                    @else
                        <div class="seat available" data-seat-number="{{ $seat->seat_number }}">
                            Seat {{ $seat->seat_number }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        <div id="passenger-details"></div>
        
        <input type="hidden" name="seat_number" id="selected-seats" value="">
        <input type="hidden" name="seat_details" id="seat-details" value="">
        
        <button type="submit" class="btn btn-primary btn-block">Confirm Booking</button>
    </form>
</div>

<style>
    .bus-layout {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    .seat-container {
        width: 20%;
        text-align: center;
        margin: 10px;
    }
    .seat {
        padding: 10px;
        margin: 5px;
        cursor: pointer;
        border: 1px solid #ccc;
    }
    .seat.available {
        background-color: #dff0d8;
    }
    .seat.booked {
        background-color: #f2dede;
        cursor: not-allowed;
    }
    .seat.selected {
        background-color: #d9edf7;
    }
</style>




<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seatDetailsContainer = document.getElementById('passenger-details');

        // Add event listeners to available seats
        document.querySelectorAll('.seat.available').forEach(seat => {
            seat.addEventListener('click', function () {
                this.classList.toggle('selected');
                updatePassengerDetails()
                updateSelectedSeats();
            });
        });

        // Update selected seats and passenger details
        function updateSelectedSeats() {
            const selectedSeats = Array.from(document.querySelectorAll('.seat.selected'))
                .map(seat => seat.getAttribute('data-seat-number'));
            document.getElementById('selected-seats').value = JSON.stringify(selectedSeats);

            const seatDetails = Array.from(document.querySelectorAll('.seat.selected')).map(seat => {
                const seatNumber = seat.getAttribute('data-seat-number');
                return {
                    seat_number: seatNumber,
                    name: document.querySelector(`#seat-${seatNumber}-name`)?.value || '',
                    gender: document.querySelector(`#seat-${seatNumber}-gender`)?.value || ''
                };
            });
            document.getElementById('seat-details').value = JSON.stringify(seatDetails);
        }

        // Add or update passenger details inputs based on selected seats
        function updatePassengerDetails() {
            seatDetailsContainer.innerHTML = ''; // Clear previous details

            const selectedSeats = Array.from(document.querySelectorAll('.seat.selected'));
            selectedSeats.forEach(seat => {
                const seatNumber = seat.getAttribute('data-seat-number');
                const detailsHtml = `
                    <div class="seat-detail" id="seat-${seatNumber}-details">
                        <label for="seat-${seatNumber}-name">Name for seat ${seatNumber}:</label>
                        <input type="text" id="seat-${seatNumber}-name">
                        <label for="seat-${seatNumber}-gender">Gender for seat ${seatNumber}:</label>
                        <select id="seat-${seatNumber}-gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                `;
                seatDetailsContainer.insertAdjacentHTML('beforeend', detailsHtml);
            });

            // Update seat details when input values change
            seatDetailsContainer.addEventListener('change', updateSelectedSeats);
        }

        updatePassengerDetails();
    });
</script>


@endsection


