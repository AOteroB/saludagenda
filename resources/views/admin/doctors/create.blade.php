@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-user-md"></i> Registro de Nuevo Doctor</h2>
            <p class="text-muted">Complete el siguiente formulario para agregar un nuevo doctor al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="Background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos del Doctor</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Registro de Doctor --}}
                    <form action="{{ route('admin.doctors.store') }}" method="POST">
                        @csrf

                        {{-- Nota de campos obligatorios --}}
                        <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        <div class="row">
                            {{-- Nombre --}}
                            <div class="col-md-4">
                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            {{-- Apellidos --}}
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="alert alert-danger mt-2 p-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            {{-- Correo Electrónico --}}
                            <div class="col-md-4">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            </div>

                            {{-- Contraseña --}}
                            <div class="col-md-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            {{-- Confirmar Contraseña --}}
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                @error('password_confirmation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Mensajes de error --}}
                            <div class="col-md-4">
                                @error('email')
                                    <div class="alert alert-danger mt-2 p-2 py-1">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger d-flex align-items-center mt-2" role="alert" style="padding: .5rem">
                                        <i class="bi bi-exclamation-triangle-fill me-5"></i>
                                        <ul class="mb-0 list-unstyled">
                                            @foreach ($errors->get('password') as $error)
                                                <li style="margin-left: 10px">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            {{-- Nº de Licencia --}}
                            <div class="col-md-4">
                                <label for="license_number" class="form-label">Nº de Licencia</label>
                                <input type="text" name="license_number" id="license_number" class="form-control" value="{{ old('license_number') }}">
                            </div>

                            {{-- Especialidad --}}
                            <div class="col-md-4">
                                <label for="specialty_id" class="form-label">Especialidad <span class="text-danger">*</span></label>
                                <select name="specialty_id" id="specialty_id" class="form-control" required>
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Estado --}}
                            <div class="col-md-4">
                                <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Crear Doctor
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
