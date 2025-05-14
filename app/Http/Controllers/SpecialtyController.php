<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialtyController extends Controller
{
    /**
     * Muestra un listado de todas las especialidades registradas.
     */
    public function index()
    {
        $specialties = Specialty::all(); // Obtener todas las especialidades desde la base de datos
        $vistaActual = 'Listado de Especialidades'; // Título de la vista

        // Retornar la vista con los datos
        return view('admin.specialties.index', compact ('specialties', 'vistaActual')); 
    }

    /**
     * Muestra el formulario para crear una nueva especialidad.
     */
    public function create()
    {
        $vistaActual = 'Creación de Especialidades'; 
        $specialties = Specialty::all();
        return view ('admin.specialties.create', compact('vistaActual', 'specialties')); 
    }

    /**
     * Almacena una nueva especialidad en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos obligatorios
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:activa,inactiva',
        ]);
    
    
        // Ejecutamos la validación
        $validator->validate();
    
        // Crear una nueva especialidad con los datos validados
        $specialty = Specialty::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'status' => $request->status,
            'description' => $request->description,
        ]);
    
        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('admin.specialties.index')
            ->with('message', 'Especialidad creada correctamente en el sistema.')
            ->with('icon', 'success');
    }    

    /**
     * Muestra los detalles de una especialidad específica.
     */
    public function show($id)
    {
        $specialty = Specialty::findOrFail($id); // Buscar la especialidad por ID
        $vistaActual = $specialty->name;
        return view('admin.specialties.show', compact('specialty', 'vistaActual'));
    }

    /**
     * Muestra el formulario para editar una especialidad existente.
     */
    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        $vistaActual = 'Editar: ' .$specialty->name;
        return view('admin.specialties.edit', compact('specialty', 'vistaActual'));
    }

    /**
     * Actualiza una especialidad existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validación de campos obligatorios
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:activa,inactiva',
        ]);
    
        // Ejecutamos la validación
        $validator->validate();
    
        // Buscar la especialidad y actualizar sus datos
        $specialty = Specialty::findOrFail($id);
        $specialty->name = $request->name;
        $specialty->phone = $request->phone;
        $specialty->location = $request->location;
        $specialty->status = $request->status;
        $specialty->description = $request->description;
    
        // Guardamos la especialidad
        $specialty->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.specialties.index')
            ->with('message', 'Especialidad actualizada correctamente en el sistema.')
            ->with('icon', 'success');
    }      

    /**
     * Elimina una especialidad del sistema.
     */
    public function destroy($id)
    {
        Specialty::destroy($id); // Eliminar la especialidad por ID
        return redirect()->route('admin.specialties.index')
        ->with('message', 'Especialidad eliminada correctamente del sistema.')
        ->with('icon', 'success');
    }

    /**
     * Imprime la lista en formato PDF
     */
    public function pdf()
    {
        $specialties = Specialty::all();
        $pdf = \PDF::loadView('admin.specialties.pdf', compact('specialties'));
        
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
