<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word(),
            'lotacao' => $this->faker->numberBetween(5, 35)
        ];
    }
}
