<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function getAll()
    {
        return Booking::all();
    }

    public function findById(int $id): ?Booking
    {
        return Booking::find($id);
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Booking::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Booking::destroy($id) > 0;
    }

    public function findActiveBookingByTimeSlot(int $timeSlotId)
    {
        return Booking::where('time_slot_id', $timeSlotId)
                      ->whereIn('status', ['pending', 'confirmed'])
                      ->first();
    }
}
