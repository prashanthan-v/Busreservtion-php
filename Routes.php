<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'start_location', 'end_location', 'departure_time', 'arrival_time', 'journey_date', 'fare'];

    // Define the relationship back to Bus
    public function bus()
    {
        return $this->belongsTo(Buses::class);
    }
}
