@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-success" style="color: #589165 !important"><i class="fas fa-user-edit"></i> Editar Doctor</h2>
            <p class="text-muted">Modifique los campos necesarios. Si no desea cambiar la contraseña, deje los campos en blanco.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white" style="background-color: #589165 !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Doctor</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Edición de Doctor --}}
                    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Nombre --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nombre</label>
                                    <input type="text" value="{{ $doctor->name }}" name="name" id="name" class="form-control" required>
                                </div>
                            </div>

                            {{-- Apellidos --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label fw-semibold">Apellidos</label>
                                    <input type="text" value="{{ $doctor->last_name }}" name="last_name" id="last_name" class="form-control" required>
                                </div>
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Teléfono</label>
                                    <input type="text" value="{{ $doctor->phone }}" name="phone" id="phone" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Correo Electrónico --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" value="{{ old('email', $doctor->user->email) }}" name="email" id="email" class="form-control" required>
                                    @error('email')
                                        <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <span class="ms-1">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Contraseña --}}
                            <div class="col-md-4">
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
                            </div>

                            {{-- Confirmar Contraseña --}}
                            <div class="col-md-4">
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
                            </div>
                        </div>

                        <div class="row">
                            {{-- Nº de Licencia --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="license_number" class="form-label fw-semibold">Nº de Licencia</label>
                                    <input type="text" value="{{ old('license_number', $doctor->license_number) }}" name="license_number" id="license_number" class="form-control" required>
                                    @error('license_number')
                                        <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <span class="ms-1">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Especialidad --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="specialty_id" class="form-label fw-semibold">Especialidad</label>
                                    <select name="specialty_id" id="specialty_id" class="form-control" required>
                                        <option value="">Seleccione una especialidad</option>
                                        @foreach ($specialties as $specialty)
                                            <option value="{{ $specialty->id }}"
                                                {{ old('specialty_id', $doctor->specialty_id) == $specialty->id ? 'selected' : '' }}>
                                                {{ $specialty->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Estado --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-semibold">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="activo" {{ old('status', $doctor->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ old('status', $doctor->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Botones --}}
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
