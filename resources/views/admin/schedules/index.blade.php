@extends('layouts.admin')

@section('content')
      
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="bi bi-calendar-check me-2"></i> Gestión de Horarios</h2>
            <p class="text-muted">Consulta, administra y exporta los horarios de los doctores registrados en el sistema.</p>
            <hr>
        </div>
    </div>
    @can('admin.user.index')
        <div class="glass-card mb-4 border">
            <div class="glass-card-header p-3 text-white">
                <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                    <h5 class="mb-0">Listado de Horarios de Atención</h5>
                    <a href="{{ route('admin.schedules.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-calendar-plus me-1"></i> Crear Nuevo
                    </a>
                </div>
            </div>
            <div class="glass-card-body p-4">

                @if ($success = Session::get('success'))
                    <script>
                        Swal.fire({
                            position: "top",
                            icon: "success",
                            title: '¡Horario creado!',
                            text: '{{ $success }}',
                            showConfirmButton: false,
                            timer: 3000,
                            background: '#f0fdf4',
                            color: '#166534',
                            iconColor: '#22c55e'
                        });
                    </script>
                @endif

                <div class="table-responsive">
                    <table id="example1" class="table table-hover text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>Doctor</th>
                                <th>Especialidad</th>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>Dr. {{ $schedule->doctor->name }} {{ $schedule->doctor->last_name }}</td>
                                    <td>{{ $schedule->doctor->specialty->name ?? 'Sin especialidad' }}</td>
                                    <td>{{ nombreDia($schedule->day_of_week) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    @endcan
    
    <div class="col-md-12">
        <div class="glass-card mb-4 border">
            <div class="glass-card-header p-3 text-white">
                <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                    <h5 class="mb-0">Calendario de Atención de Doctores</h5>
                </div>
            </div>

            <div class="card-body">
                @if ($success = Session::get('success'))
                    <script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: '!Horario creado!',
                        text: '{{ $success }}',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: false,
                        background: '#f0fdf4',
                        color: '#166534',
                        iconColor: '#22c55e'
                    });
                    </script>
                @endif

                {{-- FILTRO DE ESPECIALIDADES --}}
                <div class="mb-4 d-flex align-items-center">
                    <label for="specialty" class="form-label fw-bold me-2">Filtrar por Especialidad:</label>
                    <select id="specialty" name="specialty" class="form-control me-2" style="width: 250px; margin-left: 10px; margin-right: 10px;">
                        <option value="">-- Todas las especialidades --</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- TABLA ESTILO CALENDARIO --}}
                @php
                    $specialtyColors = [
                        'Cardiología' => 'bg-danger',
                        'Dermatología' => 'bg-warning',
                        'Ginecología y Obstetricia' => 'bg-pink text-pink',
                        'Neumología' => 'bg-info',
                        'Oftalmología' => 'bg-secondary',
                        'Oncología' => 'bg-purple text-purple',
                        'Pediatría' => 'bg-success',
                        'Psiquiatría' => 'bg-secondary-subtle text-secondary',
                        'Traumatología y Ortopedia' => 'bg-light text-dark border',
                        'Urología' => 'bg-indigo-subtle text-indigo',
                    ];
                @endphp

                {{-- LEYENDA DE ESPECIALIDADES --}}
                @php
                    $specialtyColorsMap = [
                        'Cardiología' => '#dc3545',
                        'Dermatología' => '#ffc107',
                        'Ginecología y Obstetricia' => '#d63384',
                        'Neumología' => '#0dcaf0',
                        'Oftalmología' => '#6c757d',
                        'Oncología' => '#6f42c1',
                        'Pediatría' => '#198754',
                        'Psiquiatría' => '#adb5bd',
                        'Traumatología y Ortopedia' => '#e9ecef',
                        'Urología' => '#6610f2',
                    ];
                @endphp

                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Leyenda de Especialidades:</h6>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($specialtyColorsMap as $name => $hexColor)
                            <div class="d-flex align-items-center px-3 py-2 rounded shadow-sm border" style="background-color: #f8f9fa; min-width: 240px;">
                                <div style="width: 20px; height: 20px; border-radius: 4px; background-color: {{ $hexColor }};" class="me-3"></div>
                                <span class="fw-medium">{{ $name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="calendarTable" class="table table-hover table-bordered text-center align-middle">
                        <thead class="thead-light">
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
                            @for ($hour = 8; $hour < 22; $hour++)
                                <tr>
                                    <td class="fw-bold">
                                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00
                                    </td>
                                    @for ($day = 1; $day <= 6; $day++)
                                        <td>
                                            @foreach ($schedules as $schedule)
                                                @if (
                                                    $schedule->day_of_week == $day &&
                                                    (int)substr($schedule->start_time, 0, 2) <= $hour &&
                                                    (int)substr($schedule->end_time, 0, 2) > $hour
                                                )
                                                    @php
                                                        $specialtyName = $schedule->doctor->specialty->name ?? 'Sin especialidad';
                                                        $badgeColor = $specialtyColors[$specialtyName] ?? 'bg-primary';
                                                    @endphp
                                                    <div data-specialty-id="{{ $schedule->doctor->specialty->id ?? '' }}" class="doctor-name">
                                                        <span class="badge {{ $badgeColor }} p-2 mb-1 d-block">
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
        </div>
    </div>

    {{-- SCRIPT FILTRO --}}
    <script>
        document.getElementById('specialty').addEventListener('change', function () {
            var selectedSpecialty = this.value;
            var doctorNames = document.querySelectorAll('.doctor-name');

            doctorNames.forEach(function (el) {
                var specialtyId = el.getAttribute('data-specialty-id');

                if (selectedSpecialty === "" || specialtyId === selectedSpecialty) {
                    el.style.display = 'block';
                } else {
                    el.style.display = 'none';
                }
            });
        });
    </script>
@endsection

@push('styles')
    <!-- Incluir CSS general -->
    <link rel="stylesheet" href="{{ url('dist/css/index.css') }}">
    <style>
        .table .thead-light th {
            background-color: #EEF6FC;
            color: #5282b2;
            border-color: #cdcdcd;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                pageLength: 10,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                language: {
                    emptyTable: "No hay información",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                    infoEmpty: "Mostrando 0 a 0 de 0 Horarios",
                    infoFiltered: "(Filtrado de _MAX_ total Horarios)",
                    lengthMenu: "Mostrar _MENU_ Horarios",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscador:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }
            });

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Eliminar horario?',
                        text: "¡Esta acción no se puede deshacer!",
                        icon: 'warning',
                        iconHtml: '<i class="fas fa-calendar-times" style="color: #dc3545;"></i>',
                        showCancelButton: true,
                        focusCancel: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Eliminar',
                        cancelButtonText: 'Cancelar',
                        customClass: {
                            popup: 'border border-danger shadow-lg rounded-lg',
                            title: 'fw-bold text-danger',
                            confirmButton: 'btn btn-danger px-4 py-2',
                            cancelButton: 'btn btn-secondary px-4 py-2'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush