<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Buses;
use App\Models\Seats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class BookingController extends Controller
{
   


    public function confirmBooking(Request $request) {
 

        $seatNumbers = json_decode($request->input('seat_number'), true); // Array of selected seat numbers
        $seatDetails = json_decode($request->input('seat_details'), true); // Array of seat details
            //    dd($seatDetails);
        $seats = Seats::whereIn('seat_number', $seatNumbers)
                      ->where('bus_id', $request->bus_id)
                      ->get()
                      ->keyBy('seat_number');
                    //   dd($seats);
        
        // If multiple seats are booked by the user, no restriction applies
        if (count($seatDetails) > 1) {
            // Allow booking without restrictions
            foreach ($seatDetails as $detail) {
                // $this->processBooking($detail, $seats, $request);
                $seatNumber = $detail['seat_number'];
                $gender = $detail['gender'];
            //   $adjpasen =  $this->getAdjacentSeats($seatNumber, $request->bus_id);
          
            $adjacentSeat = $this->getAdjacentSeats($seatNumber, $request->bus_id);
            //    dd($adjacentSeat);
                 $adjacentpasenger = Seats::where("seat_number",$adjacentSeat)
                             ->where("bus_id",$request->bus_id)
                              ->first();
                    // dd($adjacentpasenger);
               if($gender!=$adjacentpasenger->gender){
                      
                     if($adjacentpasenger->gender!=null){
                        return "try different seat since you have selected seat next to opposite gender".$seatNumber;
                     }
                  


               }
              


            }
             
            //   dd($detail);
         

             $this->processBooking($seatDetails, $request);

            // return "booking confirmed";
            return redirect()->route('user.bookings')->with('success', 'Booking Confirmed!');
        }
    
        // For single seat bookings, apply gender restriction
        foreach ($seatDetails as $detail) {
            $seatNumber = $detail['seat_number'];
            $gender = $detail['gender'];
            //   dd($gender);
            // Ensure seat exists in the database
            if (!isset($seats[$seatNumber])) {
                return redirect()->back()->withErrors(["Seat $seatNumber does not exist."]);
            }
    
            // Check for adjacent seat conditions only for single bookings
            $adjacentSeat = $this->getAdjacentSeats($seatNumber, $request->bus_id);
            //    dd($adjacentSeat);
                 $adjacentpasenger = Seats::where("seat_number",$adjacentSeat)
                             ->where("bus_id",$request->bus_id)
                              ->first();

               if($gender==$adjacentpasenger->gender|| $adjacentpasenger->gender==null){
                  
                $this->processBooking($seatDetails, $request);
                return redirect()->route('user.bookings')->with('success', 'Booking Confirmed!');
               }
               return  "try different seat since you have selected seat next to opposite gender".$seatNumber;
        
        }
    
        return redirect()->route('user.bookings')->with('success', 'Booking Confirmed!');


    }
    


    public function userBookings() {
        $bookings = Bookings::where('user_id', Auth::id())->get();

        return view('display.my_bookings', compact('bookings'));
    }

   



    private function processBooking($seatdetails,$request) {

        $seatnumbers =[];
       foreach($seatdetails as $detail){
          
      
           
        $seatnumbers[] = $detail['seat_number'];
           

         $seat = Seats::where('seat_number',$detail['seat_number'])
                        ->where('bus_id',$request->bus_id)  
                        ->first();

                  $seat->is_booked = 1;
                 $seat->gender = $detail['gender'];
                  $seat->save();           

       }

               
       $listofseats =implode(",",$seatnumbers);

       $lastBooking = Bookings::where('bus_id', $request->bus_id) // Replace $busId with the actual bus ID you're querying for
                        ->latest()  // Orders by 'created_at' descending
                        ->first();
                        $currentcount = $lastBooking ? $lastBooking->count + 1 : 1;
         
          $bus = Buses::find($request->bus_id);

           $busname = $bus->bus_name;

          $cc = sprintf('%04d',$currentcount);

            $cyear =  date("Y");

            $Nyear =  date("Y")+1;


           
            $buscode = $busname . 'TIC-' . $cc . '/' . $cyear . '-' . substr($Nyear, 2, 4);
         
            //  dd($buscode);
        
        

                          Bookings::create([
            'user_id' => Auth::id(),
            'bus_id' => $request->bus_id,
            'seat_number' => $listofseats,
            'booking_date' => $request->date,
            'status' => 'confirmed',
            'count'=> $currentcount,
            'booking_code'=>$buscode,
        ]);
        
    }

    

    public function getAdjacentSeats($seatNumber,$busId){

     
        if($seatNumber%2==0){
           
                  return $seatNumber-1;
        }

        else{
            return $seatNumber+1;
        }
           

    }

     

      public function reverseseat (){
         
             Seats::where('is_booked',1)->update(['is_booked'=> 0]); 
             Seats::whereNotNull('gender')->update(['gender'=>null]); 
            //  Bookings::truncate();

             return "done";
  
      }



}
