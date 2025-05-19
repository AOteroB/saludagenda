@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-info mb-1">
                <i class="fas fa-user-circle me-2" style="margin-right: 5px"></i>Detalles del Usuario
            </h2>
            <p class="text-secondary mb-0">Información básica del usuario registrado en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card mb-2 border">
                <div class="glass-card-header p-3 text-white">
                    <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                        <h5 class="mb-0">
                            <i class="fas fa-address-card me-2"></i> Información Personal
                        </h5>
                    </div>
                </div>
                <div class="glass-card-body p-4">

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
                                <p class="form-control-plaintext bg-light bg-opacity-25 text-dark border-0 shadow-sm rounded-2 px-3 py-2">
                                    {{ $value }}
                                </p>
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
                        @can('admin.user.edit')
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Editar Usuario
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
