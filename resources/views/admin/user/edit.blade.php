@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-success mb-1" style="color: #00b894 !important;">
                <i class="fas fa-user-edit me-2" style="margin-right: 5px"></i>Editar Usuario
            </h2>
            <p class="text-secondary mb-0">Modifique los campos necesarios. Deje la contraseña vacía si no desea cambiarla.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card mb-2 border border-black">

                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card-alt me-2"></i> Información Personal
                    </h5>
                </div>

                <div class="glass-card-body p-4">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Nombre Completo</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" class="form-control bg-light bg-opacity-25 text-dark" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" id="email" class="form-control bg-light bg-opacity-25 text-dark" required>
                            @error('email')
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                    <span class="ms-1">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control bg-light bg-opacity-25 text-dark">
                            <small class="form-text text-muted">Déjelo vacío si no desea cambiar la contraseña.</small>
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light bg-opacity-25 text-dark">
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .glass-card {
        background: rgba(252, 252, 252, 0.6);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .glass-card-header {
        background: linear-gradient(135deg, #00b894, #006a4e);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .form-control {
        background-color: rgba(248, 249, 250, 0.6);
        border-radius: .375rem;
        color: #212529;
    }

    .form-control:focus {
        border-color: #58b377;
        box-shadow: 0 0 0 0.2rem rgba(72, 180, 97, 0.25);
    }

    .form-label {
        font-weight: 600;
    }

    .btn-outline-secondary {
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        color: #ffffff !important;
        background-color: #555555;
        border-color: #8c8989;
    }

    .btn-success {
        background: linear-gradient(135deg, #00b894, #006a4e);
        border-color: #28a745;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-success:hover, .btn-outline-secondary:hover {
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
