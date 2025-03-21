<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Booking;
use App\Models\User;
use App\Models\Arena;
use App\Models\TimeSlot;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_creates_a_booking()
    {
        $user = User::factory()->create();

        $arena = Arena::factory()->create(['owner_id' => $user->id]);

        $timeSlot = TimeSlot::factory()->create([
            'arena_id' => $arena->id,
        ]);

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot->id,
            'status' => 'pending',
        ]);
    }
}
