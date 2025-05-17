@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-left">
            <h2 class="text-success mb-1"><i class="fas fa-edit me-2" style="margin-right: 5px"></i>Editar Especialidad</h2>
            <p class="text-secondary mb-0">Modifique los campos necesarios y guarde los cambios.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="glass-card p-4 border border-success">

                <h5 class="text-black mb-4"><i class="fas fa-id-card-alt me-2" style="margin-right: 5px"></i>Información de la Especialidad</h5>

                <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label fw-semibold text-dark">Nombre <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name', $specialty->name) }}" name="name" id="name" class="form-control bg-light bg-opacity-25 text-dark" required>
                        </div>

                        <div class="col-md-4">
                            <label for="phone" class="form-label fw-semibold text-dark">Teléfono</label>
                            <input type="text" value="{{ old('phone', $specialty->phone) }}" name="phone" id="phone" class="form-control bg-light bg-opacity-25 text-dark">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="location" class="form-label fw-semibold text-dark">Ubicación</label>
                            <input type="text" value="{{ old('location', $specialty->location) }}" name="location" id="location" class="form-control bg-light bg-opacity-25 text-dark">
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label fw-semibold text-dark">Estado <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control bg-light bg-opacity-25 text-dark" required>
                                <option value="activa" {{ old('status', $specialty->status) == 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ old('status', $specialty->status) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold text-dark">Descripción</label>
                        <textarea name="description" id="description" class="form-control bg-light bg-opacity-25 text-dark" rows="3">{{ old('description', $specialty->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver atrás
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

@endsection

@push('styles')
<style>
    .glass-card {
        background: rgba(40, 167, 69, 0.03);
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
        border-color: #58b377;
        box-shadow: 0 0 0 0.2rem rgba(72, 180, 97, 0.25);
    }

    .btn-outline-secondary {
        color: #000000 !important;
        background-color: #ffffff;
        border-color: #000000;
    }

    .btn-outline-secondary:hover {
        color: #ffffff !important;
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
