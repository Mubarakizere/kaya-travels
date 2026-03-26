<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline',
        'flight_number',
        'from_location',
        'to_location',
        'departure_date',
        'departure_time',
        'arrival_date',
        'arrival_time',
        'seat_capacity',
        'price',
        'description',
    ];
}
