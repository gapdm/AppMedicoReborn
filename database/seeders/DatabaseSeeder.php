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
            'nombre' => 'Administrador',
            'apellido' => 'Admin',
            'email' => 'admin@admin.com',
            'telefono' => '1234567890',
            'sexo' => 0,
            'rol' => 2,
            'password' => Hash::make('password123'),
            'especialidad' => 'Cardiología',
            'cedula' => '1234567890',
        ]);

        User::factory()->create([
            'nombre' => 'Dr',
            'apellido' => 'Medico',
            'email' => 'medico@example.com',
            'telefono' => '1234567890',
            'sexo' => 0,
            'rol' => 1,
            'password' => Hash::make('m3dicoChid0'),
            'especialidad' => 'Cardiología',
            'cedula' => '1234567891',
        ]);

        User::factory()->create([
            'nombre' => 'Secretaria',
            'apellido' => 'Secretos',
            'email' => 'secretaria@example.com',
            'telefono' => '1234567890',
            'sexo' => 0,
            'rol' => 0,
            'password' => Hash::make('contraseña1234'),
        ]);

        User::factory()->count(10)->create();
        Paciente::factory()->count(10)->create();
    }
}
