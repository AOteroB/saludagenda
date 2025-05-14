@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-success" style="color: #589165 !important">
                <i class="fas fa-user-edit"></i> Editar Paciente
            </h2>
            <p class="text-muted">Modifique los campos necesarios para actualizar los datos del paciente.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white" style="background-color: #589165 !important">
                    <h5 class="mb-0"><i class="fas fa-notes-medical me-2"></i> Datos del Paciente</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="text-muted mb-4">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ $patient->name }}" class="form-control" required>
                            </div>

                            <div class="col-md-5">
                                <label for="last_name" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ $patient->last_name }}" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="dob" class="form-label">F. Nacimiento <span class="text-danger">*</span></label>
                                <input type="date" name="dob" id="dob" value="{{ $patient->dob }}" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                                <input type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" class="form-control" required>
                            </div>
                        </div>

                        @error('dni')
                        <div class="row mb-2">
                            <div class="col-md-8"></div>
                            <div class="alert alert-danger col-md-4"><i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>{{ $message }}</div>
                        </div>
                        @enderror

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="sex" class="form-label">Sexo <span class="text-danger">*</span></label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="Hombre" {{ $patient->sex == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="Mujer" {{ $patient->sex == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="address" class="form-label">Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" value="{{ $patient->address }}" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="postal_code" class="form-label">C. Postal <span class="text-danger">*</span></label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ $patient->postal_code }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="phone" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ $patient->phone }}" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="phone_emergence" class="form-label">Tlfn Emergencia</label>
                                <input type="text" name="phone_emergence" id="phone_emergence" value="{{ $patient->phone_emergence }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <label for="blood_type" class="form-label">Tipo Sangre <span class="text-danger">*</span></label>
                                <select name="blood_type" id="blood_type" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                        <option value="{{ $type }}" {{ $patient->blood_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @error('email')
                        <div class="row mb-2">
                            <div class="col-md-4"></div>
                            <div class="alert alert-danger col-md-6"><i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>{{ $message }}</div>
                        </div>
                        @enderror

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="health_card_number" class="form-label">Nº Tarjeta Sanitaria</label>
                                <input type="text" name="health_card_number" id="health_card_number" value="{{ old('health_card_number', $patient->health_card_number) }}" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label for="health_insurance" class="form-label">Aseguradora Médica</label>
                                <input type="text" name="health_insurance" id="health_insurance" value="{{ $patient->health_insurance }}" class="form-control">
                            </div>
                        

                        <div class="col-md-6">
                            <label for="previous_illnesses" class="form-label">Enfermedades Previas</label>
                            <textarea name="previous_illnesses" id="previous_illnesses" rows="2" class="form-control">{{ $patient->previous_illnesses }}</textarea>
                        </div>
                    </div>
                       
                        @error('health_card_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="allergies" class="form-label">Alergias</label>
                                <textarea name="allergies" id="allergies" rows="2" class="form-control">{{ $patient->allergies }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="current_medications" class="form-label">Medicamentos Actuales</label>
                                <textarea name="current_medications" id="current_medications" rows="2" class="form-control">{{ $patient->current_medications }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Actualizar
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
            background-color: #f3f3f3;
        }
        .form-control:focus {
            border-color: #29d34e;
            box-shadow: 0 0 0 0.2rem rgba(41, 211, 78, 0.25);
        }
        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
    </style>
@endpush
