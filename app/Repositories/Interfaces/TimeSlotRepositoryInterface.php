<?php

namespace App\Repositories\Interfaces;

use App\Models\TimeSlot;

interface TimeSlotRepositoryInterface
{
    public function getAll();
    public function findById(int $id): ?TimeSlot;
    public function create(array $data): TimeSlot;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getAvailableSlots(int $arenaId);
}
