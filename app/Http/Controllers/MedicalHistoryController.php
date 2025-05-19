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
        $user = Auth::user();
        $patients = Patient::with(['medicalHistories.doctor.specialty'])->get();


        if ((auth()->user()->hasRole('doctor'))) {
            // Todos los historiales
            $histories = MedicalHistory::with('patient', 'doctor')->get();
        } elseif ((auth()->user()->hasRole('patient'))) {
            // Solo los historiales del paciente logueado
            $patient = $user->patient;
            $histories = MedicalHistory::with('doctor')->where('patient_id', $patient->id)->get();
        } elseif ((auth()->user()->hasRole('admin'))) {
            // Admin ve todos
            $histories = MedicalHistory::with('patient', 'doctor')->get();
        } else {
            abort(403);
        }
        
        return view('admin.medical_histories.index', compact('histories', 'vistaActual', 'patients'));
    }


    /**
     * Mostrar el formulario para crear un nuevo historial.
     */
    public function create()
    {
        $vistaActual = "Crear Historia Médica";
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('admin.medical_histories.create', compact('patients', 'doctors', 'vistaActual'));
    }

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
    public function show($id)
    {
        $history = MedicalHistory::find($id);
        $vistaActual = "Historia Médica de: ". $history->patient->name .' ' .$history->patient->last_name;
        return view ('admin.medical_histories.show', compact('history', 'vistaActual'));
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit($id)
    {
        $history = MedicalHistory::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        $vistaActual = "Historia Médica de: ". $history->patient->name .' ' .$history->patient->last_name;

        return view('admin.medical_histories.edit', compact('history', 'patients', 'doctors', 'vistaActual'));
    }

    /**
     * Actualizar un historial médico.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'symptoms' => 'required|string',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $history = MedicalHistory::findOrFail($id);
        $doctor = Doctor::where('user_id', Auth::id())->first();

        $history->patient_id = $request->patient_id;
        $history->doctor_id = $doctor->id; // actualiza con el doctor actual (opcional si no cambia)
        $history->symptoms = $request->symptoms;
        $history->diagnosis = $request->diagnosis;
        $history->treatment = $request->treatment;
        $history->notes = $request->notes;
        $history->save();

        return redirect()->route('admin.medical_histories.index')
                        ->with('success', 'Historial médico actualizado correctamente.');
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

    /**
     * Imprime historia medica individual en formato PDF
     */
    public function pdfSingle($id)
    {
        $history = MedicalHistory::with(['doctor.specialty', 'patient'])->findOrFail($id);

        // Cargar la vista de impresión de un solo historial
        $pdf = \PDF::loadView('admin.medical_histories.pdf_single', compact('history'));
        
        // Incluir pie de página y numeración
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(450, 800, "Fecha: ". \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0, 0, 0));
        
        return $pdf->stream('Historial_Medico_' . $history->patient->name . '_' . $history->date . '.pdf');
    }

    /**
     * Imprime toda la historia medica del paciente en formato PDF
     */
    public function pdfAll($id)
    {
        $patient = Patient::with(['medicalHistories.doctor.specialty'])->findOrFail($id);

        // Cargar la vista de impresión de todos los historiales
        $pdf = \PDF::loadView('admin.medical_histories.pdf_all', compact('patient'));
        
        // Incluir pie de página y numeración
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(450, 800, "Fecha: ". \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0, 0, 0));
        
        return $pdf->stream('Historiales_Medicos_' . $patient->name . '_' . $patient->last_name . '.pdf');
    }

    
}
