@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-info mb-1"><i class="fas fa-user-injured me-2" style="margin-right: 5px"></i>Detalles del Paciente</h2>
            <p class="text-secondary mb-0">Información detallada del paciente registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card p-4 border border-info">
                <h4 class="text-black mb-4"><i class="fas fa-address-card me-2" style="margin-right: 5px"></i>Información del Paciente</h4>

                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <strong class="text-dark">Nombre y Apellidos:</strong>
                        <p class="form-control-plaintext bg-light bg-opacity-25 text-dark shadow-sm rounded-2 px-3 py-2">{{ $patient->name }} {{ $patient->last_name }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-dark">DNI:</strong>
                        <p class="form-control-plaintext">{{ $patient->dni }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-dark">Nº Tarjeta Sanitaria:</strong>
                        <p class="form-control-plaintext">{{ $patient->health_card_number ?? 'No especificado' }}</p>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                        <strong class="text-dark">Fecha de Nacimiento:</strong>
                        <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-2 mb-3">
                        <strong class="text-dark">Edad:</strong>
                        <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($patient->dob)->age }} años</p>
                    </div>
                    <div class="col-md-2 mb-3">
                        <strong class="text-dark">Sexo:</strong>
                        <p class="form-control-plaintext">{{ $patient->sex ?? 'No especificado' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong class="text-dark">Correo Electrónico:</strong>
                        <p class="form-control-plaintext">{{ $patient->email }}</p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <strong class="text-dark">Teléfono:</strong>
                        <p class="form-control-plaintext">{{ $patient->phone }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-dark">Teléfono de Emergencia:</strong>
                        <p class="form-control-plaintext">{{ $patient->phone_emergence ?? 'No especificado' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong class="text-dark">Aseguradora Médica:</strong>
                        <p class="form-control-plaintext">{{ $patient->health_insurance ?? 'No especificada' }}</p>
                    </div>
                    
                    <div class="col-md-10 mb-3">
                        <strong class="text-dark">Dirección:</strong>
                        <p class="form-control-plaintext">{{ $patient->address ?? 'No especificada' }}</p>
                    </div>
                    <div class="col-md-2 mb-3">
                        <strong class="text-dark">Código Postal:</strong>
                        <p class="form-control-plaintext">{{ $patient->postal_code ?? 'No especificado' }}</p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <strong class="text-dark">Tipo de Sangre:</strong>
                        <p class="form-control-plaintext">{{ $patient->blood_type ?? 'No especificado' }}</p>
                    </div>
                    <div class="col-md-9 mb-3">
                        <strong class="text-dark">Alergias:</strong>
                        <p class="form-control-plaintext">{{ $patient->allergies ?? 'No especificado' }}</p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <strong class="text-dark">Enfermedades Previas:</strong>
                        <p class="form-control-plaintext">{{ $patient->previous_illnesses ?? 'No especificada' }}</p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <strong class="text-dark">Medicamentos Actuales:</strong>
                        <p class="form-control-plaintext">{{ $patient->current_medications ?? 'No especificados' }}</p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <strong class="text-dark">Notas Médicas:</strong>
                        <p class="form-control-plaintext">{{ $patient->medical_notes ?? 'No especificadas' }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver atrás
                    </a>
                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning text-dark">
                        <i class="fas fa-edit me-1"></i> Editar Paciente
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

    .text-dark {
        color: #212529 !important;
    }

    .btn-warning {
        color: #1a1a1a !important;
        background-color: #ffd151;
        border-color: #f0ad4e;
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #ec971f;
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

    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
        border-radius: 0.35rem;
    }
</style>
@endpush
