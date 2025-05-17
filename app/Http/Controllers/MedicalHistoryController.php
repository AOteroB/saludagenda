<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
{
    /**
     * Mostrar todos los historiales médicos.
     */
    public function index()
    {
        $vistaActual = "Historiales Clínicos";
        $histories = MedicalHistory::with('patient', 'doctor')->get();
        return view('admin.medical_histories.index', compact('histories', 'vistaActual'));
    }

    /**
     * Mostrar el formulario para crear un nuevo historial.
     */
    public function create()
    {
        $vistaActual = "Historiales Clínicos";
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.medical_histories.create', compact('patients', 'doctors', 'vistaActual'));
    }

    /**
     * Guardar un nuevo historial médico.
     */
    /**
     * Guardar un nuevo historial médico.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'symptoms' => 'required|string',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);
    $doctor = Doctor::where('user_id', Auth::id())->first();
        $history = new MedicalHistory();
        $history->patient_id = $request->patient_id;
        $history->doctor_id = $doctor->id;  // asignar el doctor correcto
        $history->date = Carbon::today()->toDateString();  // Fecha actual sin pedir al usuario
        $history->symptoms = $request->symptoms;
        $history->diagnosis = $request->diagnosis;
        $history->treatment = $request->treatment;
        $history->notes = $request->notes;
        $history->save();

        return redirect()->route('admin.medical_histories.index')
                         ->with('success', 'Historial médico creado correctamente.');
    }
   
    /**
     * Mostrar un historial médico específico.
     */
    public function show(MedicalHistory $medicalHistory)
    {
        return view('admin.medical_histories.show', [
            'history' => $medicalHistory,
            'vistaActual' => 'Historial Médico'
        ]);
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(MedicalHistory $medicalHistory)
    {
        $patients = Patient::all();
        return view('admin.medical_histories.edit', compact('medicalHistory', 'patients'));
    }

    /**
     * Actualizar un historial médico.
     */
    public function update(Request $request, MedicalHistory $medicalHistory)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string|max:255',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $medicalHistory->update([
            'patient_id' => $request->patient_id,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'notes' => $request->notes,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.medical_histories.index')->with('success', 'Historial actualizado correctamente.');
    }

    /**
     * Eliminar un historial médico.
     */
    public function destroy(MedicalHistory $medicalHistory)
    {
        $medicalHistory->delete();

        return redirect()->route('admin.medical_histories.index')
        ->with('message', 'Historial médico eliminado correctamente del sistema.')
        ->with('icon', 'success');
    }
    
}
