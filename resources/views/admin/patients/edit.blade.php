@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Introduzca los datos del paciente</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.patients.update', $patient->id) }}"  method="POST">
                @csrf
                @method('PUT')
        
                {{-- Nota de campos obligatorios --}}
                <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
        
                <div class="row">
                    {{-- Nombre --}}
                    <div class="col-md-3">
                        <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $patient->name }}" name="name" id="name" class="form-control" required>
                    </div>
        
                    {{-- Apellido --}}
                    <div class="col-md-5">
                        <label for="last_name" class="form-label">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $patient->last_name }}" name="last_name" id="last_name" class="form-control" required>
                    </div>
        
                    {{-- Fecha de nacimiento --}}
                    <div class="col-md-2">
                        <label for="dob" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                        <input type="date" value="{{ $patient->dob }}" name="dob" id="dob" class="form-control" required>
                    </div>
        
                    {{-- DNI --}}
                    <div class="col-md-2">
                        <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('dni', $patient->dni) }}" name="dni" id="dni" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @error('dni')
                            <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                <span class="ms-1">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="row">
                    {{-- Género --}}
                    <div class="col-md-2">
                        <label for="sex" class="form-label">Sexo <span class="text-danger">*</span></label>
                        <select name="sex" id="sex" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="Hombre" {{ $patient->sex == 'hombre' ? 'selected' : '' }}>Hombre</option>
                            <option value="Mujer" {{ $patient->sex == 'mujer' ? 'selected' : '' }}>Mujer</option>
                        </select>
                    </div>
        
                    {{-- Dirección --}}
                    <div class="col-md-8">
                        <label for="address" class="form-label">Dirección <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $patient->address }}" name="address" id="address" class="form-control" required>
                    </div>
        
                    {{-- Código postal --}}
                    <div class="col-md-2">
                        <label for="postal_code" class="form-label">Código Postal <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $patient->postal_code }}" name="postal_code" id="postal_code" class="form-control" required>
                    </div>
                </div>
                <br>

                <div class="row">
                    {{-- Teléfono --}}
                    <div class="col-md-2">
                        <label for="phone" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $patient->phone }}" name="phone" id="phone" class="form-control" required>  
                    </div>

                    {{-- Teléfono de emergencia --}}
                    <div class="col-md-2">
                        <label for="phone_emergence" class="form-label">Tlfn de Emergencia</label>
                        <input type="text" value="{{ $patient->phone_emergence }}" name="phone_emergence" id="phone_emergence" class="form-control">
                    </div>
        
                    {{-- Correo Electrónico --}}
                    <div class="col-md-5">
                        <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="email" value="{{ old('email', $patient->email) }}" name="email" id="email" class="form-control" required>
                    </div>
                    {{-- Tipo de Sangre --}}
                    <div class="col-md-3">
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @error('email')
                            <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                <span class="ms-1">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <br>
                <div class="row">
                    {{-- Número de Tarjeta de Salud --}}
                    <div class="col-md-3">
                        <label for="health_card_number" class="form-label">Nº Tarjeta Sanitaria</label>
                        <input type="text" value="{{ old('health_card_number', $patient->health_card_number) }}" name="health_card_number" id="health_card_number" class="form-control">
                    </div>
        
                    {{-- Aseguradora Médica --}}
                    <div class="col-md-3">
                        <label for="health_insurance" class="form-label">Aseguradora Médica</label>
                        <input type="text" value="{{ $patient->health_insurance }}" name="health_insurance" id="health_insurance" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
                        @error('health_card_number')
                            <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                <span class="ms-1">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                 </div>

                 <br>
                <div class="row">
                    {{-- Alergias --}}
                    <div class="col-md-4">
                        <label for="allergies" class="form-label">Alergias</label>
                        <textarea name="allergies" id="allergies" class="form-control" rows="2">{{ $patient->allergies }}</textarea>
                    </div>
        
                    {{-- Enfermedades Previas --}}
                    <div class="col-md-4">
                        <label for="previous_illnesses" class="form-label">Enfermedades Previas</label>
                        <textarea name="previous_illnesses" id="previous_illnesses" class="form-control" rows="2">{{ $patient->previous_illnesses }}</textarea>
                    </div>
        
                    {{-- Medicamentos Actuales --}}
                    <div class="col-md-4">
                        <label for="current_medications" class="form-label">Medicamentos Actuales</label>
                        <textarea name="current_medications" id="current_medications" class="form-control" rows="2">{{ $patient->current_medications }}</textarea>
                    </div>
                </div>
        
                <br>
                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver atrás
                    </a>
                
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Actualizar Paciente
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