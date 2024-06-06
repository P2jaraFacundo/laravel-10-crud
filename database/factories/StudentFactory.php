<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $grupo = ['A', 'B'];
        $year = ['1', '2', '3'];

        return [
            
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date('Y-m-d', '-20 years'),
            'year' => $this->faker->randomElement($year),
            'group' => $this->faker->randomElement($grupo),

        ];
    }
}
