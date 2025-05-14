@extends('layouts.admin')

@section('content')

<div class="col-md-8">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Actualice los datos de la especialidad</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
                @csrf
                @method('PUT')

                <p class="text-muted mb-3">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                <div class="row">
                    {{-- Nombre de la especialidad --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name', $specialty->name) }}" name="name" id="name" class="form-control" required>
                    </div>

                    {{-- Teléfono --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" value="{{ old('phone', $specialty->phone) }}" name="phone" id="phone" class="form-control">
                    </div>
                </div>

                <br>

                <div class="row">
                    {{-- Ubicación --}}
                    <div class="col-md-6">
                        <label for="location" class="form-label">Ubicación</label>
                        <input type="text" value="{{ old('location', $specialty->location) }}" name="location" id="location" class="form-control">
                    </div>

                    {{-- Estado --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="activa" {{ old('status', $specialty->status) == 'activa' ? 'selected' : '' }}>Activa</option>
                            <option value="inactiva" {{ old('status', $specialty->status) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">
                    {{-- Descripción --}}
                    <div class="col-md-9">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $specialty->description) }}</textarea>
                    </div>
                </div>
                
                <br>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver atrás
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Actualizar Especialidad
                    </button>
                </div> 
            </form>
        </div>
    </div>
</div>

@endsection



@push('styles')
    <style>
        .form-control{
            background-color: #e0e0e0;
        }
        .form-control:focus {
            border-color: #29d34e;
            box-shadow: 0 0 0 0.2rem rgba(5, 227, 105, 0.25);
            outline: 0;
        }
        .alert-danger{
          color: #931824;
          background-color: #f8d7da;
          border-color: #d32535;
        }
        .card-header {
            background-color: #e3fef4;
            font-weight: bold;
        }
    </style>
@endpush