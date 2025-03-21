<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arena extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id'];

    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }
}
