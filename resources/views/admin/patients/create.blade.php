@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-user-injured"></i> Registro de Nuevo Paciente</h2>
            <p class="text-muted">Complete el siguiente formulario para agregar un nuevo paciente al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="Background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Paciente</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Registro de Paciente --}}
                    <form action="{{ route('admin.patients.store') }}" method="POST">
                        @csrf

                        {{-- Nota de campos obligatorios --}}
                        <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        <div class="row">
                            {{-- Nombre --}}
                            <div class="col-md-3">
                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" required>
                            </div>

                            {{-- Apellidos --}}
                            <div class="col-md-5">
                                <label for="last_name" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name" class="form-control" required>
                            </div>

                            {{-- Fecha de nacimiento --}}
                            <div class="col-md-2">
                                <label for="dob" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                <input type="date" value="{{ old('dob') }}" name="dob" id="dob" class="form-control" required max="{{ date('Y-m-d') }}">
                            </div>

                            {{-- DNI --}}
                            <div class="col-md-2">
                                <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('dni') }}" name="dni" id="dni" class="form-control" required>
                                @error('dni')
                                    <div class="alert alert-danger mt-2 p-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            {{-- Género --}}
                            <div class="col-md-2">
                                <label for="sex" class="form-label">Género <span class="text-danger">*</span></label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="Hombre" {{ old('sex') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="Mujer" {{ old('sex') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                                </select>
                            </div>

                            {{-- Dirección --}}
                            <div class="col-md-8">
                                <label for="address" class="form-label">Dirección <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('address') }}" name="address" id="address" class="form-control" required>
                            </div>

                            {{-- Código postal --}}
                            <div class="col-md-2">
                                <label for="postal_code" class="form-label">Código Postal <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('postal_code') }}" name="postal_code" id="postal_code" class="form-control" required>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            {{-- Teléfono --}}
                            <div class="col-md-2">
                                <label for="phone" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="form-control" required>
                            </div>

                            {{-- Teléfono de emergencia --}}
                            <div class="col-md-2">
                                <label for="phone_emergence" class="form-label">Tlfn de Emergencia</label>
                                <input type="text" value="{{ old('phone_emergence') }}" name="phone_emergence" id="phone_emergence" class="form-control">
                            </div>

                            {{-- Correo Electrónico --}}
                            <div class="col-md-5">
                                <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control" required>
                                @error('email')
                                    <div class="alert alert-danger mt-2 p-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Tipo de Sangre --}}
                            <div class="col-md-3">
                                <label for="blood_type" class="form-label">Tipo de Sangre <span class="text-danger">*</span></label>
                                <select name="blood_type" id="blood_type" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            {{-- Número de Tarjeta de Salud --}}
                            <div class="col-md-3">
                                <label for="health_card_number" class="form-label">Nº Tarjeta Sanitaria</label>
                                <input type="text" value="{{ old('health_card_number') }}" name="health_card_number" id="health_card_number" class="form-control">
                                @error('health_card_number')
                                    <div class="alert alert-danger mt-2 p-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Aseguradora Médica --}}
                            <div class="col-md-3">
                                <label for="health_insurance" class="form-label">Aseguradora Médica</label>
                                <input type="text" value="{{ old('health_insurance') }}" name="health_insurance" id="health_insurance" class="form-control">
                            </div>

                            {{-- Enfermedades Previas --}}
                            <div class="col-md-6">
                                <label for="previous_illnesses" class="form-label">Enfermedades Previas</label>
                                <textarea name="previous_illnesses" id="previous_illnesses" class="form-control" rows="2">{{ old('previous_illnesses') }}</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            {{-- Alergias --}}
                            <div class="col-md-6">
                                <label for="allergies" class="form-label">Alergias</label>
                                <textarea name="allergies" id="allergies" class="form-control" rows="2">{{ old('allergies') }}</textarea>
                            </div>

                            {{-- Medicamentos Actuales --}}
                            <div class="col-md-6">
                                <label for="current_medications" class="form-label">Medicamentos Actuales</label>
                                <textarea name="current_medications" id="current_medications" class="form-control" rows="2">{{ old('current_medications') }}</textarea>
                            </div>
                        </div>

                        <br>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Crear Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .form-control:focus {
            border-color: #5892d0;
            box-shadow: 0 0 0 0.2rem rgba(88, 146, 208, 0.25);
        }

        .card-header {
            background-color: #dbe1ec;
            font-weight: bold;
        }

        .alert-danger {
            color: #931824;
            background-color: #f8d7da;
            border-color: #d32535;
        }
    </style>
@endpush
