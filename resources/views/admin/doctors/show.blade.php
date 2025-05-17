@extends('layouts.admin')

@section('content')

@php $vistaActual = 'doctor_show'; @endphp

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-info mb-1"><i class="fas fa-user-md me-2" style="margin-right: 5px"></i>Detalles del Doctor</h2>
            <p class="text-secondary mb-0">Información básica del doctor registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card p-4 border border-info">

                <h4 class="text-black mb-4"><i class="fas fa-address-card me-2" style="margin-right: 5px"></i>Información del Doctor</h4>

                @php
                    $fields = [
                        'Nombre y Apellidos' => $doctor->name . ' ' . $doctor->last_name,
                        'Teléfono' => $doctor->phone,
                        'Correo Electrónico' => $doctor->user->email,
                        'Nº Colegiación' => $doctor->license_number,
                        'Especialidad' => $doctor->specialty->name,
                    ];
                @endphp

                @foreach($fields as $label => $value)
                    <div class="row mb-3">
                        <div class="col-4 text-dark fw-semibold">
                            {{ $label }}:
                        </div>
                        <div class="col-8">
                            <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">{{ $value }}</p>
                        </div>
                    </div>
                @endforeach

                {{-- Estado --}}
                <div class="row mb-4">
                    <div class="col-4 text-dark fw-semibold">
                        Estado:
                    </div>
                    <div class="col-8">
                        @if($doctor->status === 'activo')
                            <span class="badge bg-success text-white">Activo</span>
                        @else
                            <span class="badge bg-secondary text-white">Inactivo</span>
                        @endif
                    </div>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver al listado
                    </a>
                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-warning text-dark">
                        <i class="fas fa-edit me-1"></i> Editar Doctor
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
