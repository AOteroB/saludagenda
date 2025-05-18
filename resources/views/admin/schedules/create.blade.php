@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-left">
            <h2 class="text-primary mb-1" style="color: #3a7bd5 !important;">
                <i class="fas fa-clock me-2"></i> Crear Horario
            </h2>
            <p class="text-secondary mb-0">Complete el formulario para asignar un nuevo horario.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-2 border border-black">

        <div class="glass-card-header p-3 text-white">
            <h5 class="mb-0">
                <i class="fas fa-calendar-plus me-2"></i> Datos del Horario
            </h5>
        </div>

        <div class="glass-card-body p-4">
            <div class="row">
                {{-- Formulario --}}
                <div class="col-md-4">

                    <form action="{{ route('admin.schedules.store') }}" method="POST">
                        @csrf

                        {{-- Especialidad --}}
                        <div class="mb-3">
                            <label for="specialty_id" class="form-label fw-semibold text-dark">Especialidad</label>
                            <select name="specialty_id" id="specialty_id" class="form-control bg-light bg-opacity-25 text-dark" required>
                                <option value="">Seleccionar Especialidad</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Doctor --}}
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label fw-semibold text-dark">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-control bg-light bg-opacity-25 text-dark" required>
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
                            <label for="day_of_week" class="form-label fw-semibold text-dark">Día de la Semana</label>
                            <select name="day_of_week" id="day_of_week" class="form-control bg-light bg-opacity-25 text-dark" required>
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
                                <label for="start_time" class="form-label fw-semibold text-dark">Hora de Inicio</label>
                                <input type="time" name="start_time" id="start_time" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label fw-semibold text-dark">Hora de Fin</label>
                                <input type="time" name="end_time" id="end_time" class="form-control bg-light bg-opacity-25 text-dark" required>
                            </div>
                        </div>

                        {{-- Errores --}}
                        @error('start_time')
                            <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                <span class="ms-1">{{ $message }}</span>
                            </div>
                        @enderror
                        @error('end_time')
                            <div class="alert alert-danger d-flex align-items-center mt-2 p-2 py-1">
                                <i class="bi bi-exclamation-triangle-fill me-2" style="margin-right: 10px"></i>
                                <span class="ms-1">{{ $message }}</span>
                            </div>
                        @enderror

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver atrás
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Guardar Horario
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Calendario --}}
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table id="calendarTable" class="table table-bordered table-sm text-center align-middle mt-md-0 mt-4">
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
                                                    @php
                                                        $doctorColor = 'doctor-color-' . ($schedule->doctor->id % 15);
                                                    @endphp
                                                    @if ($schedule->day_of_week == $day && (int)substr($schedule->start_time, 0, 2) <= $hour && (int)substr($schedule->end_time, 0, 2) > $hour)
                                                        <div data-specialty-id="{{ $schedule->doctor->specialty->id ?? '' }}" class="doctor-name">
                                                            <div class="text-white rounded p-1 small fw-semibold mb-1 {{ $doctorColor }}">
                                                                Dr. {{ $schedule->doctor->name }} {{ $schedule->doctor->last_name }}
                                                            </div>
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

            </div>
        </div>
    </div>
</div>

{{-- Filtro de doctores --}}
<script>
    document.getElementById('specialty_id').addEventListener('change', function () {
        var selectedSpecialty = this.value;
        var doctorNames = document.querySelectorAll('.doctor-name');
        var doctorSelect = document.getElementById('doctor_id');
        var doctorOptions = doctorSelect.querySelectorAll('option');

        doctorNames.forEach(el => el.style.display = 'none');
        doctorOptions.forEach(option => {
            if (option.value !== "") option.style.display = 'none';
        });
        doctorSelect.value = '';

        doctorOptions.forEach(option => {
            var specialtyId = option.getAttribute('data-specialty-id');
            if (selectedSpecialty === "" || specialtyId === selectedSpecialty) {
                option.style.display = 'block';
            }
        });

        if (selectedSpecialty !== "") {
            doctorNames.forEach(el => {
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
        background: linear-gradient(135deg, #6fb1fc, #4364f7);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-success {
        background: linear-gradient(135deg, #6fb1fc, #4364f7);
        border-color: #007bff;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-success:hover,
    .btn-outline-secondary:hover {
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
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

    .alert-danger {
        color: #931824;
        background-color: #f8d7da;
        border-color: #d32535;
    }

    .doctor-name {
        display: none;
    }

    /* 15 colores únicos por doctor */
    .doctor-color-0 { background-color: #1e88e5; color: #fff; }
    .doctor-color-1 { background-color: #43a047; color: #fff; }
    .doctor-color-2 { background-color: #f4511e; color: #fff; }
    .doctor-color-3 { background-color: #6d4c41; color: #fff; }
    .doctor-color-4 { background-color: #8e24aa; color: #fff; }
    .doctor-color-5 { background-color: #00897b; color: #fff; }
    .doctor-color-6 { background-color: #c2185b; color: #fff; }
    .doctor-color-7 { background-color: #fbc02d; color: #000; }
    .doctor-color-8 { background-color: #5e35b1; color: #fff; }
    .doctor-color-9 { background-color: #00acc1; color: #fff; }
    .doctor-color-10 { background-color: #e53935; color: #fff; }
    .doctor-color-11 { background-color: #7cb342; color: #fff; }
    .doctor-color-12 { background-color: #fb8c00; color: #fff; }
    .doctor-color-13 { background-color: #3949ab; color: #fff; }
    .doctor-color-14 { background-color: #00c853; color: #fff; }

    .doctor-name div:hover {
        opacity: 0.9;
        transform: scale(1.03);
        transition: all 0.2s ease;
        cursor: pointer;
    }
</style>
@endpush
