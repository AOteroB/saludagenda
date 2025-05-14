@extends ('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-primary" style="color: #2d5eaf !important">
                <i class="fas fa-user-injured"></i> Gestión de Pacientes
            </h2>
            <p class="text-muted">Consulta, administra y exporta los pacientes registrados en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white" style="background-color: #2d5eaf !important">
            <h3 class="card-title" style="padding-top: 5px;">Listado de Pacientes Registrados</h3>
            <div class="card-tools">
                <a href="{{ route('admin.patients.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus me-1"></i> Registrar Nuevo
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            {{-- Alerta SweetAlert --}}
            @if ($success = Session::get('success'))
                <script>
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        title: 'Paciente creado!',
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

            {{-- Tabla --}}
            <table id="example1" class="table">
                <thead style="text-align: center; background-color: #c5dffc !important; color:rgb(0, 0, 0)">
                    <tr>
                        <th scope="col">Nro</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Acciones</th>
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
                            <td class="text-center">
                                <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @can('admin.user.index')
                                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                @endcan
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
                        },
                        buttons: [
                            {
                                extend: 'collection',
                                text: '<i class="fas fa-download me-1"></i> Exportar Datos',
                                orientation: 'landscape',
                                buttons: [
                                    { extend: 'copy', text: '<i class="fas fa-copy me-1"></i> Copiar' },
                                    { extend: 'csv', text: '<i class="fas fa-file-csv me-1"></i> CSV' },
                                    { extend: 'excel', text: '<i class="fas fa-file-excel me-1"></i> Excel' },
                                    {
                                        text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                                        action: function () {
                                            window.open("{{ route('admin.patients.pdf') }}", '_blank');
                                        }
                                    },
                                    {
                                        text: '<i class="fas fa-print me-1"></i> Imprimir',
                                        action: function () {
                                            const printWindow = window.open("{{ route('admin.patients.pdf') }}", '_blank');
                                            printWindow.focus();
                                            printWindow.onload = () => printWindow.print();
                                        }
                                    }
                                ],
                                className: 'btn btn-sm custom-export-btn',
                            }
                        ]
                    });
                    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
        .btn-primary {
            background: white;
            color: #2d5eaf;
        }

        .btn-primary:hover {
            background: #69aff9;
            color: white;
        }

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

        div.dt-button-collection {
            border: 1px solid #5892d0;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }
    </style>
@endpush
