<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses extends Model
{
    use HasFactory;

    protected $fillable = ['bus_number', 'bus_name', 'capacity', 'type'];

    // Define the relationship to Route and Seat
    public function routes()
    {
        return $this->hasMany(Routes::class);
    }

    public function seats()
    {
        return $this->hasMany(Seats::class,'bus_id');
    }
}
