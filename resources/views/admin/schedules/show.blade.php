@extends('layouts.admin')

@section('content')
      
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="bi bi-calendar-check me-2"></i> Gestión de Horarios</h2>
            <p class="text-muted">Consulta y administra los horarios de los doctores registrados en el sistema.</p>
            <hr>
        </div>
    </div>
    
        <div class="glass-card mb-4 border">
            <div class="glass-card-header p-3 text-white">
                <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                    <h5 class="mb-0">Listado de Horarios de Atención</h5>
                    @can('admin.schedules.create')
                        <a href="{{ route('admin.schedules.create') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-calendar-plus me-1"></i> Crear Nuevo
                        </a>
                    @endcan    
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
                
                {{-- Buscador --}}
                <div class="mb-4">
                    <input type="text" id="historialSearch" class="form-control" placeholder="Buscar por doctor o especialidad...">
                
                </div>
                {{-- Recorremos todos los doctores y mostramos sus horarios, si tienen al menos uno registrado --}}
                    @foreach ($doctors as $doctor)
                        @if ($doctor->schedules->isNotEmpty())
                            <div class="glass-card mb-4 border border-black">
                                <div class="bg-light border-bottom px-4 py-3 d-flex justify-content-between align-items-center rounded-top">
                                    <div class="fw-bold text-primary">
                                        <i class="fas fa-user-md me-2"></i> Dr. {{ $doctor->name }} {{ $doctor->last_name }} - {{ $doctor->specialty->name }}
                                    </div>
                                    <span class="badge bg-primary-subtle text-dark">
                                        {{ $doctor->schedules->count() }} horario/s
                                    </span>
                                </div>
                                <div class="glass-card-body p-3">
                                    <ul class="list-group">
                                        @foreach ($doctor->schedules as $schedule)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ nombreDia($schedule->day_of_week) }}</strong>
                                                    <span class="text-muted"> | {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
                                                </div>
                                                @can('admin.schedules.create')
                                                    <div>
                                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
            </div>
        </div>   
        </div>
    </div>
@endsection

@push('styles')
    <!-- Incluir CSS general -->
    <link rel="stylesheet" href="{{ url('dist/css/index.css') }}">
@endpush

@push('scripts')
    <script>
        // Función para eliminar tildes y convertir a minúsculas
        function normalizeText(text) {
            return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        }

        $(function () {
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
            // Buscador que ignora tildes
            $('#historialSearch').on('keyup', function () {
                const searchTerm = normalizeText($(this).val());

                $('.glass-card.border.border-black').each(function () {
                    const patientName = normalizeText($(this).find('.fw-bold.text-primary').text());

                    let foundInHistories = false;
                    $(this).find('ul.list-group li.list-group-item').each(function () {
                        const diagnosisText = normalizeText($(this).text());
                        if (diagnosisText.indexOf(searchTerm) !== -1) {
                            foundInHistories = true;
                            return false;
                        }
                    });

                    if (patientName.indexOf(searchTerm) !== -1 || foundInHistories) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endpush