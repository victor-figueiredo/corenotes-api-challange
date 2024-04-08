<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(3),
            'isFavorite' => $this->faker->boolean()
        ];
    }
}
