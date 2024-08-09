<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->unique()->randomElement(['media/alpine.webp', 'media/blanket.webp', 'media/cap.webp', 'media/gorra.webp', 'media/gorrablanca.webp', 'media/mouse.webp', 'media/sweater.webp', 'media/tshirt.webp', 'media/red.webp', 'media/grey.webp', 'media/forever.webp', 'media/gorranegra.webp']),
        ];
    }
}
