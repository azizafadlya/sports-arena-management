<?php

namespace App\Repositories;

use App\Models\TimeSlot;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function getAll()
    {
        return TimeSlot::all();
    }

    public function findById(int $id): ?TimeSlot
    {
        return TimeSlot::find($id);
    }

    public function create(array $data): TimeSlot
    {
        return TimeSlot::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return TimeSlot::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return TimeSlot::destroy($id) > 0;
    }

    public function getAvailableSlots(int $arenaId)
    {
        return TimeSlot::where('arena_id', $arenaId)
                        ->where('status', 'available')
                        ->get();
    }
}
