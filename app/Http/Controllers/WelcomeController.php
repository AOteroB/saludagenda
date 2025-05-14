<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Specialty;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $totalDoctors = Doctor::count();
        $totalSpecialties = Specialty::count();
        $totalUsers = \App\Models\User::count();

        return view('welcome', compact('totalDoctors', 'totalSpecialties', 'totalUsers'));
    }
}
