@extends('display.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">My Bookings</h2>

    @if($bookings->count() > 0)
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Bus Name</th>
                <th>Seat Number</th>
                <th>Booking Date</th>
                <th>Bookingcode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->bus->bus_name }}</td>
                <td>{{ $booking->seat_number }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->booking_code }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center text-danger">You have no bookings yet.</p>
    @endif
</div>
@endsection
