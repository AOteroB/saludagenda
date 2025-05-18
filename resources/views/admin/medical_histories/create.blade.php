@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-primary mb-1" style="color: #3a7bd5 !important;">
                <i class="fas fa-user-plus me-2" style="margin-right: 10px"></i>Registro de Nuevo Historial Médico
            </h2>
            <p class="text-secondary mb-0">Complete el siguiente formulario para agregar un nuevo historial médico al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card mb-2 border border-black">

                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card-alt me-2"></i> Datos del Usuario
                    </h5>
                </div>

                <div class="glass-card-body p-4">
                    {{-- Formulario de Registro de Historial --}}
                    <form action="{{ route('admin.medical_histories.store') }}" method="POST">
                        @csrf

                        {{-- Paciente --}}
                        <div class="mb-3">
                            <label for="patient_id" class="form-label fw-semibold text-dark">Paciente</label>
                            <select name="patient_id" id="patient_id" class="form-control bg-light bg-opacity-25 text-dark" required>
                                <option value="">Seleccione un paciente</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Síntomas --}}
                        <div class="mb-3">
                            <label for="symptoms" class="form-label fw-semibold text-dark">Síntomas</label>
                            <textarea name="symptoms" id="symptoms" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('symptoms') }}</textarea>
                        </div>

                        {{-- Diagnóstico --}}
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label fw-semibold text-dark">Diagnóstico</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('diagnosis') }}</textarea>
                        </div>

                        {{-- Tratamiento --}}
                        <div class="mb-3">
                            <label for="treatment" class="form-label fw-semibold text-dark">Tratamiento</label>
                            <textarea name="treatment" id="treatment" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('treatment') }}</textarea>
                        </div>

                        {{-- Notas (opcional) --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold text-dark">Notas Adicionales (opcional)</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control bg-light bg-opacity-25 text-dark">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Registrar Historial
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
        background: linear-gradient(135deg, #6fb1fc, #4364f7);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-success {
        background: linear-gradient(135deg, #6fb1fc, #4364f7);
        border-color: #007bff;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-success:hover,
    .btn-outline-secondary:hover {
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
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
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        color: #ffffff !important;
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
