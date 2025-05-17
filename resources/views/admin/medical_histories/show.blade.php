@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-info mb-1"><i class="fas fa-file-medical me-2" style="margin-right: 5px"></i>
                {{ $vistaActual ?? 'Detalles del Historial Médico' }}
            </h2>
            <p class="text-secondary mb-0">Información detallada del historial médico registrado.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card p-4 border border-info">
                <h4 class="text-black mb-4"><i class="fas fa-stethoscope me-2" style="margin-right: 5px"></i>Datos Médicos</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="fw-semibold text-dark">Paciente:</label>
                        <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                            {{ $history->patient->name }} {{ $history->patient->last_name }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label class="fw-semibold text-dark">Doctor:</label>
                        <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                            Dr. {{ $history->doctor->name }} {{ $history->doctor->last_name }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label class="fw-semibold text-dark">Área Médica:</label>
                        <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                            {{ $history->doctor->specialty->name }}
                        </p>
                    </div>
                    <div class="col-md-2">
                        <label class="fw-semibold text-dark">Fecha:</label>
                        <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                            {{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                {{-- Campos largos en una sola columna --}}
                <div class="row">
                    @foreach([
                        'Síntomas' => $history->symptoms,
                        'Diagnóstico' => $history->diagnosis,
                        'Tratamiento' => $history->treatment,
                        'Notas Adicionales' => $history->notes ?? 'N/A'
                    ] as $label => $value)
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold text-dark">{{ $label }}:</label>
                            <textarea 
                                class="form-control bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2" 
                                rows="4" 
                                readonly
                            >{{ $value }}</textarea>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .glass-card {
        background: rgba(23, 162, 184, 0.03);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
    }

    .form-control-plaintext {
        padding: .5rem .75rem;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        font-size: 1rem;
        color: #212529;
    }

    .row .col-4 {
        font-weight: bold;
        text-align: left;
        color: #212529;
    }

    .row .col-8 {
        text-align: right;
    }

    .btn-outline-secondary {
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000; 
    }

    .btn-outline-secondary:hover {
        color: #ffffff !important;
        background-color: #000000;
        border-color: #8c8989; 
    }
</style>
@endpush
