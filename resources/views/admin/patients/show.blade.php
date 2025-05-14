@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-primary" style="color: #17A2B8 !important">
                <i class="fas fa-user-injured"></i> Detalles del Paciente</h2>
            <p class="text-muted">Información detallada del paciente registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header text-white" style="background-color: #17A2B8 !important">
                    <h5 class="mb-0"><i class="fas fa-address-card"></i> Información del Paciente</h5>
                </div>

                <div class="card-body">
                    {{-- Datos en formato "fila" --}}
                    @php
                        $fields = [
                            'Nombre y Apellidos' => $patient->name . ' ' . $patient->last_name,
                            'Fecha de Nacimiento' => \Carbon\Carbon::parse($patient->dob)->format('d/m/Y'),
                            'Edad' => \Carbon\Carbon::parse($patient->dob)->age . ' años',
                            'DNI' => $patient->dni,
                            'Sexo' => $patient->sex ?? 'No especificado',
                            'Dirección' => $patient->address ?? 'No especificada',
                            'Código Postal' => $patient->postal_code ?? 'No especificado',
                            'Teléfono' => $patient->phone,
                            'Teléfono de Emergencia' => $patient->phone_emergence ?? 'No especificado',
                            'Correo Electrónico' => $patient->email,
                            'Tipo de Sangre' => $patient->blood_type ?? 'No especificado',
                            'Nº Tarjeta Sanitaria' => $patient->health_card_number ?? 'No especificado',
                            'Aseguradora Médica' => $patient->health_insurance ?? 'No especificada',
                            'Alergias' => $patient->allergies ?? 'No especificado',
                            'Enfermedades Previas' => $patient->previous_illnesses ?? 'No especificada',
                            'Medicamentos Actuales' => $patient->current_medications ?? 'No especificados',
                            'Notas Médicas' => $patient->medical_notes ?? 'No especificadas',
                        ];
                    @endphp

                    @foreach($fields as $label => $value)
                        <div class="row mb-3">
                            <div class="col-4">
                                <strong>{{ $label }}:</strong>
                            </div>
                            <div class="col-8">
                                <p class="form-control-plaintext">{{ $value }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Botones --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver atrás
                        </a>
                        <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning text-white">
                            <i class="fas fa-edit me-1"></i> Editar Paciente
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .form-control-plaintext {
        padding: .5rem .75rem;
        background-color: #f5f5f5;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        font-size: 1rem;
    }

    .card-header {
        background-color: #d4edda;
        font-weight: bold;
    }

    .btn-warning {
        color: #fff !important;
        background-color: #f0ad4e;
        border-color: #f0ad4e;
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #ec971f;
    }

    .row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .row .col-4 {
        font-weight: bold;
        text-align: left;
        color: #555;
    }

    .row .col-8 {
        text-align: right;
    }
</style>
@endpush
