<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublicPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'region' => $this->faker->sentence(2),
            'location' =>  $this->faker->sentence(2),
            'city' =>  $this->faker->sentence(2),
            'name' => $this->faker->name,
            'active_years' => $this->faker->randomNumber(2),
            'person_type' => $this->faker->randomElement(['NO APLICA', 'PREFERENTE', 'NO PREFERENTE']),
            'job_title' => $this->faker->randomElement(['ACTOR', 'CANTANTE', 'POLITICO', 'OTRO'])
        ];
    }
}
