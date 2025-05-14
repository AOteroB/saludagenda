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
    /*
    |--------------------------------------------------------------------------
    | Controlador de Registro
    |--------------------------------------------------------------------------
    |
    | Este controlador gestiona el registro de nuevos usuarios, así como
    | su validación y creación. Por defecto, este controlador usa un trait
    | que proporciona esta funcionalidad sin requerir código adicional.
    |
    */

    use RegistersUsers;

    /**
     * Ruta a la que se redirige después del registro.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
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
        return Validator::make($data, [
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
            // Otros campos opcionales para paciente, como los de contacto
            'address' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'size:5'],
            'phone' => ['nullable', 'string', 'max:15'],
            'phone_emergence' => ['nullable', 'string', 'max:15'],
            // Más validaciones si es necesario
        ]);
    }
    
    

    /**
     * Crear nuevo usuario y asociar o crear ficha de paciente
     *
     * @param  array  $data
     * @return \App\Models\User
     */
     public function create(array $data)
{
    // Buscar paciente existente por DNI (si se proporcionó) o email
    $existingPatient = null;

    if (!empty($data['dni'])) {
        $existingPatient = Patient::where('dni', $data['dni'])->first();
    }

    if (!$existingPatient) {
        $existingPatient = Patient::where('email', $data['email'])->first();
    }

    // Crear paciente si no existe
    if (!$existingPatient) {
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


    // Crear usuario asociado a paciente
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
