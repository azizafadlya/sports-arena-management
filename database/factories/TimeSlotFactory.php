<?php

namespace Database\Factories;

use App\Models\TimeSlot;
use App\Models\Arena;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = TimeSlot::class;

    public function definition(): array
    {
        return [
            'arena_id' => Arena::factory(), 
            'start_time' => now(),
            'end_time' => now()->addHour(),
            'status' => 'available',
        ];
    }
}
