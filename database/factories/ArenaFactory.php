<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Arena;
use App\Models\User;

class ArenaFactory extends Factory
{
    protected $model = Arena::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'owner_id' => User::factory(),
        ];
    }
}


