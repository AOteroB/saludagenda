<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Support\Facades\Hash;

class DoctorsTableSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            'Medicina General' => 2,
            'Pediatría' => 2,
            'Cardiología' => 2,
            'Dermatología' => 2,
            'Oftalmología' => 2,
            'Traumatología y Ortopedia' => 2,
            'Ginecología y Obstetricia' => 1,
            'Oncología' => 1,
            'Neumología' => 1,
        ];

        $licenseCounter = 1000;

        foreach ($specialties as $specialtyName => $count) {
            $specialty = Specialty::where('name', $specialtyName)->first();

            if (!$specialty) {
                $this->command->warn("Especialidad no encontrada: $specialtyName");
                continue;
            }

            for ($i = 1; $i <= $count; $i++) {
                $user = User::create([
                    'name' => "$specialtyName Dr $i",
                    'email' => strtolower(str_replace(' ', '', $specialtyName)) . "_$i@example.com",
                    'password' => Hash::make('Password123'),
                ]);

                $user->assignRole('doctor');

                Doctor::create([
                    'user_id' => $user->id,
                    'name' => "Nombre $i",
                    'last_name' => "Apellido $i",
                    'phone' => '600000000',
                    'email' => $user->email,
                    'license_number' => $licenseCounter++,
                    'status' => 'activo',
                    'specialty_id' => $specialty->id,
                ]);
            }
        }
    }
}
