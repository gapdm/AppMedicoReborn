<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@example.com',
            'telefono' => '1234567890',
            'sexo' => 0,
            'rol' => 2,
            'password' => Hash::make('password123'),
            'especialidad' => 'Cardiología',
            'cedula' => '1234567890',
        ]);

        User::factory()->count(10)->create();
        Paciente::factory()->count(10)->create();
    }
}
