@extends ('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="fas fa-users-cog me-2"></i> Gestión de Usuarios</h2>
            <p class="text-muted">Consulta, administra y exporta los usuarios registrados en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-4 border">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                <h5 class="mb-0">Listado de Usuarios Registrados</h5>
                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-light">
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
                        title: '¡Usuario creado!',
                        text: '{{ $success }}',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f0fdf4',
                        color: '#166534',
                        iconColor: '#22c55e'
                    });
                </script>
            @endif

            <div class="mb-3 d-flex align-items-center">
                <label for="filter-role" class="form-label fw-bold me-2 mb-0">Filtrar por Rol:</label>
                <select id="filter-role" class="form-select form-select-sm w-auto" style="margin-left: 5px; padding: 5px">
                    <option value="">Todos</option>
                    <option value="admin">Admin</option>
                    <option value="doctor">Médico</option>
                    <option value="patient">Paciente</option>
                </select>
            </div>

            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol(es)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($usuarios as $usuario)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach ($usuario->getRoleNames() as $role)
                                        @php
                                            $badgeClass = match($role) {
                                                'admin' => 'badge-danger',
                                                'doctor' => 'badge-primary',
                                                'patient' => 'badge-success',
                                                default => 'badge-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.show', $usuario->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.user.edit', $usuario->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $usuario->id) }}" method="POST" class="d-inline delete-form">
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
        
        $('#filter-role').on('change', function () {
            const value = $(this).val();
            table.column(3).search(value).draw();
        });

        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: '¿Eliminar Usuario?',
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
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
