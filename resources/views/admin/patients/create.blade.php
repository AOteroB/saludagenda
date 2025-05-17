@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-primary"><i class="fas fa-user-injured me-2" style="margin-right: 5px"></i>Registro de Nuevo Paciente</h2>
            <p class="text-secondary">Complete el siguiente formulario para agregar un nuevo paciente al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card p-4 border border-primary">
                <h5 class="text-black mb-4"><i class="fas fa-id-card-alt me-2" style="margin-right: 5px"></i>Datos del Paciente</h5>

                <form action="{{ route('admin.patients.store') }}" method="POST">
                    @csrf

                    <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Nombre <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control text-dark" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="last_name" class="form-label fw-semibold text-dark">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name" class="form-control text-dark" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="dob" class="form-label fw-semibold text-dark">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" value="{{ old('dob') }}" name="dob" id="dob" class="form-control text-dark" required max="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="dni" class="form-label fw-semibold text-dark">DNI <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('dni') }}" name="dni" id="dni" class="form-control text-dark" required>
                            @error('dni')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="sex" class="form-label fw-semibold text-dark">Sexo <span class="text-danger">*</span></label>
                            <select name="sex" id="sex" class="form-control text-dark" required>
                                <option value="">Seleccione</option>
                                <option value="Hombre" {{ old('sex') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                <option value="Mujer" {{ old('sex') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                            </select>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="address" class="form-label fw-semibold text-dark">Dirección <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('address') }}" name="address" id="address" class="form-control text-dark" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="postal_code" class="form-label fw-semibold text-dark">Código Postal <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('postal_code') }}" name="postal_code" id="postal_code" class="form-control text-dark" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="phone" class="form-label fw-semibold text-dark">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="form-control text-dark" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="phone_emergence" class="form-label fw-semibold text-dark">Tlfn de Emergencia</label>
                            <input type="text" value="{{ old('phone_emergence') }}" name="phone_emergence" id="phone_emergence" class="form-control text-dark">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control text-dark" required>
                            @error('email')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="blood_type" class="form-label fw-semibold text-dark">Tipo de Sangre <span class="text-danger">*</span></label>
                            <select name="blood_type" id="blood_type" class="form-control text-dark" required>
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

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="health_card_number" class="form-label fw-semibold text-dark">Nº Tarjeta Sanitaria</label>
                            <input type="text" value="{{ old('health_card_number') }}" name="health_card_number" id="health_card_number" class="form-control text-dark">
                            @error('health_card_number')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="health_insurance" class="form-label fw-semibold text-dark">Aseguradora Médica</label>
                            <input type="text" value="{{ old('health_insurance') }}" name="health_insurance" id="health_insurance" class="form-control text-dark">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="previous_illnesses" class="form-label fw-semibold text-dark">Enfermedades Previas</label>
                            <textarea name="previous_illnesses" id="previous_illnesses" class="form-control text-dark" rows="2">{{ old('previous_illnesses') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="allergies" class="form-label fw-semibold text-dark">Alergias</label>
                            <textarea name="allergies" id="allergies" class="form-control text-dark" rows="2">{{ old('allergies') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="current_medications" class="form-label fw-semibold text-dark">Medicamentos Actuales</label>
                            <textarea name="current_medications" id="current_medications" class="form-control text-dark" rows="2">{{ old('current_medications') }}</textarea>
                        </div>
                    </div>

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
@endsection

@push('styles')
<style>
    .glass-card {
        background: rgba(3, 105, 217, 0.03);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    }

    .form-control {
        background-color: rgba(248, 249, 250, 0.6);
        border-radius: .375rem;
        color: #212529;
    }

    .form-control:focus {
        border-color: #5892d0;
        box-shadow: 0 0 0 0.2rem rgba(88, 146, 208, 0.25);
    }

    .btn-outline-secondary {
        color: #000 !important;
        background-color: #fff;
        border-color: #000;
    }

    .btn-outline-secondary:hover {
        color: #fff !important;
        background-color: #555555;
        border-color: #8c8989;
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
