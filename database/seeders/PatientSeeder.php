<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear 30 pacientes anónimos (sin cuenta de usuario)
        Patient::factory()->count(30)->create();

        // 2. Crear 20 usuarios con rol 'patient', cada uno con su perfil clínico
        for ($i = 0; $i < 20; $i++) {
            // Verificar si el usuario ya existe para no crear duplicados
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('123456789A'),
            ]);

            // Asignar el rol de paciente
            $user->assignRole('patient');

            // Comprobamos si ya tiene un 'Patient' asociado
            if (!$user->patient()->exists()) {
                // Si no existe un Patient asociado, lo creamos
                $patientData = Patient::factory()->make()->toArray();
                $user->patient()->create($patientData);
            }
        }
    }
}
