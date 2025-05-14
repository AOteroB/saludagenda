<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dob' => $this->faker->date('Y-m-d', $max='now'),
            'dni' => $this->faker->unique()->regexify('[0-9]{8}[A-Z]'),
            'sex' => $this->faker->randomElement(['Hombre', 'Mujer']),
            'address' => $this->faker->address,
            'postal_code' => $this->faker->numerify('#####'),
            'phone' => $this->faker->numerify('+34#########'),
            'phone_emergence' => $this->faker->optional()->numerify('+34#########'),
            'email' => $this->faker->unique()->safeEmail,
            'health_card_number' => $this->faker->unique()->numerify('###########'),
            'health_insurance' => $this->faker->optional()->company,
            'allergies' => $this->faker->optional()->words(3,true),
            'previous_illnesses' => $this->faker->optional()->words(2,true),
            'current_medications' => $this->faker->optional()->text(150),
            'medical_notes' => $this->faker->optional()->text(300),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        ];
    }
}
