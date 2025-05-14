@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-primary" style="color: #17A2B8 !important">
                <i class="bi bi-heart-pulse"></i> Detalles de la Especialidad</h2>
            <p class="text-muted">Información básica de la especialidad registrada en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header text-white" style="background-color: #17A2B8 !important">
                    <h5 class="mb-0"><i class="fas fa-address-card"></i> Información de la Especialidad</h5>
                </div>

                <div class="card-body">
                    {{-- Campos simples --}}
                    @php
                        $fields = [
                            'Nombre' => $specialty->name,
                            'Teléfono' => $specialty->phone ?? 'No especificado',
                            'Ubicación' => $specialty->location ?? 'No especificada',
                            'Descripción' => $specialty->description ?? 'No especificada',
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

                    {{-- Estado con badge --}}
                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Estado:</strong>
                        </div>
                        <div class="col-8">
                            @if($specialty->status === 'activa')
                                <p class="form-control-plaintext"><span class="badge bg-success">Activa</span></p>
                            @else
                                <p class="form-control-plaintext"><span class="badge bg-secondary">Inactiva</span></p>
                            @endif
                        </div>
                    </div>

                    {{-- Horarios Disponibles con botón --}}
                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Horarios Disponibles:</strong>
                        </div>
                        <div class="col-8">
                            <a href="{{ route('admin.schedules.index') }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Botones --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver atrás
                        </a>
                        <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-warning text-white">
                            <i class="fas fa-edit me-1"></i> Editar Especialidad
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
