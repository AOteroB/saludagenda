<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Specialty;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $vistaActual = 'Panel Principal';
        $totalUsers = User::count();
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalSpecialties = Specialty::count();
        $specialties = Specialty::all();
        $doctors = Doctor::with('specialty')->get();
        $specialties = Specialty::all();
        $schedules = Schedule::with('doctor.specialty')->get();
      

        // Verificar el rol del usuario
        if (auth()->user()->hasRole('admin')) {
            $events = Event::all();
            $totalEvents = Event::count();
            return view('admin.index', compact(
                'vistaActual', 'totalUsers', 'totalPatients', 'totalSpecialties', 'totalDoctors', 'totalEvents' ,'events'
            ));
        }

        if (auth()->user()->hasRole('doctor')) {
            // Datos específicos para el doctor
            $doctor = auth()->user()->doctor; 

            // Filtrar solo las citas del doctor
            $totalEvents = Event::where('doctor_id', $doctor->id)->count();
            $events = Event::where('doctor_id', $doctor->id)->get();

            return view('admin.index', compact(
                'vistaActual', 'totalPatients', 'totalDoctors', 'totalSpecialties', 'events', 'totalEvents'
            ));
        }

        if (auth()->user()->hasRole('patient')) {

            $user = auth()->user()->user;

            // Filtrar solo las citas del paciente
            $totalEvents = Event::where('user_id', auth()->id())->count();
            $events = Event::where('user_id', auth()->id())->get();
            
            return view('admin.index', compact(
                'vistaActual', 'specialties', 'totalSpecialties', 'totalDoctors', 'totalEvents', 'events'
            ));
        }

        // En caso de no tener el rol adecuado
        abort(403);
    }

    public function reports()
    {
        $vistaActual = "Informes";
        return view ('admin.reports.index', compact('vistaActual'));
    }
}

