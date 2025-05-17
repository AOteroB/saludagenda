@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-primary"><i class="fas fa-user-plus me-2" style="margin-right: 5px"></i>Registrar Doctor</h2>
            <p class="text-secondary">Complete los siguientes campos para registrar un nuevo doctor en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="glass-card p-4 border border-primary">

                <h5 class="text-black mb-4"><i class="fas fa-id-card-alt me-2" style="margin-right: 5px"></i>Información Personal</h5>

                <form action="{{ route('admin.doctors.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control text-dark" required>
                        </div>

                        {{-- Apellidos --}}
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label fw-semibold text-dark">Apellidos</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control text-dark" required>
                        </div>

                        {{-- Teléfono --}}
                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label fw-semibold text-dark">Teléfono</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control text-dark">
                        </div>
                    </div>

                    <div class="row">
                        {{-- Email --}}
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control text-dark" required>
                            @error('email')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 5px"></i> <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label fw-semibold text-dark">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control text-dark" required>
                            @error('password')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 5px"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="col-md-4 mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control text-dark " required>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Nº de Licencia --}}
                        <div class="col-md-4 mb-3">
                            <label for="license_number" class="form-label fw-semibold text-dark">Nº de Licencia</label>
                            <input type="text" name="license_number" id="license_number" value="{{ old('license_number') }}" class="form-control text-dark" required>
                            @error('license_number')
                                <div class="alert alert-danger mt-2 p-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- Especialidad --}}
                        <div class="col-md-4 mb-3">
                            <label for="specialty_id" class="form-label fw-semibold text-dark">Especialidad</label>
                            <select name="specialty_id" id="specialty_id" class="form-control text-dark" required>
                                <option value="">Seleccione una especialidad</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                        {{ $specialty->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label fw-semibold text-dark">Estado</label>
                            <select name="status" id="status" class="form-control text-dark" required>
                                <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver atrás
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Registrar Doctor
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .glass-card {
        background: rgba(3, 105, 217, 0.03);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    }

    .form-control {
        background-color: rgba(248, 249, 250, 0.6);
        border-radius: .375rem;
        color: #212529;
    }

        .form-control:focus {
            border-color: #5892d0;
            box-shadow: 0 0 0 0.2rem rgba(88, 146, 208, 0.25);
        }

    .btn-outline-secondary {
        color: #000 !important;
        background-color: #fff;
        border-color: #000;
    }

    .btn-outline-secondary:hover {
        color: #fff !important;
        background-color: #555555;
        border-color: #8c8989;
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }
</style>
@endpush
