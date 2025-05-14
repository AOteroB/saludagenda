@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-plus-circle"></i> Registro de Nueva Especialidad</h2>
            <p class="text-muted">Complete el siguiente formulario para agregar una nueva especialidad al sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="Background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos de la Especialidad</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Registro de Especialidad --}}
                    <form action="{{ route('admin.specialties.store') }}" method="POST">
                        @csrf

                        {{-- Nota de campos obligatorios --}}
                        <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        <div class="row">
                            {{-- Nombre de la especialidad --}}
                            <div class="col-md-8">
                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" required>
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="form-control">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            {{-- Ubicación --}}
                            <div class="col-md-8">
                                <label for="location" class="form-label">Ubicación</label>
                                <input type="text" value="{{ old('location') }}" name="location" id="location" class="form-control">
                            </div>
                            
                            {{-- Estado --}}
                            <div class="col-md-4">
                                <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="activa" {{ old('status') == 'activa' ? 'selected' : '' }}>Activa</option>
                                    <option value="inactiva" {{ old('status') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            {{-- Descripción --}}
                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Crear Especialidad
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
