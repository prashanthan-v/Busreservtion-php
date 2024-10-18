<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Route</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create Route</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store-route') }}" method="POST">
                            @csrf
                            <!-- Bus Selection -->
                            <div class="mb-3">
                                <label for="bus_id" class="form-label">Select Bus</label>
                                <select class="form-select" id="bus_id" name="bus_id" required>
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->bus_name }} ({{ $bus->bus_number }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Route Information -->
                            <div class="mb-3">
                                <label for="start_location" class="form-label">Start Location</label>
                                <input type="text" class="form-control" id="start_location" name="start_location" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_location" class="form-label">End Location</label>
                                <input type="text" class="form-control" id="end_location" name="end_location" required>
                            </div>
                            <div class="mb-3">
                                <label for="departure_time" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="departure_time" name="departure_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="arrival_time" class="form-label">Arrival Time</label>
                                <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="journey_date" class="form-label">Journey Date</label>
                                <input type="date" class="form-control" id="journey_date" name="journey_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="fare" class="form-label">Fare</label>
                                <input type="number" class="form-control" id="fare" name="fare" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Create Route</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
