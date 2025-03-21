<?php

namespace App\Repositories;

use App\Models\Arena;
use App\Repositories\Interfaces\ArenaRepositoryInterface;

class ArenaRepository implements ArenaRepositoryInterface
{
    public function getAll()
    {
        return Arena::all();
    }

    public function findById(int $id): ?Arena
    {
        return Arena::find($id);
    }

    public function create(array $data): Arena
    {
        return Arena::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Arena::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Arena::destroy($id) > 0;
    }
}
