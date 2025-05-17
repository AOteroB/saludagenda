@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-info mb-1"><i class="fas fa-user-circle me-2" style="margin-right: 5px"></i>Detalles del Usuario</h2>
            <p class="text-secondary mb-0">Información básica del usuario registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card p-4 border border-info">

                <h5 class="text-black mb-4"><i class="fas fa-address-card me-2" style="margin-right: 5px"></i>Información Personal</h5>

                @php
                    $fields = [
                        'Nombre Completo' => $user->name,
                        'Correo Electrónico' => $user->email,
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

                <div class="row mb-4">
                    <div class="col-4 text-dark fw-semibold">
                        Rol:
                    </div>
                    <div class="col-8">
                        @foreach ($user->getRoleNames() as $role)
                            @php
                                $badgeClass = match($role) {
                                    'admin' => 'bg-danger',
                                    'doctor' => 'bg-primary',
                                    'patient' => 'bg-success',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} text-white">{{ ucfirst($role) }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning text-dark">
                        <i class="fas fa-edit me-1"></i> Editar Usuario
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
        background: rgba(255, 255, 255, 0.05);
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

    .btn-outline-secondary{
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000; 
    }

    .btn-outline-secondary:hover{
        color: #ffffff !important;
        background-color: #000000;
        border-color: #8c8989; 
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #ec971f;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
        border-radius: 0.35rem;
    }
</style>
@endpush
