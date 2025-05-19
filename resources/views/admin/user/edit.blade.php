@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-left">
            <h2 class="text-success mb-1">
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
    <!-- Incluir CSS general -->
    <link rel="stylesheet" href="{{ url('dist/css/edit.css') }}">
@endpush
