@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-success" style="color: #589165 !important"><i class="fas fa-user-edit"></i> Editar Usuario</h2>
            <p class="text-muted">Modifique los campos necesarios. Si no desea cambiar la contraseña, deje los campos en blanco.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white" style="background-color: #589165 !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Usuario</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Edición de Usuario --}}
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input type="text" value="{{ $user->name }}" name="name" id="name" class="form-control" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" value="{{ $user->email }}" name="email" id="email" class="form-control" required>
                            @error('email')
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span class="ms-1">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="form-text text-muted">Déjalo vacío si no deseas cambiar la contraseña.</small>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <ul class="mb-0 list-unstyled">
                                        @foreach ($errors->get('password') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            <small class="form-text text-muted">Solo si vas a modificar la contraseña.</small>
                            @error('password_confirmation')
                                <div class="alert alert-danger mt-2 p-2 py-1 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span class="ms-1" style="margin-left: 10px">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar Usuario
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
    .form-control {
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #4ed37c;
        box-shadow: 0 0 0 0.2rem rgba(72, 206, 131, 0.25);
    }

    .card-header {
        background-color: #e3fef4;
        font-weight: bold;
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
