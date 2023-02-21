<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            "name" => $this->faker->name(),
            "name_mother" => $this->faker->name('female'),
            "date_both" => $this->faker->date('Y-m-d', 'now'),
            "cpf" => $faker->cpf,
            "cns" => rand(1, 1200),
            "image" => 'image/default.png'
        ];
    }
}
