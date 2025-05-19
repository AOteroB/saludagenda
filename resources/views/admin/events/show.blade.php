@extends ('layouts.admin')

@section('content')
<!-- Incluir CSS general -->
<link rel="stylesheet" href="{{ url('dist/css/index.css') }}">
<style>
    .table .thead-light th {
        background-color: #EEF6FC;
        color: #5282b2;
        border-color: #cdcdcd;
    }

    @media (max-width: 576px) {
        .stat-value {
            font-size: 24px;
        }
        .card-body h5 {
            font-size: 1rem;
        }
        .icon-responsive {
            font-size: 1rem;
        }
    }

    @media (min-width: 577px) {
        .stat-value {
            font-size: 32px;
        }
        .card-body h5 {
            font-size: 1.25rem;
        }
        .icon-responsive {
            font-size: 1.2rem;
        }
    }
</style>
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="bi bi-calendar-check me-2"></i> Listado de Citas Médicas</h2>
            <p class="text-muted">Consulta, gestiona y elimina las citas médicas registradas en el sistema.</p>
            <hr>
        </div>
    </div>
    <div class="glass-card mb-4 border">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                <h5 class="mb-0">Listado de Citas Médicas</h5>
            </div>
        </div>
        <div class="glass-card-body p-4">
            @if ($success = Session::get('success'))
                <script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: 'Paciente creado!',
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
                <table id="example1" class="table table-hover">
                    <thead class="thead-light text-center">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Ubicación</th>
                            @if(auth()->user()->hasRole('doctor'))
                                <th scope="col">Paciente</th>
                            @elseif(auth()->user()->hasRole('patient'))
                                <th scope="col">Doctor</th>
                            @endif
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Registro</th>
                            @if(auth()->user()->hasRole('doctor'))
                                <th scope="col">Ficha Médica</th>
                            @elseif(auth()->user()->hasRole('patient'))
                                <th scope="col">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($events as $event)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $event->specialty->name }}</td>
                                <td>{{ $event->specialty->location }}</td>
                                @if(auth()->user()->hasRole('doctor') && $event->user)
                                    <td>{{ $event->user->name }} {{ $event->user->last_name }}</td>
                                @elseif(auth()->user()->hasRole('patient') && $event->doctor)
                                    <td>Dr. {{ $event->doctor->name }} {{ $event->doctor->last_name }}</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end)->format('H:i') }}</td>
                                <td title="{{ $event->created_at->format('Y-m-d H:i') }}">
                                    {{ $event->created_at->diffForHumans() }}
                                </td>
                                @if(auth()->user()->hasRole('doctor'))
                                    <td>
                                        <a href="{{ route('doctor.edit.patient', ['user_id' => $event->user->id]) }}"
                                        class="btn btn-sm btn-primary mb-1">
                                        Editar
                                        </a>
                                    </td>
                                @elseif(auth()->user()->hasRole('patient'))
                                    <td>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script>
                $(function () {
                    $("#example1").DataTable({
                        pageLength: 10,
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                        language: {
                            emptyTable: "No hay información",
                            info: "Mostrando _START_ a _END_ de _TOTAL_ Citas Médicas",
                            infoEmpty: "Mostrando 0 a 0 de 0 Usuarios",
                            infoFiltered: "(Filtrado de _MAX_ total Citas Médicas)",
                            thousands: ",",
                            lengthMenu: "Mostrar _MENU_ Citas Médicas",
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
                });

                document.querySelectorAll('.delete-form').forEach(form => {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Eliminar Cita Médica?',
                            text: "¡Esta acción no se puede deshacer!",
                            icon: 'warning',
                            iconHtml: '<i class="fas fa-user-times" style="color: #dc3545;"></i>',
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
                            buttonsStyling: true,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection
