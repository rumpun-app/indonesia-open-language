<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['slug' => fake()->unique()->slug(), 'name' => fake()->unique()->city().' Language', 'native_name' => fake()->word(), 'iso_code' => null, 'description' => fake()->sentence(), 'status' => 'published', 'metadata' => []];
    }
}
