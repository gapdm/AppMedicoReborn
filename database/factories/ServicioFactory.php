<?php
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    protected $model = \App\Models\Servicio::class;

    public function definition()
    {
        return [
            'servicio' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 10, 1000), // Precio entre 10 y 1000 con dos decimales
            'acceso' => $this->faker->numberBetween(0, 2), // 0: Secretaria, 1: Medico, 2: Admin
        ];
    }
}
