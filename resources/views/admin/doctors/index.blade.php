@extends ('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="fas fa-user-md me-2"></i> Gestión de Doctores</h2>
            <p class="text-muted">Consulta, administra y exporta los doctores registrados en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-4 border border-dark">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                <h5 class="mb-0">Listado de Doctores Registrados</h5>
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-user-plus me-1"></i> Registrar Nuevo
                </a>
            </div>
        </div>
        <div class="glass-card-body p-4">

            @if ($success = Session::get('success'))
                <script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: '¡Doctor creado!',
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
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($doctors as $doctor)
                            <tr class="text-center align-middle">
                                <td>{{ $contador++ }}</td>
                                <td>Dr. {{ $doctor->name . ' ' . $doctor->last_name }}</td>
                                <td>{{ $doctor->phone ?? 'No especificado' }}</td>
                                @php
                                    $specialtyColors = [
                                        'Cardiología' => 'badge-danger',
                                        'Dermatología' => 'badge-warning',
                                        'Ginecología y Obstetricia' => 'badge-pink text-white',
                                        'Neumología' => 'badge-info',
                                        'Oftalmología' => 'badge-secondary',
                                        'Oncología' => 'badge-purple text-white',
                                        'Pediatría' => 'badge-success',
                                        'Psiquiatría' => 'badge-secondary-subtle text-secondary',
                                        'Traumatología y Ortopedia' => 'badge-light text-dark border',
                                        'Urología' => 'badge-indigo-subtle text-indigo',
                                    ];

                                    $color = $specialtyColors[$doctor->specialty->name] ?? 'badge-primary';
                                @endphp
                                <td><span class="badge {{ $color }}" style="font-weight: bold">{{ $doctor->specialty->name }}</span></td>

                                <td>
                                    <span class="badge {{ $doctor->status === 'activo' ? 'badge-success' : 'badge-danger' }}">
                                        {{ ucfirst($doctor->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="d-inline delete-form">
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
        background: rgba(0, 0, 0, 0.7);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-outline-info {
        color: #0dcaf0;
        border-color: #0dcaf0;
    }
    .btn-outline-info:hover {
        background-color: #0dcaf0;
        color: white;
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: black;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .badge {
        padding: 0.45em 0.6em;
        font-size: 0.8em;
        font-weight: 500;
        border-radius: 0.5rem;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }

    .badge-pink {
        background-color: #d63384;
        color: white;
    }

    .badge-info {
        background-color: #0dcaf0;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .badge-purple {
        background-color: #6f42c1;
        color: white;
    }

    .badge-secondary-subtle {
        background-color: #e2e3e5;
        color: #6c757d;
    }
    .badge-light {
        background-color: #f8f9fa;
        color: black;
        border: 1px solid #ced4da;
    }
    .badge-indigo-subtle {
        background-color: #e0e7ff;
        color: #4338ca;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(93, 165, 255, 0.05);
    }
    .thead-light th {
        background-color: #EBF4FF;
        text-align: center;
        color: black;
    }
</style>
@endpush

@push('scripts')
<script>
    $(function () {
        const table = $("#example1").DataTable({
            pageLength: 10,
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                emptyTable: "No hay información",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Doctores",
                infoEmpty: "Mostrando 0 a 0 de 0 Doctores",
                infoFiltered: "(Filtrado de _MAX_ total Doctores)",
                lengthMenu: "Mostrar _MENU_ Doctores",
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
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Eliminar Doctor?',
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
    });
</script>
@endpush
