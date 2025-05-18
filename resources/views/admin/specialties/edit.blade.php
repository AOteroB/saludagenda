@extends('layouts.admin')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-left">
            <h2 class="text-success mb-1" style="color: #00b894 !important;">
                <i class="fas fa-edit me-2" style="margin-right: 5px"></i>Editar Especialidad
            </h2>
            <p class="text-secondary mb-0">Modifique los campos necesarios y guarde los cambios.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="glass-card mb-2 border border-black">

                <div class="glass-card-header p-3 text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card-alt me-2"></i> Información de la Especialidad
                    </h5>
                </div>

                <div class="glass-card-body p-4">
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
