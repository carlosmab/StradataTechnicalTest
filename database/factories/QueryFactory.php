<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QueryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'searched_name' => $this->faker->name(),
            'match_rate' => $this->faker->randomNumber(2),
            'execution_status' => $this->faker->randomElement(['Registros encontrados', 'Sin coincidencias', 'Error del sistema'])
        ];
    }
}
