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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create Route and Bus Details</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store-route') }}" method="POST">
                            @csrf

                            <!-- Bus Name -->
                            <div class="mb-3">
                                <label for="bus_name" class="form-label">Bus Name</label>
                                <input type="text" class="form-control" id="bus_name" name="bus_name" required>
                            </div>

                            <!-- Bus Number -->
                            <div class="mb-3">
                                <label for="bus_number" class="form-label">Bus Number</label>
                                <input type="text" class="form-control" id="bus_number" name="bus_number" required>
                            </div>

                            <!-- Number of Seats -->
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Number of Seats</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" required>
                            </div>

                            <!-- Start Location -->
                            <div class="mb-3">
                                <label for="start_location" class="form-label">Start Location</label>
                                <input type="text" class="form-control" id="start_location" name="start_location" required>
                            </div>

                            <!-- End Location -->
                            <div class="mb-3">
                                <label for="end_location" class="form-label">End Location</label>
                                <input type="text" class="form-control" id="end_location" name="end_location" required>
                            </div>

                            <!-- Departure Time -->
                            <div class="mb-3">
                                <label for="departure_time" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="departure_time" name="departure_time" required>
                            </div>

                            <!-- Arrival Time -->
                            <div class="mb-3">
                                <label for="arrival_time" class="form-label">Arrival Time</label>
                                <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                            </div>

                            <!-- Journey Date -->
                            <div class="mb-3">
                                <label for="journey_date" class="form-label">Journey Date</label>
                                <input type="date" class="form-control" id="journey_date" name="journey_date" required>
                            </div>

                            <!-- Fare -->
                            <div class="mb-3">
                                <label for="fare" class="form-label">Fare</label>
                                <input type="number" class="form-control" id="fare" name="fare" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Create Route and Bus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
