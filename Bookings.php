<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bus_id', 'seat_number', 'booking_date', 'status','count','booking_code'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bus() {
        return $this->belongsTo(Buses::class);
    }
}
