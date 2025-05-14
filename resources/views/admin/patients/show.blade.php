@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Datos del Paciente</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            
            <!-- Tabla estilizada -->
            <table class="table table-hover table-bordered shadow-sm rounded">
                <tbody>
                    <tr>
                        <th class="font-weight-bold">Nombre y Apellidos</th>
                        <td>{{ $patient->name }} {{ $patient->last_name }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Fecha de Nacimiento</th>
                        <td>{{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">DNI</th>
                        <td>{{ $patient->dni }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Sexo</th>
                        <td>{{ $patient->sex ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Dirección</th>
                        <td>{{ $patient->address ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Código Postal</th>
                        <td>{{ $patient->postal_code ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Teléfono</th>
                        <td>{{ $patient->phone }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Teléfono de Emergencia</th>
                        <td>{{ $patient->phone_emergence ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Correo Electrónico</th>
                        <td>{{ $patient->email }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Tipo de Sangre</th>
                        <td>{{ $patient->blood_type ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Nº Tarjeta Sanitaria</th>
                        <td>{{ $patient->health_card_number ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Aseguradora Médica</th>
                        <td>{{ $patient->health_insurance ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Alergias</th>
                        <td>{{ $patient->allergies ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Enfermedades Previas</th>
                        <td>{{ $patient->previous_illnesses ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Medicamentos Actuales</th>
                        <td>{{ $patient->current_medications ?? 'No especificados' }}</td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Notas Médicas</th>
                        <td>{{ $patient->medical_notes ?? 'No especificados' }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <!-- Botones -->
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Volver atrás
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <style>
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: 0;
        }

        .card-header {
            background-color: #dbe1ec;
            font-weight: bold;
        }

        .badge {
            font-size: 90%;
        }

        th {
            background-color: #cddef0;
        }

        td{
            background-color: #e9ecef;
        }
    </style>
@endpush

