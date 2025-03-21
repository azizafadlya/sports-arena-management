<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Arena;
use App\Models\TimeSlot;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_users_to_book_a_time_slot()
    {
        $user = User::factory()->create(); 

        $arena = Arena::factory()->create(['owner_id' => $user->id]);

        $timeSlot = TimeSlot::factory()->create([
            'arena_id' => $arena->id,
            'start_time' => '2025-03-05 12:00:00',
            'end_time' => '2025-03-05 13:00:00',
            'status' => 'available',
        ]);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/bookings', [
            'time_slot_id' => $timeSlot->id, 
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'user_id', 'time_slot_id', 'status']);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'time_slot_id' => $timeSlot->id,
            'status' => 'pending',
        ]);
    }
}
