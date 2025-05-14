@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-primary" style="color: #17A2B8 !important">
                <i class="fas fa-user-md"></i> Detalles del Doctor</h2>
            <p class="text-muted">Información básica del doctor registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="background-color: #17A2B8 !important">
                    <h5 class="mb-0"><i class="fas fa-address-card"></i> Información del Doctor</h5>
                </div>

                <div class="card-body">
                    {{-- Datos del doctor en formato "tabla" --}}
                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Nombre y Apellidos:</strong>
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext">{{ $doctor->name }} {{ $doctor->last_name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Teléfono:</strong>
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext">{{ $doctor->phone }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Correo Electrónico:</strong>
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext">{{ $doctor->user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Nº Colegiación:</strong>
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext">{{ $doctor->license_number }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Especialidad:</strong>
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext">{{ $doctor->specialty->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Estado:</strong>
                        </div>
                        <div class="col-8">
                            @if($doctor->status === 'activo')
                                <p class="form-control-plaintext"><span class="badge bg-success">Activo</span></p>
                            @else
                                <p class="form-control-plaintext"><span class="badge bg-secondary">Inactivo</span></p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver al listado
                        </a>
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-warning text-white">
                            <i class="fas fa-edit me-1"></i> Editar Doctor
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
        background-color: #dbe1ec;
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

    /* Estilo para las filas en formato tabla */
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

    .badge {
        font-size: 90%;
    }
</style>
@endpush
