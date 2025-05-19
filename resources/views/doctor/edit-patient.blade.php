@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-left">
            <h2 class="text-success mb-1">
                <i class="fas fa-notes-medical me-2" style="margin-right: 5px"></i>Datos Médicos del Paciente
            </h2>
            <p class="text-secondary mb-0">Complete o actualice los datos médicos del paciente.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="glass-card mb-2 border border-black">

                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-heartbeat me-2"></i> Información Médica
                    </h5>
                </div>

                <div class="glass-card-body p-4">
                    <form action="{{ route('doctor.update.patient', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        <div class="row mb-3">
                            {{-- Tipo de Sangre --}}
                            <div class="col-md-2">
                                <label for="blood_type" class="form-label fw-semibold text-dark">Tipo de Sangre <span class="text-danger">*</span></label>
                                <select name="blood_type" id="blood_type" class="form-control bg-light bg-opacity-25 text-dark" required>
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
                                <label for="allergies" class="form-label fw-semibold text-dark">Alergias</label>
                                <textarea name="allergies" id="allergies" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ $patient->allergies }}</textarea>
                            </div>

                            {{-- Enfermedades Previas --}}
                            <div class="col-md-5">
                                <label for="previous_illnesses" class="form-label fw-semibold text-dark">Enfermedades Previas</label>
                                <textarea name="previous_illnesses" id="previous_illnesses" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ $patient->previous_illnesses }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- Medicamentos Actuales --}}
                            <div class="col-md-4">
                                <label for="current_medications" class="form-label fw-semibold text-dark">Medicamentos Actuales</label>
                                <textarea name="current_medications" id="current_medications" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ $patient->current_medications }}</textarea>
                            </div>

                            {{-- Observaciones --}}
                            <div class="col-md-8">
                                <label for="medical_notes" class="form-label fw-semibold text-dark">Notas Médicas / Observaciones</label>
                                <textarea name="medical_notes" id="medical_notes" class="form-control bg-light bg-opacity-25 text-dark" rows="2">{{ $patient->medical_notes }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.events.show') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar Información Médica
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
