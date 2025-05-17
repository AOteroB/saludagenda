@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-info mb-1">
                <i class="bi bi-heart-pulse me-2" style="margin-right: 5px"></i>Detalles de la Especialidad
            </h2>
            <p class="text-secondary mb-0">Información básica de la especialidad registrada en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card p-4 border border-info">

                <h4 class="text-black mb-4">
                    <i class="fas fa-address-card me-2" style="margin-right: 5px"></i>Información General
                </h4>

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
                        <div class="col-4 text-dark fw-semibold">
                            {{ $label }}:
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                                {{ $value }}
                            </p>
                        </div>
                    </div>
                @endforeach

                {{-- Estado --}}
                <div class="row mb-3">
                    <div class="col-4 text-dark fw-semibold">
                        Estado:
                    </div>
                    <div class="col-8">
                        <p class="form-control-plaintext">
                            <span class="badge {{ $specialty->status === 'activa' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($specialty->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                {{-- Horarios disponibles --}}
                <div class="row mb-4">
                    <div class="col-4 text-dark fw-semibold">
                        Horarios Disponibles:
                    </div>
                    <div class="col-8">
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-sm btn-info" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver atrás
                    </a>
                    <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-warning text-dark">
                        <i class="fas fa-edit me-1"></i> Editar Especialidad
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

    .btn-warning {
        color: #1a1a1a !important;
        background-color: #ffd151;
        border-color: #f0ad4e;
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

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #ec971f;
    }

    .btn-info{
        background-color: #0dcaf0;
        color: white;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
        border-radius: 0.35rem;
    }
</style>
@endpush
