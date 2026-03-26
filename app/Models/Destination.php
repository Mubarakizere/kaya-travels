<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'image',
        'description',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Auto-generate slug on creating (optional helper)
    protected static function booted()
    {
        static::creating(function ($destination) {
            if (empty($destination->slug)) {
                $destination->slug = Str::slug($destination->name);
            }
        });
    }

    // Relationship to trips if needed
    public function trips()
    {
        return $this->hasMany(\App\Models\Trip::class);
    }
}
