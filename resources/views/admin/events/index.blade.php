@extends ('layouts.admin')

@section('content')
<style>
    .btn-outline-secondary {
        color: #ffffff;
        background: linear-gradient(135deg, #4a90e2, #193c5f);
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: linear-gradient(135deg, #5aa9ff, #1a4673);
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

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
        background: linear-gradient(135deg, #4a90e2, #193c5f);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-primary {
        background-color: #2d5eaf;
        border-color: #2d5eaf;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1f4a8c;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(93, 165, 255, 0.05);
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
                            <th scope="col">Doctor</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Registro</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($events as $event)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $event->specialty->name ?? 'N/A' }}</td>
                                <td>{{ $event->specialty->location ?? 'N/A' }}</td>
                                <td>Dr. {{ $event->doctor->name ?? '' }} {{ $event->doctor->last_name ?? '' }}</td>
                                <td>{{ $event->user->patient->name ?? 'Sin nombre' }} {{ $event->user->patient->last_name ?? 'Sin apellido' }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end)->format('H:i') }}</td>
                                <td title="{{ $event->created_at->format('Y-m-d H:i') }}">
                                    {{ $event->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
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
                    form.addEventListener('submit', function(e) {
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
