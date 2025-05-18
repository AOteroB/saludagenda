<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['specialty', 'doctor', 'user.patient'])->get();
        $vistaActual = "Listado de Citas Reservadas: ";
        return view('admin.events.index', compact('events', 'vistaActual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
    
        // Obtener la especialidad seleccionada
        $specialty = Specialty::find($request->specialty_id);
    
        // Obtener todos los doctores que atienden esa especialidad
        $doctors = $specialty->doctors;
    
        // Crear objetos Carbon para la fecha y hora seleccionadas
        $selectedDateTime = $request->date . ' ' . $request->time . ':00';
        $start = Carbon::parse($selectedDateTime);                 // Hora de inicio
        $end = $start->copy()->addMinutes(20);                     // Hora de fin (20 min después)
    
        // Convertir al formato compatible con base de datos
        $startFormatted = $start->format('Y-m-d H:i:s');
        $endFormatted = $end->format('Y-m-d H:i:s');
    
        $doctorAssigned = null;
    
        // Iterar sobre los doctores disponibles para encontrar uno libre
        foreach ($doctors as $doctor) {
            // Verificar si el doctor trabaja ese día y hora
            $existingSchedule = $doctor->schedules()
                ->where('day_of_week', $start->dayOfWeekIso)             // 1 (lunes) a 7 (domingo)
                ->whereTime('start_time', '<=', $request->time)
                ->whereTime('end_time', '>', $request->time)
                ->first();
    
            if (!$existingSchedule) continue; // No trabaja ese día/hora
    
            // Verificar que el doctor no tenga ya una cita en ese horario
            $hasConflict = Event::where('doctor_id', $doctor->id)
                ->where(function ($query) use ($startFormatted, $endFormatted) {
                    $query->where('start', '<', $endFormatted)           // La cita existente empieza antes de que termine la nueva
                          ->where('end', '>', $startFormatted);          // y termina después de que empieza la nueva
                })
                ->exists();
    
            if (!$hasConflict) {
                $doctorAssigned = $doctor; // Doctor libre y en turno
                break;
            }
        }
    
        // Si no se encontró doctor libre, se muestra error
        if (!$doctorAssigned) {
            return redirect()->back()->with('error', 'No hay doctores disponibles en este horario. Por favor, elija otro.');
        }
    
        // Crear el evento (cita médica)
        $event = new Event();
        $event->title = $specialty->name;
        $event->start = $startFormatted;
        $event->end = $endFormatted;
        $event->color = 'blue';
        $event->user_id = Auth::user()->id; // Paciente
        $event->doctor_id = $doctorAssigned->id;
        $event->specialty_id = $specialty->id;
        $event->save();
    
        // Redirigir al usuario con mensaje de éxito
        return redirect()->route('admin.index')
            ->with('success', 'Su cita ha sido reservada exitosamente.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $vistaActual = 'Mis Citas Médicas';

        $user = auth()->user();

        if ($user->hasRole('doctor')) {
            $doctor = $user->doctor; // Relación doctor
            $events = Event::with('doctor', 'specialty')
                        ->where('doctor_id', $doctor->id)
                        ->get();
        } elseif ($user->hasRole('patient')) {
            $events = Event::with('doctor', 'specialty')
                        ->where('user_id', $user->id)
                        ->get();
        } else {
            abort(403); // Usuario sin permisos
        }

        return view('admin.events.show', compact('events', 'vistaActual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        //Eliminar la cita
        $event->delete();

        return redirect()->back()
        ->with('message', 'Cita eliminada correctamente del sistema.')
        ->with('icon', 'success');
    }

    // Verificar disponibilidad del doctor
    public function checkAvailability(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
    
        // Obtener la especialidad seleccionada
        $specialty = Specialty::find($request->specialty_id);
    
        // Obtener los doctores asociados a esa especialidad
        $doctors = $specialty->doctors;
    
        // Crear objetos Carbon para la fecha y hora solicitadas
        $selectedDateTime = $request->date . ' ' . $request->time . ':00';
        $start = Carbon::parse($selectedDateTime);
        $end = $start->copy()->addMinutes(20);
    
        // Formato para comparar en la base de datos
        $startFormatted = $start->format('Y-m-d H:i:s');
        $endFormatted = $end->format('Y-m-d H:i:s');
    
        $doctorAvailable = false;
    
        // Iterar sobre los doctores y verificar disponibilidad
        foreach ($doctors as $doctor) {
            // Verificar si el doctor trabaja en ese horario
            $existingSchedule = $doctor->schedules()
                ->where('day_of_week', $start->dayOfWeekIso)
                ->whereTime('start_time', '<=', $request->time)
                ->whereTime('end_time', '>', $request->time)
                ->first();
    
            if (!$existingSchedule) continue; // No trabaja en esa hora
    
            // Verificar que el doctor no tenga otra cita en conflicto
            $hasConflict = Event::where('doctor_id', $doctor->id)
                ->where(function ($query) use ($startFormatted, $endFormatted) {
                    $query->where('start', '<', $endFormatted)
                          ->where('end', '>', $startFormatted);
                })
                ->exists();
    
            if (!$hasConflict) {
                $doctorAvailable = true;
                break; // Al menos un doctor disponible
            }
        }
    
        // Devolver respuesta en JSON para el frontend
        return response()->json([
            'available' => $doctorAvailable,
        ]);
    }

    /**
     * Generar reporte de citas en PDF
     */
    public function pdf()
    {
        $events = Event::all();
        $pdf = \PDF::loadView('admin.events.pdf', compact('events'));
        
        //Incluir pie de página y numeración
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20,800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270,800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450,800, "Fecha: ". \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0,0,0));
        
        return $pdf->stream();
    }

    /**
     * Generar filtrado de citas en PDF
     */
    public function pdf_dates(Request $request)
    {

        $start_date = $request->input('fecha_inicio');
        $end_date = $request->input('fecha_fin');
        $events = Event::whereBetween('start', [$start_date, $end_date])->get();

        $start_date_formatted = \Carbon\Carbon::parse($start_date)->format('d/m/Y');
        $end_date_formatted = \Carbon\Carbon::parse($end_date)->format('d/m/Y');
        $pdf = \PDF::loadView('admin.events.pdf_dates', compact('events', 'start_date_formatted' , 'end_date_formatted'));
        
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
