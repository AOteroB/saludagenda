@extends ('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title" style="margin-top: 10px">Editar Horario</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver atrás
                    </a>    
                </div>
            </div>
            <div class="card-body row">
                <div class="col-md-3">
                    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Especialidad --}}
                        <div class="col-md-12">
                            <label for="specialty_id">Especialidad</label>
                            <select name="specialty_id" id="specialty_id" class="form-control" disabled>
                                <option value="{{ $schedule->doctor->specialty->id }}">
                                    {{ $schedule->doctor->specialty->name }}
                                </option>
                            </select>
                        </div>

                        <br>

                        {{-- Doctor --}}
                        <div class="col-md-12">
                            <label for="doctor_id">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-control" disabled>
                                <option value="{{ $schedule->doctor_id }}">
                                    Dr. {{ $schedule->doctor->name }} {{ $schedule->doctor->last_name }}
                                </option>
                            </select>
                        </div>
                        
                        <br>

                        {{-- Día --}}
                        <div class="col-md-12">
                            <label for="day_of_week">Día de la Semana</label>
                            <select name="day_of_week" id="day_of_week" class="form-control" required>
                                <option value="{{ $schedule->day_of_week }}">Seleccionado: 
                                    @switch($schedule->day_of_week)
                                        @case(1) Lunes @break
                                        @case(2) Martes @break
                                        @case(3) Miércoles @break
                                        @case(4) Jueves @break
                                        @case(5) Viernes @break
                                        @case(6) Sábado @break
                                        @case(7) Domingo @break
                                    @endswitch
                                </option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sábado</option>
                                <option value="7">Domingo</option>
                            </select>
                        </div>
                        <br> 
                        <div class="row">
                            {{-- Horario --}}
                            <div class="col-md-6">
                                <label for="start_time">Hora de Inicio</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="end_time">Hora de Fin</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $schedule->end_time }}" required>            
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Guardar Horario
                            </button>
                        </div>
                    </form>  
                </div>
                
                <div class="col-md-9">
                    {{-- CALENDARIO --}} 
                    <div class="card-body table-responsive">
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
                                        <td class="fw-bold">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00</td>
                                        @for ($day = 1; $day <= 6; $day++)
                                            <td>
                                                @foreach ($schedules as $scheduleItem)
                                                    @if ($scheduleItem->day_of_week == $day && (int)substr($scheduleItem->start_time, 0, 2) <= $hour && (int)substr($scheduleItem->end_time, 0, 2) > $hour)
                                                        <div data-specialty-id="{{ $scheduleItem->doctor->specialty->id ?? '' }}" class="doctor-name">
                                                            <span class="badge bg-primary p-2 mb-1 d-block">
                                                                Dr. {{ $scheduleItem->doctor->name }} {{ $scheduleItem->doctor->last_name }}
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

        // Primero, ocultamos todos los doctores en la tabla
        doctorNames.forEach(function (el) {
            el.style.display = 'none';
        });

        // Limpiamos el select de doctores (excepto la opción de "Seleccionar Doctor")
        doctorSelect.querySelectorAll('option:not([value=""])').forEach(function (option) {
            option.style.display = 'none'; // Ocultamos todas las opciones de doctor
        });

        // Limpiamos la selección actual del doctor (si hay una seleccionada)
        doctorSelect.value = ''; 

        // Filtramos y mostramos solo los doctores de la especialidad seleccionada
        doctorOptions.forEach(function (option) {
            var specialtyId = option.getAttribute('data-specialty-id');

            if (selectedSpecialty === "" || specialtyId === selectedSpecialty) {
                option.style.display = 'block'; // Mostramos la opción del doctor en el select
            } else {
                option.style.display = 'none'; // Ocultamos las opciones que no corresponden
            }
        });

        // Si se seleccionó una especialidad, mostramos solo los doctores correspondientes
        if (selectedSpecialty !== "") {
            doctorNames.forEach(function (el) {
                var specialtyId = el.getAttribute('data-specialty-id');
                if (specialtyId === selectedSpecialty) {
                    el.style.display = 'block'; // Mostramos los doctores correspondientes
                }
            });
        }
    });
</script>
@endsection

@push('styles')
    <style>
        .doctor-name {
            display: none;
        }
    </style>
@endpush
