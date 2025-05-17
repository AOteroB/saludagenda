@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-user-plus"></i> Registro de Nuevo Historial Médico</h2>
            <p class="text-muted">Complete el siguiente formulario para agregar un nuevo usuario al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="Background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Usuario</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Registro de Historial --}}
                    <form action="{{ route('admin.medical_histories.store') }}" method="POST">
                        @csrf

                        {{-- Paciente --}}
                        <div class="mb-3">
                            <label for="patient_id" class="form-label fw-semibold">Paciente</label>
                            <select name="patient_id" id="patient_id" class="form-control" required>
                                <option value="">Seleccione un paciente</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Síntomas --}}
                        <div class="mb-3">
                            <label for="symptoms" class="form-label fw-semibold">Síntomas</label>
                            <textarea name="symptoms" id="symptoms" rows="3" class="form-control" required>{{ old('symptoms') }}</textarea>
                        </div>

                        {{-- Diagnóstico --}}
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label fw-semibold">Diagnóstico</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control" required>{{ old('diagnosis') }}</textarea>
                        </div>

                        {{-- Tratamiento --}}
                        <div class="mb-3">
                            <label for="treatment" class="form-label fw-semibold">Tratamiento</label>
                            <textarea name="treatment" id="treatment" rows="3" class="form-control" required>{{ old('treatment') }}</textarea>
                        </div>

                        {{-- Notas (opcional) --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Notas Adicionales (opcional)</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-primary">
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
    .form-control {
        background-color: #f9f9f9;
    }
    
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
