@extends ('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-secondary"><i class="fas fa-users-cog"></i> Gestión de Historiales Médicos</h2>
            <p class="text-muted">Consulta, administra y exporta los historiales médicos en el sistema.</p>
            <hr>
        </div>
    </div>
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white" style="background-color: #2d5eaf !important">
            <h3 class="card-title" style="padding-top: 5px;">Listado de Historiales Médicos</h3>
            <div class="card-tools">
                <a href="{{ route('admin.medical_histories.create') }}" class="btn btn-sm btn-primary">
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
                            title: '¡Historial Médico registrado!',  
                            text: '{{ $success}}',
                            showConfirmButton: false,
                            timer: 3000, 
                            toast: false,
                            background: '#f0fdf4', 
                            color: '#166534',       
                            iconColor: '#22c55e'  
                          });
                        </script>
                @endif
                    <table id="example1" class="table">
                        <thead style="text-align: center; background-color: #c5dffc !important; color:rgb(0, 0, 0)">
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
                                <tr class="text-center">
                                    {{-- Solo mostramos los historiales del médico logueado --}}
                                    @if ($history->doctor_id == Auth::user()->doctor->id)
                                        <td>{{ $history->doctor->specialty->name}}</td>
                                        <td>{{ $history->patient->name}} {{ $history->patient->last_name}}</td>
                                        <td>Dr. {{ $history->doctor->name}} {{ $history->doctor->last_name}}</td>
                                        <td>{{ $history->date }}</td>
                                        <td>{{ Str::limit($history->diagnosis, 30) }}</td>
                                        <td>
                                            <a href="{{ route('admin.medical_histories.show', $history->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.medical_histories.edit', $history->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.medical_histories.destroy', $history->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <script>
                  $(function () {
                    $("#example1").DataTable({
                      // Configuración general
                      pageLength: 10,
                      responsive: true,
                      lengthChange: true,
                      autoWidth: false,
                
                      // Traducciones al español
                      language: {
                        emptyTable: "No hay información",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ Historial Médico",
                        infoEmpty: "Mostrando 0 a 0 de 0 Usuarios",
                        infoFiltered: "(Filtrado de _MAX_ total Historial Médico)",
                        thousands: ",",
                        lengthMenu: "Mostrar _MENU_ Historial Médico",
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
                    })
                    .buttons()
                    .container()
                    .appendTo('#example1_wrapper .col-md-6:eq(0)');
                  });
              
                  document.querySelectorAll('.delete-form').forEach(form => {
                      form.addEventListener('submit', function(e) {
                          e.preventDefault();
                          Swal.fire({
                              title: '¿Eliminar Historial Médico?',
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