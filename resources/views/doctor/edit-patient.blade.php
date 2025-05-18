@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-left">
            <h2 class="text-success mb-1" style="color: #00b894 !important;">
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
                            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">
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
<style>
    .glass-card {
        background: rgba(252, 252, 252, 0.6);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .glass-card-header {
        background: linear-gradient(135deg, #00b894, #006a4e);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        color: white;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .form-control {
        background-color: rgba(248, 249, 250, 0.6);
        border-radius: .375rem;
        color: #212529;
    }

    .form-control:focus {
        border-color: #58b377;
        box-shadow: 0 0 0 0.2rem rgba(72, 180, 97, 0.25);
    }

    .form-label {
        font-weight: 600;
    }

    .btn-outline-secondary {
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000;
    }

    .btn-outline-secondary:hover {
        color: #ffffff !important;
        background-color: #555555;
        border-color: #8c8989;
    }

    .btn-success {
        background: linear-gradient(135deg, #00b894, #006a4e);
        border-color: #28a745;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-success:hover, .btn-outline-secondary:hover {
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
