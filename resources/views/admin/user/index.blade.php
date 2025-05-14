@extends ('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-primary" style="color: #2d5eaf !important"><i class="fas fa-users-cog"></i> Gestión de Usuarios</h2>
            <p class="text-muted">Consulta, administra y exporta los usuarios registrados en el sistema.</p>
            <hr>
        </div>
    </div>
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white" style="background-color: #2d5eaf !important">
            <h3 class="card-title" style="padding-top: 5px;">Listado de Usuarios Registrados</h3>
            <div class="card-tools">
                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-user-plus me-1"></i> Registrar Nuevo
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($success = Session::get('success'))
                    <script>
                        Swal.fire({
                        position: "top",
                        icon: "success",
                        title: '¡Usuario creado!',  
                        text: '{{ $success}}',
                        showConfirmButton: false,
                        timer: 3000, 
                        toast: false,
                        background: '#f0fdf4', // fondo más suave
                        color: '#166534',       // texto verde oscuro
                        iconColor: '#22c55e'  // color del icono
                        });
                    </script>
            @endif

            <div class="mb-3 filter-container d-flex align-items-center">
                <label for="filter-role" class="form-label fw-bold me-2 mb-0">Filtrar por Rol:</label>
                <div class="input-group w-auto">
                    <select id="filter-role" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Médico</option>
                        <option value="patient">Paciente</option>
                    </select>
                </div>
            </div>
            
            <table id="example1" class="table">
                <thead style="text-align: center; background-color: #c5dffc !important; color:rgb(0, 0, 0)">
                    <tr>
                        <th scope="col">Nro</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol(es)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $contador = 1; @endphp
                    @foreach ($usuarios as $usuario)
                        <tr class="text-center">
                            <td> {{ $contador++ }}</td>
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td>
                                @foreach ($usuario->getRoleNames() as $role)
                                    @php
                                        $badgeClass = match($role) {
                                            'admin' => 'bg-danger',
                                            'doctor' => 'bg-primary',
                                            'patient' => 'bg-success',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.user.show', $usuario->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.user.edit', $usuario->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.user.destroy', $usuario->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(function () {
                    const table = $("#example1").DataTable({
                        pageLength: 10,
                        responsive: true,
                        lengthChange: true,
                        autoWidth: false,
                        language: {
                            emptyTable: "No hay información",
                            info: "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                            infoEmpty: "Mostrando 0 a 0 de 0 Usuarios",
                            infoFiltered: "(Filtrado de _MAX_ total Usuarios)",
                            lengthMenu: "Mostrar _MENU_ Usuarios",
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
                        },
                        buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="fas fa-download me-1"></i> Exportar Datos',
                            orientation: 'ladscape',
                        buttons: [
                        { extend: 'copy', text: '<i class="fas fa-copy me-1"></i> Copiar' },
                        { extend: 'csv', text: '<i class="fas fa-file-csv me-1"></i> CSV' },
                        { extend: 'excel', text: '<i class="fas fa-file-excel me-1"></i> Excel' },
                        {
                            text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                            action: function ( e, dt, node, config ) {
                            window.open("{{ route('admin.user.pdf') }}", '_blank');
                            }
                        },
                        {
                            text: '<i class="fas fa-print me-1"></i> Imprimir',
                            action: function ( e, dt, node, config ) {
                            const printWindow = window.open("{{ route('admin.user.pdf') }}", '_blank');
                            printWindow.focus();
                            // Espera a que cargue y dispara impresión
                            printWindow.onload = () => printWindow.print();
                            }
                        }
                        ],
                        className: 'btn btn-sm custom-export-btn', // Personaliza la clase aquí
                    }
                    ]
                })
                    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                    // Filtro por rol (columna 3)
                    $('#filter-role').on('change', function () {
                        const value = $(this).val();
                        table.column(3).search(value).draw();
                    });
                });

                document.querySelectorAll('.delete-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Eliminar usuario?',
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


@push('styles')
    <style>
        .btn-primary{
            background: white;
            color: #2d5eaf;
        }

        .btn-primary:hover{
            background: #69aff9;
            color: white;
        }

         /* Estilo para el botón principal "Exportar Datos" */
        .custom-export-btn {
            background-color: #2d5eaf !important; 
            color: #ffffff !important;
            border: 1px solid #5892d0 !important;
            font-weight: 500;
        }

        .custom-export-btn:hover {
            background-color: #011830 !important;
            color: white !important;
        }

        /* Estilo para los botones del menú desplegable */
        div.dt-button-collection .dt-button {
            background-color: #ffffff;
            color: #003366;
            border: none;
            text-align: left;
            padding: 8px 15px;
            font-size: 14px;
            width: 100%;
        }

        div.dt-button-collection .dt-button:hover {
            background-color: #c5dffc;
            color: #000000;
        }

        /* Borde del dropdown */
        div.dt-button-collection {
            border: 1px solid #5892d0;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }
    </style>
@endpush

