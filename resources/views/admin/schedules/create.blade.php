@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <h2 class="text-primary" style="color: #2d5eaf !important">
                <i class="fas fa-clock"></i> Crear Horario
            </h2>
            <p class="text-muted">Complete el formulario para asignar un nuevo horario.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white" style="background-color: #2d5eaf !important">
                    <h5 class="mb-0"><i class="fas fa-calendar-plus"></i> Datos del Horario</h5>
                </div>

                <div class="card-body row">
                    <div class="col-md-4">
                        <form action="{{ route('admin.schedules.store') }}" method="POST">
                            @csrf

                            {{-- Especialidad --}}
                            <div class="mb-3">
                                <label for="specialty_id" class="form-label fw-semibold">Especialidad</label>
                                <select name="specialty_id" id="specialty_id" class="form-control" required>
                                    <option value="">Seleccionar Especialidad</option>
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Doctor --}}
                            <div class="mb-3">
                                <label for="doctor_id" class="form-label fw-semibold">Doctor</label>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <option value="">Seleccionar Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" data-specialty-id="{{ $doctor->specialty->id }}">
                                            {{ $doctor->name }} {{ $doctor->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Día --}}
                            <div class="mb-3">
                                <label for="day_of_week" class="form-label fw-semibold">Día de la Semana</label>
                                <select name="day_of_week" id="day_of_week" class="form-control" required>
                                    <option value="">Seleccionar Día</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                </select>
                            </div>

                            {{-- Horario --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label fw-semibold">Hora de Inicio</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label fw-semibold">Hora de Fin</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                                </div>
                            </div>

                            {{-- Errores --}}
                            @error('start_time')
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span style="margin-left: 10px">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('end_time')
                                <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror

                            {{-- Botón --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Volver atrás
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Guardar Horario
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="table-responsive mt-3">
                            <table id="calendarTable" class="table table-bordered table-sm text-center align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Horario</th>
                                        <th>Lunes</th>
                                        <th>Martes</th>
                                        <th>Miércoles</th>
                                        <th>Jueves</th>
                                        <th>Viernes</th>
                                        <th>Sábado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($hour = 8; $hour <= 22; $hour++)
                                        <tr>
                                            <td class="fw-bold">
                                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00
                                            </td>
                                            @for ($day = 1; $day <= 6; $day++)
                                                <td>
                                                    @foreach ($schedules as $schedule)
                                                        @if ($schedule->day_of_week == $day && (int)substr($schedule->start_time, 0, 2) <= $hour && (int)substr($schedule->end_time, 0, 2) > $hour)
                                                            <div data-specialty-id="{{ $schedule->doctor->specialty->id ?? '' }}" class="doctor-name">
                                                                <span class="badge bg-primary p-2 mb-1 d-block">
                                                                    Dr. {{ $schedule->doctor->name }} {{ $schedule->doctor->last_name }}
                                                                </span>                                               
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> {{-- /.card-body --}}
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('specialty_id').addEventListener('change', function () {
        var selectedSpecialty = this.value;
        var doctorNames = document.querySelectorAll('.doctor-name');
        var doctorSelect = document.getElementById('doctor_id');
        var doctorOptions = doctorSelect.querySelectorAll('option');

        doctorNames.forEach(function (el) {
            el.style.display = 'none';
        });

        doctorSelect.querySelectorAll('option:not([value=""])').forEach(function (option) {
            option.style.display = 'none';
        });

        doctorSelect.value = '';

        doctorOptions.forEach(function (option) {
            var specialtyId = option.getAttribute('data-specialty-id');
            if (selectedSpecialty === "" || specialtyId === selectedSpecialty) {
                option.style.display = 'block';
            }
        });

        if (selectedSpecialty !== "") {
            doctorNames.forEach(function (el) {
                var specialtyId = el.getAttribute('data-specialty-id');
                if (specialtyId === selectedSpecialty) {
                    el.style.display = 'block';
                }
            });
        }
    });
</script>
@endsection

@push('styles')
<style>
    .form-control:focus {
        border-color: #5892d0;
        box-shadow: 0 0 0 0.2rem rgba(88, 146, 208, 0.25);
    }

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }

    .doctor-name {
        display: none;
    }

    .card-header {
        background-color: #dbe1ec;
        font-weight: bold;
    }
</style>
@endpush
