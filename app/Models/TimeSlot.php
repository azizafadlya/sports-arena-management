<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['arena_id', 'start_time', 'end_time', 'status'];

    public function arena(): BelongsTo
    {
        return $this->belongsTo(Arena::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

