<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use App\Models\Specialty;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vistaActual = 'Listado de Doctores';
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors.index', compact('doctors', 'vistaActual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vistaActual = 'Creación de Médicos';
        $doctors = Doctor::all();
        $specialties = Specialty::all(); 
    
        return view('admin.doctors.create', compact('vistaActual', 'doctors', 'specialties')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
            'phone' => 'required',
            'license_number' => 'required|string|unique:doctors',
            'specialty_id' => 'required|exists:specialties,id',
            'status' => 'required|in:activo,inactivo',
            'email' => 'required|max:250|unique:users',
            'password' => [
                'required',
                'max:250',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'confirmed'
            ],
        ],[
            'license_number' => 'Ya existe un doctor con este número de colegiado.',
            'email.unique' => 'Ya existe un usuario registrado con este email.',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.',
        ]);

        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->save();
        // Asignar el rol de "medico" automáticamente
        $user->assignRole('doctor'); 
     
        $doctor = New Doctor();
        $doctor->user_id = $user->id;
        $doctor->name = $request->name;
        $doctor->last_name = $request->last_name;
        $doctor->phone = $request->phone;
        $doctor->license_number = $request->license_number;
        $doctor->specialty_id = $request->specialty_id;
        $doctor->status = $request->status;

        $doctor->save();
        
        return redirect()->route('admin.doctors.index')
            ->with('message', 'Doctor registrado correctamente en el sistema.')
            ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        $vistaActual = 'Doctor: ' . $doctor->name.' ' .$doctor->last_name;
        return view('admin.doctors.show', compact('doctor', 'vistaActual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialties = Specialty::all(); // Aquí recuperas las especialidades
        $vistaActual = 'Actualizar Doctor: ' . $doctor->name.' ' .$doctor->last_name;
        return view('admin.doctors.edit', compact('doctor', 'vistaActual', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra al doctor por su ID
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user; // Accede al usuario relacionado con el doctor

        // Valida los datos
        $request->validate([
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
            'phone' => 'required',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'specialty_id' => 'required|exists:specialties,id',
            'status' => 'required|in:activo,inactivo',
            'email' => 'required|max:250|unique:users,email,' . $doctor->user->id,
            'password' => [
                'nullable', // La contraseña es opcional al actualizar
                'max:250',
                'regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'confirmed'
            ], 
        ],[
            'license_number.unique' => 'Ya existe un doctor con este número de colegiado.',
            'email.unique' => 'Ya existe un usuario registrado con este email.',
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.',
        ]);

        // Actualizar los datos del usuario (sin cambiar la contraseña si no se ha ingresado una nueva)
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            // Si se ha proporcionado una nueva contraseña, la actualizamos
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Actualizar los datos del doctor
        $doctor->name = $request->name;
        $doctor->last_name = $request->last_name;
        $doctor->phone = $request->phone;
        $doctor->license_number = $request->license_number;
        $doctor->specialty_id = $request->specialty_id;
        $doctor->status = $request->status;
        $doctor->save();

        return redirect()->route('admin.doctors.index')
            ->with('message', 'Doctor actualizado correctamente en el sistema.')
            ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Eliminar al user asociado
        $doctor->user->delete();

        //Eliminar al doctor
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
        ->with('message', 'Doctor eliminado correctamente del sistema.')
        ->with('icon', 'success');
    }

    // Funcion para editar ficha médica del paciente
    public function editPatient($user_id)
    {
        // Buscamos al usuario con el ID
        $user = User::findOrFail($user_id);

        // Obtenemos el perfil de paciente asociado al usuario
        $patient = $user->patient; 

        $vistaActual = 'Editar Ficha Médica';

        return view('doctor.edit-patient', compact('user', 'patient', 'vistaActual'));
    }

    public function updatePatient(Request $request, $user_id)
    {
        // Buscar al usuario
        $user = User::findOrFail($user_id);
        
        // Verificar si el paciente está asociado al usuario
        $patient = $user->patient; 

        if (!$patient) {
            return redirect()->route('doctor.edit.patient', $user_id)
                ->with('error', 'No se encontró el perfil del paciente.');
        }

        // Validar los datos del formulario
        $validated = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-', 
            'allergies' => 'nullable|string|max:500',
            'previous_illnesses' => 'nullable|string|max:500',
            'current_medications' => 'nullable|string|max:500',
            'medical_notes' => 'nullable|string|max:500',
        ]);

        // Actualizar los datos del paciente si existe
        $patient->update($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.index')
            ->with('message', 'Datos del paciente actualizados correctamente')
            ->with('icon', 'success');
    }

    public function pdf()
    {
        $doctors = Doctor::all();
        $specialties = Specialty::all(); // Aquí recuperas las especialidades
        $pdf = \PDF::loadView('admin.doctors.pdf', compact('doctors'));

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
