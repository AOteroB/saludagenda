<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vistaActual = 'Listado de Pacientes';
        $patients = Patient::all();

        // Calcular la edad de cada paciente
        foreach ($patients as $patient) {
            $dob = Carbon::parse($patient->dob);  // La fecha de nacimiento del paciente
            $patient->age = $dob->age;  // Añadir la edad al paciente
        }
        return view ('admin.patients.index', compact('vistaActual', 'patients')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vistaActual = 'Creación de Pacientes';
        $patients = Patient::all();
        return view ('admin.patients.create', compact('vistaActual', 'patients')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
            'dob' => 'required|date|before_or_equal:today',
            'dni' => 'required|string|size:9|unique:patients',
            'sex' => 'required|in:Hombre,Mujer',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|size:5',
            'phone' => 'required|string|max:15',
            'phone_emergence' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:191|unique:patients',
            'health_card_number' => 'nullable|string|max:20|unique:patients',
            'health_insurance' => 'nullable|string|max:255',
            'allergies' => 'nullable|string',
            'previous_illnesses' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        ], [
            'dni.unique' => 'Ya existe un paciente con este DNI/NIE.',
            'email.unique' => 'Ya existe un paciente registrado con este email.',
            'health_card_number.unique' => 'Ya existe un paciente con este número de tarjeta sanitaria.',
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')
            ->with('message', 'Paciente registrado correctamente en el sistema.')
            ->with('icon', 'success');
}

    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $vistaActual = 'Paciente: ' . $patient->name.' ' .$patient->last_name;
        return view('admin.patients.show', compact('patient', 'vistaActual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $vistaActual = 'Modificar Paciente: ' . $patient->name.' ' .$patient->last_name;
        return view('admin.patients.edit', compact('patient', 'vistaActual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:150',
            'dob' => 'required|date',
            'dni' => [
                        'required',
                        'string',
                        'size:9',
                        'regex:/^([XYZ]?\d{7,8}[A-Z])$/',
                        'unique:patients,dni,' . $patient->id
                    ],
            'sex' => 'required|in:Hombre,Mujer',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|size:5',
            'phone' => 'required|string|max:15',
            'phone_emergence' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:191|unique:patients,email,' . $patient->id,
            'health_card_number' => 'nullable|string|max:20|unique:patients,health_card_number,' . $patient->id,
            'health_insurance' => 'nullable|string|max:255',
            'allergies' => 'nullable|string',
            'previous_illnesses' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'medical_notes' => 'nullable|string',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        ];
    
        $messages = [
            'dni.regex' => 'El DNI o NIE debe tener un formato válido (ej: 12345678Z o X1234567T).',
            'dni.unique' => 'Este DNI o NIE ya está registrado en el sistema.',
            'dni.size' => 'El DNI o NIE debe tener exactamente 9 caracteres.',
            'email.unique' => 'Ya existe un paciente registrado con este email.',
            'health_card_number.unique' => 'Este número de tarjeta sanitaria ya está en uso.',
        ];
    
        $request->validate($rules, $messages);
    
        // Actualizar campos
        $patient->update($request->only([
            'name',
            'last_name',
            'dob',
            'dni',
            'sex',
            'address',
            'postal_code',
            'phone',
            'phone_emergence',
            'email',
            'health_card_number',
            'health_insurance',
            'allergies',
            'previous_illnesses',
            'current_medications',
            'medical_notes',
            'blood_type',
        ]));
    
        return redirect()->route('admin.patients.index')
            ->with('message', 'Paciente actualizado correctamente.')
            ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Patient::destroy($id);
        return redirect()->route('admin.patients.index')
        ->with('message', 'Paciente eliminado correctamente del sistema.')
        ->with('icon', 'success');
    }

    /**
     * Imprime la lista en formato PDF
     */
    public function pdf()
    {
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $dob = Carbon::parse($patient->dob);  // La fecha de nacimiento del paciente
            $patient->age = $dob->age;  // Añadir la edad al paciente
        }
        $pdf = \PDF::loadView('admin.patients.pdf', compact('patients'));

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
