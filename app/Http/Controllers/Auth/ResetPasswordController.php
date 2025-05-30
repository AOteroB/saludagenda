<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */ 
    protected $redirectTo = '/admin';

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect('/admin')->with([
            'message' => 'Contraseña cambiada con éxito',
            'icon' => 'success',
            'title' => '¡Listo!',
            'timer' => 3000
        ]);
    }
}
