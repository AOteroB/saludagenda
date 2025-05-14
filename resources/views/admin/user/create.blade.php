@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-user-plus"></i> Registro de Nuevo Usuario</h2>
            <p class="text-muted">Complete el siguiente formulario para agregar un nuevo usuario al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="Background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Usuario</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Registro de Usuario --}}
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control" required>
                            @error('email')
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span class="ms-1" style="margin-left: 10px;">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <ul class="mb-0 list-unstyled">
                                        @foreach ($errors->get('password') as $error)
                                            <li style="margin-left: 10px;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            @error('password_confirmation')
                                <div class="alert alert-danger mt-2 p-2 py-1 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span class="ms-1">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Crear Usuario
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
    .form-control:focus {
        border-color: #5892d0;
        box-shadow: 0 0 0 0.2rem rgba(88, 146, 208, 0.25);
    }

    .card-header {
        background-color: #dbe1ec;
        font-weight: bold;
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
