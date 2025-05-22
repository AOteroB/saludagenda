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
        $doctors = Doctor::all();
        $vistaActual = 'Listado de Horarios';
        return view('admin.schedules.index', compact ('schedules', 'vistaActual', 'specialties', 'doctors'));
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
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required|integer|min:1|max:7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'end_time.after' => 'La hora de fin debe ser mayor que la de inicio.',
        ]);

        // Obtener los ids de todos los doctores de la especialidad seleccionada
        $doctorIdsOfSpecialty = Doctor::where('specialty_id', $request->specialty_id)->pluck('id');

        // Buscar conflictos con cualquiera de esos doctores
        $conflictingSchedule = Schedule::whereIn('doctor_id', $doctorIdsOfSpecialty)
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
            ->first();

        if ($conflictingSchedule) {
            $occupiedTime = $conflictingSchedule->start_time . ' - ' . $conflictingSchedule->end_time;
            $occupiedDoctor = 'Dr. ' . $conflictingSchedule->doctor->name . ' ' . $conflictingSchedule->doctor->last_name;

            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'start_time' => "El horario seleccionado ya está ocupado por $occupiedDoctor ($occupiedTime) en la especialidad seleccionada. Por favor, elige un horario diferente."
                ]);
        }

        // Crear horario si no hay conflictos
        Schedule::create([
            'doctor_id' => $request->doctor_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('message', 'Horarios añadidos correctamente.')
            ->with('icon', 'success');
    }
 
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $vistaActual = 'Horarios de Doctores';

        // Todos los horarios (no filtramos los schedules aún, ya que los usamos por relación con doctores)
        $schedules = Schedule::with('doctor.specialty')->get();
        $specialties = Specialty::all();

        // Si el usuario es doctor, solo mostramos doctores de su especialidad
        if ($user->hasRole('doctor')) {
            $specialtyId = $user->doctor->specialty_id;

            // Solo doctores que tienen la misma especialidad que el doctor autenticado
            $doctors = Doctor::with('schedules', 'specialty')
                ->where('specialty_id', $specialtyId)
                ->get();
        } else {
            // Admin u otros roles ven todo
            $doctors = Doctor::with('schedules', 'specialty')->get();
        }

        return view('admin.schedules.show', compact(
            'schedules',
            'vistaActual',
            'specialties',
            'doctors'
        ));
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
