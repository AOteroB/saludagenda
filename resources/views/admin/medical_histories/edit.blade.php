@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-primary mb-1">
                <i class="fas fa-notes-medical me-2" style="margin-right: 5px"></i>Editar Historial Médico
            </h2>
            <p class="text-secondary mb-0">Modifique los datos del historial médico según sea necesario.</p>
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
                    {{-- Formulario de edición --}}
                    <form action="{{ route('admin.medical_histories.update', $history->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Paciente --}}
                        <div class="mb-3">
                            <label for="patient_id" class="form-label fw-semibold text-dark">Paciente</label>
                            <select name="patient_id" id="patient_id" class="form-control bg-light bg-opacity-25 text-dark" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $patient->id == $history->patient_id ? 'selected' : '' }}>
                                        {{ $patient->name }} {{ $patient->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Síntomas --}}
                        <div class="mb-3">
                            <label for="symptoms" class="form-label fw-semibold text-dark">Síntomas</label>
                            <textarea name="symptoms" id="symptoms" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('symptoms', $history->symptoms) }}</textarea>
                        </div>

                        {{-- Diagnóstico --}}
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label fw-semibold text-dark">Diagnóstico</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('diagnosis', $history->diagnosis) }}</textarea>
                        </div>

                        {{-- Tratamiento --}}
                        <div class="mb-3">
                            <label for="treatment" class="form-label fw-semibold text-dark">Tratamiento</label>
                            <textarea name="treatment" id="treatment" rows="3" class="form-control bg-light bg-opacity-25 text-dark" required>{{ old('treatment', $history->treatment) }}</textarea>
                        </div>

                        {{-- Notas adicionales --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold text-dark">Notas Adicionales</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control bg-light bg-opacity-25 text-dark">{{ old('notes', $history->notes) }}</textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
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

