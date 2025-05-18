<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección después del login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Sobrescribe el método de login para mostrar mensajes personalizados.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buscar usuario por correo
        $user = User::where('email', $request->email)->first();

        // Si no existe el correo
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['El correo electrónico no está registrado.'],
            ]);
        }

        // Si la contraseña no coincide
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['La contraseña es incorrecta.'],
            ]);
        }

        // Autenticar al usuario
        Auth::login($user, $request->filled('remember'));

        // Redirigir después del login
        return redirect()->intended($this->redirectPath());
    }
}
