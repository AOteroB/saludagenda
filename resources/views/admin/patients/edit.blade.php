@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-success mb-1">
                <i class="fas fa-procedures me-2" style="margin-right: 5px"></i>Editar Paciente
            </h2>
            <p class="text-secondary mb-0">Actualice la información del paciente en el formulario siguiente.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card mb-2 border border-black">
                
                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card-alt me-2"></i> Datos del Paciente
                    </h5>
                </div>

                <div class="glass-card-body p-4">
                    <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        {{-- Fila 1 --}}
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="name" class="form-label fw-semibold text-dark">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="last_name" class="form-label fw-semibold text-dark">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $patient->last_name) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="dob" class="form-label fw-semibold text-dark">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                <input type="date" name="dob" id="dob" value="{{ old('dob', $patient->dob) }}" class="form-control bg-light bg-opacity-25 text-dark" required max="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="dni" class="form-label fw-semibold text-dark">DNI <span class="text-danger">*</span></label>
                                <input type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                                @error('dni')
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Fila 2 --}}
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label for="sex" class="form-label fw-semibold text-dark">Sexo <span class="text-danger">*</span></label>
                                <select name="sex" id="sex" class="form-control bg-light bg-opacity-25 text-dark" required>
                                    <option value="">Seleccione</option>
                                    <option value="Hombre" {{ old('sex', $patient->sex) == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="Mujer" {{ old('sex', $patient->sex) == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                </select>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="address" class="form-label fw-semibold text-dark">Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" value="{{ old('address', $patient->address) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="postal_code" class="form-label fw-semibold text-dark">Código Postal <span class="text-danger">*</span></label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $patient->postal_code) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>
                        </div>

                        {{-- Fila 3 --}}
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label for="phone" class="form-label fw-semibold text-dark">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="phone_emergence" class="form-label fw-semibold text-dark">Tlfn de Emergencia</label>
                                <input type="text" name="phone_emergence" id="phone_emergence" value="{{ old('phone_emergence', $patient->phone_emergence) }}" class="form-control bg-light bg-opacity-25 text-dark">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                                @error('email')
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="blood_type" class="form-label fw-semibold text-dark">Tipo de Sangre <span class="text-danger">*</span></label>
                                <select name="blood_type" id="blood_type" class="form-control bg-light bg-opacity-25 text-dark" required>
                                    <option value="">Seleccione</option>
                                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $type)
                                        <option value="{{ $type }}" {{ old('blood_type', $patient->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Fila 4 --}}
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="health_card_number" class="form-label fw-semibold text-dark">Nº Tarjeta Sanitaria</label>
                                <input type="text" name="health_card_number" id="health_card_number" value="{{ old('health_card_number', $patient->health_card_number) }}" class="form-control bg-light bg-opacity-25 text-dark">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="health_insurance" class="form-label fw-semibold text-dark">Aseguradora Médica</label>
                                <input type="text" name="health_insurance" id="health_insurance" value="{{ old('health_insurance', $patient->health_insurance) }}" class="form-control bg-light bg-opacity-25 text-dark">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="previous_illnesses" class="form-label fw-semibold text-dark">Enfermedades Previas</label>
                                <textarea name="previous_illnesses" id="previous_illnesses" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ old('previous_illnesses', $patient->previous_illnesses) }}</textarea>
                            </div>
                        </div>

                        {{-- Fila 5 --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="allergies" class="form-label fw-semibold text-dark">Alergias</label>
                                <textarea name="allergies" id="allergies" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ old('allergies', $patient->allergies) }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="current_medications" class="form-label fw-semibold text-dark">Medicamentos Actuales</label>
                                <textarea name="current_medications" id="current_medications" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ old('current_medications', $patient->current_medications) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar Paciente
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
    <!-- Incluir CSS general -->
    <link rel="stylesheet" href="{{ url('dist/css/edit.css') }}">
@endpush

