<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha_nac = $this->faker->date();
        $edad = Carbon::parse($fecha_nac)->age;

        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'fecha_nac' => $fecha_nac,
            'edad' => $edad,
            'sexo' => $this->faker->randomElement([0, 1, 2]),
            'historial_clinico' => $this->faker->text(150),
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
