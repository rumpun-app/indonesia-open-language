<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Dialect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dialect>
 */
class DialectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['language_id' => Language::factory(), 'slug' => fake()->unique()->slug(), 'name' => fake()->city().' Dialect', 'native_name' => fake()->word(), 'description' => fake()->sentence(), 'status' => 'published'];
    }
}
