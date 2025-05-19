@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-info mb-1">
                <i class="fas fa-user-injured me-2" style="margin-right: 5px"></i>Detalles del Paciente
            </h2>
            <p class="text-secondary mb-0">Información detallada del paciente registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card mb-2 border">
                <div class="glass-card-header p-3 text-white">
                    <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                        <h5 class="mb-0">
                            <i class="fas fa-address-card me-2"></i> Información del Paciente
                        </h5>
                    </div>
                </div>
                <div class="glass-card-body p-4">
                    <div class="row">

                        {{-- Datos personales --}}
                        <div class="col-md-6 mb-3">
                            <strong class="text-dark">Nombre y Apellidos:</strong>
                            <p class="form-control-plaintext">{{ $patient->name }} {{ $patient->last_name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong class="text-dark">DNI:</strong>
                            <p class="form-control-plaintext">{{ $patient->dni }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong class="text-dark">Nº Tarjeta Sanitaria:</strong>
                            <p class="form-control-plaintext">{{ $patient->health_card_number ?? 'No especificado' }}</p>
                        </div>

                        {{-- Fecha y edad --}}
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

                        {{-- Contacto --}}
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

                        {{-- Dirección --}}
                        <div class="col-md-10 mb-3">
                            <strong class="text-dark">Dirección:</strong>
                            <p class="form-control-plaintext">{{ $patient->address ?? 'No especificada' }}</p>
                        </div>
                        <div class="col-md-2 mb-3">
                            <strong class="text-dark">Código Postal:</strong>
                            <p class="form-control-plaintext">{{ $patient->postal_code ?? 'No especificado' }}</p>
                        </div>

                        {{-- Salud --}}
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

                    {{-- Botones --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver atrás
                        </a>
                        @can('admin.patients.edit')
                            <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Editar Paciente
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
<!-- Incluir CSS general -->
<link rel="stylesheet" href="{{ url('dist/css/show.css') }}">
@endpush
