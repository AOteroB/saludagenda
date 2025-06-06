@extends ('layouts.admin')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="bi bi-heart-pulse me-2"></i> Gestión de Especialidades</h2>
            <p class="text-muted">Consulta, administra y exporta las especialidades registradas en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-4 border">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                <h5 class="mb-0">Listado de Especialidades Registradas</h5>
                @can('admin.specialties.create')
                    <a href="{{ route('admin.specialties.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-user-plus me-1"></i> Crear Nueva
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
                        title: '¡Especialidad creada!',
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
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($specialties as $specialty)
                            <tr class="text-center align-middle">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $specialty->name }}</td>
                                <td>{{ $specialty->phone }}</td>
                                <td>{{ $specialty->location }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $specialty->status === 'activa' ? 'badge-success' : 'badge-danger' }}">
                                        {{ ucfirst($specialty->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.specialties.show', $specialty->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('admin.specialties.destroy')
                                        <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.specialties.destroy', $specialty->id) }}" method="POST" class="d-inline delete-form">
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
                    info: "Mostrando _START_ a _END_ de _TOTAL_ Especialidades",
                    infoEmpty: "Mostrando 0 a 0 de 0 Especialidades",
                    infoFiltered: "(Filtrado de _MAX_ total Especialidades)",
                    lengthMenu: "Mostrar _MENU_ Especialidades",
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

            $(document).on('submit', '.delete-form', function (e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: '¿Eliminar Especialidad?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    iconHtml: '<i class="fas fa-heartbeat" style="color: #dc3545;"></i>',
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