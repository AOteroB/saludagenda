@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-left">
            <h2 class="text-success mb-1" style="color: #00b894 !important;">
                <i class="fas fa-user-md me-2" style="margin-right: 5px"></i>Editar Doctor
            </h2>
            <p class="text-secondary mb-0">Modifique los campos necesarios. Si no desea cambiar la contraseña, déjelos en blanco.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="glass-card mb-2 border border-black">

                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card-alt me-2"></i> Información del Doctor
                    </h5>
                </div>

                <div class="glass-card-body p-4">
                    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="name" class="form-label fw-semibold text-dark">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label fw-semibold text-dark">Apellidos</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $doctor->last_name) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label fw-semibold text-dark">Teléfono</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $doctor->phone) }}" class="form-control bg-light bg-opacity-25 text-dark">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $doctor->user->email) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                                @error('email')
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label fw-semibold text-dark">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control bg-light bg-opacity-25 text-dark">
                                <small class="form-text text-muted">Déjala vacía si no deseas cambiarla.</small>
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <ul class="mb-0 list-unstyled">
                                            @foreach ($errors->get('password') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label fw-semibold text-dark">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light bg-opacity-25 text-dark">
                                <small class="form-text text-muted">Solo si vas a modificar la contraseña.</small>
                                @error('password_confirmation')
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="license_number" class="form-label fw-semibold text-dark">Nº de Licencia</label>
                                <input type="text" name="license_number" id="license_number" value="{{ old('license_number', $doctor->license_number) }}" class="form-control bg-light bg-opacity-25 text-dark" required>
                                @error('license_number')
                                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="specialty_id" class="form-label fw-semibold text-dark">Especialidad</label>
                                <select name="specialty_id" id="specialty_id" class="form-control bg-light bg-opacity-25 text-dark" required>
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}" {{ old('specialty_id', $doctor->specialty_id) == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label fw-semibold text-dark">Estado</label>
                                <select name="status" id="status" class="form-control bg-light bg-opacity-25 text-dark" required>
                                    <option value="activo" {{ old('status', $doctor->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('status', $doctor->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar Doctor
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
        transition: all 0.3s ease;
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
