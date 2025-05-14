@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Datos Médicos del Paciente: </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('doctor.update.patient', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nota de campos obligatorios --}}
                <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                <div class="row">
                    {{-- Tipo de Sangre --}}
                    <div class="col-md-2">
                        <label for="blood_type" class="form-label">Tipo de Sangre <span class="text-danger">*</span></label>
                        <select name="blood_type" id="blood_type" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="A+" {{ $patient->blood_type == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ $patient->blood_type == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ $patient->blood_type == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ $patient->blood_type == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ $patient->blood_type == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ $patient->blood_type == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ $patient->blood_type == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ $patient->blood_type == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>
                
                    {{-- Alergias --}}
                    <div class="col-md-5">
                        <label for="allergies" class="form-label">Alergias</label>
                        <textarea name="allergies" id="allergies" class="form-control" rows="2">{{ $patient->allergies }}</textarea>
                    </div>

                    {{-- Enfermedades Previas --}}
                    <div class="col-md-5">
                        <label for="previous_illnesses" class="form-label">Enfermedades Previas</label>
                        <textarea name="previous_illnesses" id="previous_illnesses" class="form-control" rows="2">{{ $patient->previous_illnesses }}</textarea>
                    </div>
                </div>
                <br>

                <div class="row">
                    {{-- Medicamentos Actuales --}}
                    <div class="col-md-4">
                        <label for="current_medications" class="form-label">Medicamentos Actuales</label>
                        <textarea name="current_medications" id="current_medications" class="form-control" rows="2">{{ $patient->current_medications }}</textarea>
                    </div>

                    {{-- Observaciones --}}
                    <div class="col-md-8">
                        <label for="medical_notes" class="form-label">Notas Médicas / Observaciones</label>
                        <textarea name="medical_notes" id="medical_notes" class="form-control" rows="2">{{ $patient->medical_notes }}</textarea>
                    </div>
                </div>

                <br>
                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver atrás
                    </a>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Actualizar Información Médica
                    </button>
                </div> 
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <style>
        .form-control{
            background-color: #e0e0e0;
        }
        .form-control:focus {
            border-color: #29d34e;
            box-shadow: 0 0 0 0.2rem rgba(5, 227, 105, 0.25);
            outline: 0;
        }
        .alert-danger{
          color: #931824;
          background-color: #f8d7da;
          border-color: #d32535;
        }
        .card-header {
            background-color: #e3fef4;
            font-weight: bold;
        }
    </style>
@endpush
