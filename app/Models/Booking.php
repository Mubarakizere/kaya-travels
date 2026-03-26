<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'full_name',
        'email',
        'phone',
        'travel_date',
        'guests',
        'status',
        'notes',
    ];

    // A booking belongs to a trip
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    // A booking belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
