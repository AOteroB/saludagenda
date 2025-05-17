@extends ('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="fas fa-procedures me-2"></i> Gestión de Pacientes</h2>
            <p class="text-muted">Consulta, administra y exporta los pacientes registrados en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-4 border border-dark">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 10px">
                <h5 class="mb-0">Listado de Pacientes Registrados</h5>
                <a href="{{ route('admin.patients.create') }}" class="btn btn-sm btn-light">
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
                        title: '¡Paciente creado!',
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
                            <th>Nombre y Apellidos</th>
                            <th>DNI</th>
                            <th>Edad</th>
                            <th>Sexo</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($patients as $patient)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $patient->name }} {{ $patient->last_name }}</td>
                                <td>{{ $patient->dni }}</td>
                                <td>{{ $patient->age }} años</td>
                                <td>{{ $patient->sex }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>
                                    <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @can('admin.user.index')
                                        <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
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

    .badge {
        padding: 0.45em 0.6em;
        font-size: 0.8em;
        font-weight: 500;
        border-radius: 0.5rem;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(93, 165, 255, 0.05);
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
                info: "Mostrando _START_ a _END_ de _TOTAL_ Pacientes",
                infoEmpty: "Mostrando 0 a 0 de 0 Pacientes",
                infoFiltered: "(Filtrado de _MAX_ total Pacientes)",
                lengthMenu: "Mostrar _MENU_ Pacientes",
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
                    title: '¿Eliminar paciente?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    iconHtml: '<i class="fas fa-user-times" style="color: #dc3545;"></i>',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'border border-danger shadow-lg rounded-lg',
                        title: 'fw-bold text-danger',
                        confirmButton: 'btn btn-danger px-4 py-2',
                        cancelButton: 'btn btn-secondary px-4 py-2'
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
