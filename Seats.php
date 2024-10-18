<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'seat_number', 'is_booked','gender'];

    // Define the relationship back to Bus
    public function bus()
    {
        return $this->belongsTo(Buses::class);
    }
}
