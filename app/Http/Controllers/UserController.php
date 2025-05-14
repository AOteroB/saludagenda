<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;    
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function assignRole(Request $request, User $user)
    {
        // Verificar que el admin no intente asignarse el rol de medico
        if ($user->hasRole('admin')) {
            return redirect()->back()->with('error', 'No puedes asignar el rol de médico al administrador.');
        }

        // Asignar el rol de médico al usuario
        $user->assignRole('medico');

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Rol de médico asignado exitosamente.');
    }
    
    public function index ()
    {
        $vistaActual = 'Listado de Usuarios';
        $usuarios = User::all();
        return view ('admin.user.index', compact('vistaActual', 'usuarios')); 
    }

    public function create ()
    {
        $vistaActual = 'Creación de Usuarios';
        $usuarios = User::all();
        return view ('admin.user.create', compact('vistaActual', 'usuarios')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users',
            'password' => [
                'required',
                'max:250',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'confirmed'
            ],
        ], [
            'email.unique' => 'Ya existe un usuario registrado con este email',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.',
        ]);
    
        // Crear el usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Encriptar la contraseña
        $user->save();

        return redirect()->route('admin.user.index') 
            -> with('message','Usuario registrado correctamente en el sistema.')
            -> with('icon','success');
        /* Crear el usuario usando asignación masiva e encriptando la contraseña:
        User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
        ]);*/
    }
    
    public function show ($id)
    {
        $user = User::findOrFail($id);
        $vistaActual = 'Usuario: ' . $user->name;
        return view('admin.user.show', compact('user', 'vistaActual'));
    }

    public function edit ($id)
    {
        $user = User::findOrFail($id);
        $vistaActual = 'Actualizar Usuario: ' . $user->name;
        return view('admin.user.edit', compact('user', 'vistaActual'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validación
        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email|max:250|unique:users,email,' . $user->id,
        ];
    
        // Si se va a cambiar la contraseña, validar también
        if ($request->filled('password')) {
            $rules['password'] = [
                'max:250',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'confirmed'
            ];
        }
    
        $messages = [
            'email.unique' => 'Ya existe un usuario registrado con este email',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.',
        ];
    
        $request->validate($rules, $messages);
    
        // Actualizar datos
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('admin.user.index')
            ->with('message', 'Usuario actualizado correctamente en el sistema.')
            ->with('icon', 'success');
    }

    public function destroy ($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')
        ->with('message', 'El usuario se ha eliminado correctamente del sistema.')
        ->with('icon', 'success');
    }
    
    /**
     * Imprime la lista en formato PDF
     */
    public function pdf()
    {
        $users = User::all();
        $pdf = \PDF::loadView('admin.user.pdf', compact('users'));
        
        //Incluir pie de página y numeración
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20,800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270,800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450,800, "Fecha: ". \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0,0,0));
        
        return $pdf->stream();
    }
}
