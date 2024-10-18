@extends('display.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Available Buses</h2>

    @if($routes->count() > 0)
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Bus Name</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
            <tr>
                <td>{{ $route->bus->bus_name }}</td>
                <td>{{ $route->departure_time }}</td>
                <td>{{ $route->arrival_time }}</td>
                <td>
                    {{-- <a href="{{ route('bus.book', $route->bus->id) }}" class="btn btn-success">Book Now</a> --}}

                    <a href="{{ route('bus.book', ['busId' => $route->bus->id, 'date' => $date]) }}" class="btn btn-success">Book Now</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center text-danger">No buses available for the selected route.</p>
    @endif
</div>
@endsection
