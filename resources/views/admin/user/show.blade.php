@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-primary" style="color: #17A2B8 !important"><i class="fas fa-user-circle"></i> Detalles del Usuario</h2>
            <p class="text-muted">Información básica del usuario registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="background-color: #17A2B8 !important">
                    <h5 class="mb-0"><i class="fas fa-address-card"></i> Información Personal</h5>
                </div>

                <div class="card-body">
                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre:</label>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Correo Electrónico:</label>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>

                    {{-- Rol --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rol:</label>
                        <p class="form-control-plaintext text-capitalize"> 
                            @foreach ($user->getRoleNames() as $role)
                                @php
                                    $badgeClass = match($role) {
                                        'admin' => 'bg-danger',
                                        'doctor' => 'bg-primary',
                                        'patient' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver al listado
                        </a>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning text-white">
                            <i class="fas fa-edit me-1"></i> Editar Usuario
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
</style>
@endpush
