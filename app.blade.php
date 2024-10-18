<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking Application</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Add Bootstrap CSS here if using -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Bus Booking</a>
        <!-- Add navigation links here -->
    </nav>

    <div class="container mt-4">
        @yield('content') <!-- This is where child view content will be injected -->
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2024 Bus Booking System</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
