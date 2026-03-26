<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
    'title', 'slug', 'category', 'location', 'price', 'duration',
    'short_description', 'full_description',
    'thumbnail', 'gallery', // ✅ ADD THIS
    'itinerary', 'inclusions', 'exclusions',
    'status', 'is_top', 'meta_title', 'destination_id',
'meta_description'
];

    protected $casts = [
    'status' => 'boolean',
    'is_top' => 'boolean',
    'gallery' => 'array',
    'itinerary' => 'array',
    'inclusions' => 'array',
    'exclusions' => 'array',
];
// Trip.php
public function destination()
{
    return $this->belongsTo(Destination::class);
}

}
