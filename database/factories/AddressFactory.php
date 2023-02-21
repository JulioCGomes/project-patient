<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            "patient_id" => Patient::factory(),
            "cep" => $faker->postcode,
            "address" => explode(',', $faker->address)[1],
            "number" => $faker->randomFloat(2, 12, 150000),
            "complement" => '',
            "neighborhood" => explode(',', $faker->address)[1],
            "city" => $faker->city,
            "state" => $faker->stateAbbr,
        ];
    }
}
