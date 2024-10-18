@extends('display.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Book Your Bus</h1>
    <form method="POST" action="{{ route('bus.search') }}" class="mt-5">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-3">
                <input type="text" name="source" class="form-control" placeholder="Source" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="destination" class="form-control" placeholder="Destination" required>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Search Buses</button>
            </div>
        </div>
    </form>
</div>
@endsection
