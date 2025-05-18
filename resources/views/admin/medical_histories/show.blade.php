@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-info mb-1">
                <i class="fas fa-file-medical-alt me-2" style="margin-right: 5px"></i>
                {{ $vistaActual ?? 'Detalles del Historial Médico' }}
            </h2>
            <p class="text-secondary mb-0">Información detallada del historial médico registrado.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card mb-2 border">
                <div class="glass-card-header p-3 text-white">
                    <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                        <h5 class="mb-0">
                            <i class="fas fa-file-medical me-2"></i> Información del Historial Médico
                        </h5>
                    </div>
                </div>
                <div class="glass-card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <strong class="text-dark">Paciente:</strong>
                            <p class="form-control-plaintext">{{ $history->patient->name }} {{ $history->patient->last_name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong class="text-dark">Doctor:</strong>
                            <p class="form-control-plaintext">Dr. {{ $history->doctor->name }} {{ $history->doctor->last_name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong class="text-dark">Área Médica:</strong>
                            <p class="form-control-plaintext">{{ $history->doctor->specialty->name }}</p>
                        </div>
                        <div class="col-md-2 mb-3">
                            <strong class="text-dark">Fecha:</strong>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <div class="row">
                        @foreach([
                            'Síntomas' => $history->symptoms,
                            'Diagnóstico' => $history->diagnosis,
                            'Tratamiento' => $history->treatment,
                            'Notas Adicionales' => $history->notes ?? 'No especificadas'
                        ] as $label => $value)
                            <div class="col-md-6 mb-3">
                                <strong class="text-dark">{{ $label }}:</strong>
                                <div class="form-control-plaintext textarea-plaintext">
                                    {{ $value }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                        @can('admin.medical_histories.edit')
                            <a href="{{ route('admin.medical_histories.edit', $history->id) }}" class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Editar Historial
                            </a>
                        @endcan
                    </div>
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
        background: linear-gradient(135deg, #0dcaf0, #148496);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .form-control-plaintext {
        padding: .5rem .75rem;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        font-size: 1rem;
        color: #212529;
    }

    .text-dark {
        color: #212529 !important;
    }

    .btn-success {
        background: linear-gradient(135deg, #00b894, #006a4e);
        border-color: #28a745;
        color: #fff;
        transition: all 0.3s ease;
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

    .btn-success:hover, .btn-outline-secondary:hover {
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
        border-radius: 0.35rem;
    }
</style>
@endpush
