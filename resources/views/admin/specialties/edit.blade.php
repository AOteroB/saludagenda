@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="text-success" style="color: #589165 !important">
                <i class="fas fa-user-edit"></i> Editar Especialidad
            </h2>
            <p class="text-muted">Modifique los campos necesarios. Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white" style="background-color: #589165 !important">
                    <h5 class="mb-0"><i class="fas fa-id-card-alt"></i> Datos de la Especialidad</h5>
                </div>

                <div class="card-body">
                    {{-- Formulario de Edición de Especialidad --}}
                    <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="text-muted small mb-4">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                        
                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="name" id="name" value="{{ old('name', $specialty->name) }}" required>
                        </div>
                            
                        {{-- Teléfono --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" class="form-control"  name="phone" id="phone" value="{{ old('phone', $specialty->phone) }}">
                        </div>
                   
                        
                        {{-- Ubicación --}}
                        <div class="mb-3">
                            <label for="location" class="form-label fw-semibold">Ubicación</label>
                            <input type="text" class="form-control" name="location" id="location" value="{{ old('location', $specialty->location) }}">
                        </div>

                        {{-- Estado --}} 
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Estado <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control"  required>
                                <option value="">Seleccione</option>
                                <option value="activa" {{ old('status', $specialty->status) == 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ old('status', $specialty->status) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                    
                        {{-- Descripción --}} 
                        <div class="form-group">
                            <label for="description" class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control"  name="description" id="description" rows="3">{{ old('description', $specialty->description) }}</textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar Especialidad
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
        background-color: #f8f9fa;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    .card-header h5 {
        font-weight: 600;
    }
</style>
@endpush
