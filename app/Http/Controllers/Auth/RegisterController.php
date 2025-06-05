<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
protected $forceCreatePatient = false;
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Obtener un validador para una solicitud de registro entrante.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'max:250',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'confirmed'
            ],
            'dni' => ['nullable', 'string', 'size:9', 'regex:/^([XYZ]?\d{7,8}[A-Z])$/'],
            'dob' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'size:5'],
            'phone' => ['nullable', 'string', 'max:15'],
            'phone_emergence' => ['nullable', 'string', 'max:15'],
        ]);

        // Validación personalizada para coincidencia exacta de dni y email
    if (!empty($data['dni']) && !empty($data['email'])) {
        $patientExists = Patient::where('dni', $data['dni'])
                                ->where('email', $data['email'])
                                ->exists();

        $dniExists = Patient::where('dni', $data['dni'])->exists();
        $emailExists = Patient::where('email', $data['email'])->exists();

        // Si NO existe un paciente exacto
        if (!$patientExists) {

            // Verifica si están los campos obligatorios completos
            $hasRequiredPatientFields = 
                !empty($data['last_name']) &&
                !empty($data['dob']) &&
                !empty($data['sex']) &&
                !empty($data['address']) &&
                !empty($data['postal_code']) &&
                !empty($data['phone']);

            if ($hasRequiredPatientFields) {
                // Añadir reglas para crear el paciente
                $validator->addRules([
                    'last_name' => ['required', 'string', 'max:150'],
                    'dob' => ['required', 'date'],
                    'dni' => ['required', 'string', 'size:9', 'regex:/^([XYZ]?\d{7,8}[A-Z])$/', 'unique:patients,dni'],
                    'sex' => ['required', 'in:hombre,mujer'],
                    'address' => ['required', 'string', 'max:255'],
                    'postal_code' => ['required', 'string', 'size:5'],
                    'phone' => ['required', 'string', 'max:15'],
                    'email' => ['unique:patients,email'],
                ]);
            } else {
                // Mostrar error si no hay paciente y faltan datos obligatorios
                $validator->after(function ($validator) use ($dniExists, $emailExists) {
                    if ($dniExists || $emailExists) {
                        $validator->errors()->add('dni', 'El DNI y el email no coinciden con una ficha de paciente existente.');
                    } else {
                        $validator->errors()->add('dni', 'No existe ficha de paciente previa. Debe completar todos los datos (tlfn de emergenia opcional) para crear una nueva ficha.');
                    }
                });
            }
        }
    }

    $validator->setAttributeNames([
        'dob' => 'fecha de nacimiento',
        'postal_code' => 'código postal',
        'phone' => 'teléfono',
        'phone_emergence' => 'teléfono de emergencia',
        'sex' => 'sexo',
        'address' => 'dirección',
        'dni' => 'DNI',
        'email' => 'email',
        'password' => 'contraseña',
    ]);

    return $validator;
}

    /**
     * Determina si debe crearse un paciente nuevo según datos.
     *
     * @param array $data
     * @return bool
     */
    protected function shouldCreatePatient(array $data)
    {
        if (!empty($data['dni']) && !empty($data['email'])) {
            return !Patient::where('dni', $data['dni'])
                ->where('email', $data['email'])
                ->exists();
        }

        return true; // Si falta alguno, asumimos que no hay coincidencia válida
    }

    /**
     * Crear nuevo usuario y asociar o crear ficha de paciente
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $existingPatient = null;

        if (!empty($data['dni']) && !empty($data['email'])) {
            $existingPatient = Patient::where('dni', $data['dni'])
                ->where('email', $data['email'])
                ->first();
        }

        if (!$existingPatient) {
            // Aquí ya validamos que los campos obligatorios estén presentes
            $existingPatient = Patient::create([
                'name' => $data['name'],
                'last_name' => $data['last_name'] ?? null,
                'dob' => $data['dob'] ?? null,
                'dni' => $data['dni'] ?? null,
                'email' => $data['email'],
                'sex' => $data['sex'] ?? null,
                'address' => $data['address'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'phone' => $data['phone'] ?? null,
                'phone_emergence' => $data['phone_emergence'] ?? null,
            ]);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'patient_id' => $existingPatient->id,
        ]);
        $user->save();
        $user->assignRole('patient');

        session()->flash('success', '¡Usuario registrado correctamente!');

        return $user;
    }
}
