<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('doctor.specialty')->get();
        $specialties = Specialty::all();
        $vistaActual = 'Listado de Horarios';
        return view('admin.schedules.index', compact ('schedules', 'vistaActual', 'specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();  // Obtener todas las especialidades
        $doctors = Doctor::with('specialty')->get();  // Obtener todos los doctores con sus especialidades
        $schedules = Schedule::with('doctor.specialty')->get();
        $vistaActual = 'Crear Nuevo Horario';
        return view('admin.schedules.create', compact ( 'specialties', 'doctors', 'schedules', 'vistaActual'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'end_time.after' => 'La hora de fin debe ser mayor que la de inicio.',
        ]);
    
        // Verificar si ya existe un horario que se solape con el nuevo horario
        $conflictingSchedule = Schedule::where('doctor_id', $request->doctor_id)
            ->where('day_of_week', $request->day_of_week)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('start_time', '>=', $request->start_time)
                          ->where('start_time', '<', $request->end_time);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('end_time', '>', $request->start_time)
                          ->where('end_time', '<=', $request->end_time);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('start_time', '<', $request->start_time)
                          ->where('end_time', '>', $request->end_time);
                });
            })
            ->first(); // Buscamos el primer horario que coincida (en vez de solo saber si existe)
    
        if ($conflictingSchedule) {
            // Formateamos el horario ya ocupado y obtenemos el nombre del doctor
            $occupiedTime = $conflictingSchedule->start_time . ' - ' . $conflictingSchedule->end_time;
            $occupiedDoctor = 'Dr. ' . $conflictingSchedule->doctor->name . ' ' . $conflictingSchedule->doctor->last_name;
    
            // Retornar con error y mensaje personalizado
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'start_time' => "El horario seleccionado ya está ocupado por $occupiedDoctor ($occupiedTime). Por favor, elige un horario diferente."
                ]);
        }
    
        // Si no hay conflicto, creamos el nuevo horario
        Schedule::create([
            'doctor_id' => $request->doctor_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    
        // Redirigimos a la vista principal con un mensaje de éxito
        return redirect()->route('admin.schedules.index')
            ->with('message', 'Horarios añadidos correctamente.')
            ->with('icon', 'success');
    }    

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminar el horario
        $schedule = Schedule::find($id);
        if ($schedule) {
            $schedule->delete();
        }
    
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.schedules.index')
            ->with('message', 'Horario eliminado correctamente.')
            ->with('icon', 'success');
    }
}
