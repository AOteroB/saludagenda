<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run()
    {
        $specialties = [
            [
                'name' => 'Medicina General',
                'description' => 'Primera línea de atención. Para chequeos, enfermedades comunes, seguimientos.',
                'phone' => '600111222',
                'location' => 'Edificio A - Planta 2',
                'status' => 'activa',
            ],
            [
                'name' => 'Pediatría',
                'description' => 'Atención médica infantil.',
                'phone' => '600333444',
                'location' => 'Edificio B - Planta Baja',
                'status' => 'activa',
            ],
            [
                'name' => 'Ginecología y Obstetricia',
                'description' => 'Revisiones, embarazos, control hormonal, etc.',
                'phone' => '600555666',
                'location' => 'Edificio C - Planta 3',
                'status' => 'activa',
            ],
            [
                'name' => 'Cardiología',
                'description' => 'Enfermedades del corazón y vasos sanguíneos.',
                'phone' => '600777888',
                'location' => 'Edificio D - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Dermatología',
                'description' => 'Problemas de piel, uñas, cabello, lunares, etc.',
                'phone' => '600999000',
                'location' => 'Edificio E - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Oftalmología',
                'description' => 'Salud visual, exámenes de la vista, tratamiento ocular.',
                'phone' => '600222333',
                'location' => 'Edificio F - Planta 4',
                'status' => 'activa',
            ],
            [
                'name' => 'Otorrinolaringología (ORL)',
                'description' => 'Oídos, nariz y garganta.',
                'phone' => '600444555',
                'location' => 'Edificio G - Planta 2',
                'status' => 'activa',
            ],
            [
                'name' => 'Traumatología y Ortopedia',
                'description' => 'Lesiones óseas, musculares, articulares.',
                'phone' => '600666777',
                'location' => 'Edificio H - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Psiquiatría y Psicología',
                'description' => 'Salud mental, terapias, tratamiento de trastornos.',
                'phone' => '600888999',
                'location' => 'Edificio I - Planta 3',
                'status' => 'inactiva',
            ],
            [
                'name' => 'Endocrinología',
                'description' => 'Hormonas, tiroides, diabetes, obesidad.',
                'phone' => '600111444',
                'location' => 'Edificio J - Planta 2',
                'status' => 'activa',
            ],
            [
                'name' => 'Neurología',
                'description' => 'Sistema nervioso, dolores de cabeza, epilepsia, etc.',
                'phone' => '600333555',
                'location' => 'Edificio K - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Urología',
                'description' => 'Sistema urinario masculino y femenino, próstata.',
                'phone' => '600555777',
                'location' => 'Edificio L - Planta 4',
                'status' => 'activa',
            ],
            [
                'name' => 'Gastroenterología',
                'description' => 'Tracto digestivo, hígado, colonoscopias.',
                'phone' => '600777999',
                'location' => 'Edificio M - Planta 2',
                'status' => 'inactiva',
            ],
            [
                'name' => 'Reumatología',
                'description' => 'Enfermedades articulares, autoinmunes, artritis.',
                'phone' => '600999333',
                'location' => 'Edificio N - Planta 3',
                'status' => 'inactiva',
            ],
            [
                'name' => 'Alergología',
                'description' => 'Diagnóstico y tratamiento de alergias.',
                'phone' => '600222666',
                'location' => 'Edificio O - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Neumología',
                'description' => 'Pulmones, asma, apnea del sueño, EPOC.',
                'phone' => '600444888',
                'location' => 'Edificio P - Planta 4',
                'status' => 'activa',
            ],
            [
                'name' => 'Hematología',
                'description' => 'Enfermedades de la sangre, anemias, leucemias.',
                'phone' => '600666999',
                'location' => 'Edificio Q - Planta 2',
                'status' => 'activa',
            ],
            [
                'name' => 'Oncología',
                'description' => 'Cáncer y tratamiento oncológico.',
                'phone' => '600888111',
                'location' => 'Edificio R - Planta 3',
                'status' => 'activa',
            ],
            [
                'name' => 'Nefrología',
                'description' => 'Enfermedades renales.',
                'phone' => '600999444',
                'location' => 'Edificio S - Planta 1',
                'status' => 'activa',
            ],
            [
                'name' => 'Nutrición y Dietética',
                'description' => 'Planes alimentarios, dietas especiales, control de peso.',
                'phone' => '600111666',
                'location' => 'Edificio T - Planta 2',
                'status' => 'inactiva',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
