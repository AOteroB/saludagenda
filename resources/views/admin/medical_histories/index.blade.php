@extends ('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="fas fa-file-medical-alt me-2"></i> Gestión de Historiales Médicos</h2>
            <p class="text-muted">Consulta, administra y exporta los historiales médicos en el sistema.</p>
            <hr>
        </div>
    </div>

    <div class="glass-card mb-4 border">
        <div class="glass-card-header p-3 text-white">
            <div class="d-flex justify-content-between align-items-center" style="margin: 5px">
                <h5 class="mb-0">Listado de Historiales Médicos</h5>
                @can('admin.medical_histories.create')
                    <a href="{{ route('admin.medical_histories.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-user-plus me-1"></i> Registrar Nuevo
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
                        title: '¡Historial Médico registrado!',
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
                            <th>Especialidad</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Diagnóstico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)

                            @php
                                $user = auth()->user();
                                $canView = false;

                                if ($user->hasRole('admin') || $user->hasRole('doctor')) {
                                    $canView = true;
                                } elseif ($user->hasRole('patient') && $history->patient->id == $user->patient->id) {
                                    $canView = true;
                                }
                            @endphp

                            @if ($canView)

                                <tr class="text-center">
                                    <td>{{ $history->doctor->specialty->name }}</td>
                                    <td>{{ $history->patient->name }} {{ $history->patient->last_name }}</td>
                                    <td>Dr. {{ $history->doctor->name }} {{ $history->doctor->last_name }}</td>
                                    <td>{{ $history->date }}</td>
                                    <td>{{ Str::limit($history->diagnosis, 30) }}</td>
                                    <td>
                                        <a href="{{ route('admin.medical_histories.show', $history->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('admin.medical_histories.edit')
                                            <a href="{{ route('admin.medical_histories.edit', $history->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('admin.medical_histories.destroy')
                                            <form action="{{ route('admin.medical_histories.destroy', $history->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
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
        background: linear-gradient(135deg, #4a90e2, #193c5f);
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .glass-card-body {
        background: rgba(255, 255, 255);
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-light:hover {
        background-color: #ffffff;
        box-shadow: 10px 10px 10px rgba(255, 255, 255, 0.3);
        transform: translateY(-2px) scale(1.1);
        transition: all 0.3s ease;
    }

    .btn-outline-info {
        color: #0dcaf0;
        border-color: #0dcaf0;
    }

    .btn-outline-info:hover {
        background-color: #0dcaf0;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(93, 165, 255, 0.05);
    }

    .thead-light {
        background-color: #ebf4ff !important;
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
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(Filtrado de _MAX_ total registros)",
                lengthMenu: "Mostrar _MENU_ registros",
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
                    title: '¿Eliminar historial?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    iconHtml: '<i class="fas fa-notes-medical" style="color: #dc3545;"></i>',
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
