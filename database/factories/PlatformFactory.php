<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    protected $model = Platform::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'slug' => fn (array $attrs) => str($attrs['name'])->slug()->toString(),
            'manufacturer' => fake()->company(),
        ];
    }
}
