<?php

namespace App\Repositories\Interfaces;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function getAll();
    public function findById(int $id): ?Booking;
    public function create(array $data): Booking;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function findActiveBookingByTimeSlot(int $timeSlotId);
}
