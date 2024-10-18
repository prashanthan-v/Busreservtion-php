<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Buses;
use App\Models\Routes;
use App\Models\Seats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{ 
    public function index() {
        return view('display.index');
    }
   
    public function search(Request $request) {
        $source = $request->input('source');
        $destination = $request->input('destination');

        $date = $request->input('date');
        // dd($date);

        // Find available buses on the selected route
        $routes = Routes::where('start_location', $source)
                        ->where('end_location', $destination)
                         ->where('journey_date',$date)
                        ->get();
        //    dd($routes);
        return view('display.search_results', compact('routes', 'date'));
    }

    public function bookSeat(Request $request, $busId) {
        //    dd($request->all());

        $date = $request->input('date');
        $bus = Buses::find($busId);
        
        // $seats = $bus->seats()->where('is_booked', '0')->get();
        $seats = $bus->seats;
    
        return view('display.book_seat', compact('bus', 'seats','date'));

    }

 

    public function confirmBooking(Request $request) {
        $seatNumbers = $request->input('seat_number'); // This will be an array of selected seat numbers
           
    if (!is_array($seatNumbers)) {
        dd('seat_number is not an array, received:', $seatNumbers);
    }
        foreach ($seatNumbers as $seatNumber) {
            // Create a booking for each selected seat
            Bookings::create([
                'user_id' => Auth::id(),
                'bus_id' => $request->bus_id,
                'seat_number' => $seatNumber,
                'booking_date' => $request->date,
                'status' => 'confirmed'
            ]);
    
            // Mark seat as booked
            $seat = Seats::where('bus_id', $request->bus_id)
                        ->where('seat_number', $seatNumber)
                        ->first();
                        dd($seat);
            $seat->is_booked = 1;
            $seat->save();
            $seatUpdated = Seats::where('bus_id', $request->bus_id)
            ->where('seat_number', $seatNumber)
            ->update(['is_booked' => 1]);
           

            if ($seatUpdated == 0) {
                dd("Failed to update seat: {$seatNumber} for bus_id: {$request->bus_id}");
            } else {
                dd("Seat updated successfully: {$seatNumber} for bus_id: {$request->bus_id}");
            }

        }
    
        return redirect()->route('user.bookings')->with('success', 'Booking Confirmed!');
    }
    

}
