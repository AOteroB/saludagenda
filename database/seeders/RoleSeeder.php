<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $doctor = Role::firstOrCreate(['name' => 'doctor']);
        $patient = Role::firstOrCreate(['name' => 'patient']);

       

        
        // Crear permisos
        $permissions = [
            // Admin: tendrá todos los permisos
            'admin.index',

            // Permisos de gestión de usuarios
            'admin.user.index', 'admin.user.create', 'admin.user.store', 'admin.user.show',
            'admin.user.edit', 'admin.user.update', 'admin.user.destroy',

            // Permisos de gestión de pacientes
            'admin.patients.index', 'admin.patients.create', 'admin.patients.store', 'admin.patients.show',
            'admin.patients.edit', 'admin.patients.update', 'admin.patients.destroy',

            // Permisos de gestión de especialidades
            'admin.specialties.index', 'admin.specialties.create', 'admin.specialties.store', 'admin.specialties.show',
            'admin.specialties.edit', 'admin.specialties.update', 'admin.specialties.destroy',

            // Permisos de gestión de doctores
            'admin.doctors.index', 'admin.doctors.create', 'admin.doctors.store', 'admin.doctors.show',
            'admin.doctors.edit', 'admin.doctors.update', 'admin.doctors.destroy',

            // Permisos de gestión de horarios
            'admin.schedules.index', 'admin.schedules.create', 'admin.schedules.store', 'admin.schedules.show',
            'admin.schedules.edit', 'admin.schedules.update', 'admin.schedules.destroy',

            // Permisos para citas
            'admin.appointments.index', 'admin.appointments.create', 'admin.appointments.store', 'admin.appointments.show',
            'admin.appointments.edit', 'admin.appointments.update', 'admin.appointments.destroy',

            //Permisos para historiales médicos
            'admin.medical_histories.index', 'admin.medical_histories.create', 'admin.medical_histories.store', 'admin.medical_histories.show',
            'admin.medical_histories.edit', 'admin.medical_histories.update', 'admin.medical_histories.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Asignar todos los permisos al admin
        $adminPermissions = Permission::all();
        $admin->syncPermissions($adminPermissions);

        // Permisos para el doctor
        $doctorPermissions = Permission::whereIn('name', [
            'admin.index',
            'admin.patients.index', 'admin.patients.show', 'admin.patients.edit', 'admin.patients.update',
            'admin.specialties.index', 'admin.specialties.show', 'admin.schedules.index', 'admin.schedules.show',
            'admin.appointments.index', 'admin.appointments.show',
            'admin.medical_histories.index', 'admin.medical_histories.create', 'admin.medical_histories.store', 
            'admin.medical_histories.show', 'admin.medical_histories.edit', 'admin.medical_histories.update', 
            'admin.medical_histories.destroy',
        ])->get();
        $doctor->syncPermissions($doctorPermissions);

        // Permisos para el paciente
        $patientPermissions = Permission::whereIn('name', [
            'admin.index','admin.doctors.index', 
            'admin.specialties.index','admin.specialties.show', 
            'admin.schedules.index', 'admin.schedules.show',
            'admin.appointments.create', 'admin.appointments.show', 'admin.appointments.destroy',
            'admin.medical_histories.show'
            ])->get();
        $patient->syncPermissions($patientPermissions);
    }
}
