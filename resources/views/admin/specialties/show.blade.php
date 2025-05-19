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
            <div class="glass-card mb-2 border">
                <div class="glass-card-header p-3 text-white">
                    <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                        <h5 class="mb-0">
                            <i class="fas fa-address-card me-2"></i> Información General
                        </h5>
                    </div>
                </div>
                <div class="glass-card-body p-4">

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
                        @can('admin.specialties.edit')
                            <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Editar Especialidad
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
