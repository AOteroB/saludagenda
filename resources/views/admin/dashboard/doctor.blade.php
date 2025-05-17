<style>
    .btn-outline-secondary{
        color: #000;
    }

    .btn-outline-secondary:hover{
        color: #ffffff;
        background-color: #000;
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


<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-secondary"><i class="fas fa-tachometer-alt"></i> Panel Principal</h2>
            <p class="text-muted mb-3">Resumen de las entidades y estadísticas del sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <!-- Pacientes Registrados -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-procedures mr-2 text-primary icon-responsive"></i> Pacientes Atendidos en el Sistema
                    </h5>
                    <p class="text-muted mb-2">Pacientes registrados que han sido atendidos.</p>
                    
                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalPatients }}</h3>
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Áreas Médicas -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-info border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="bi bi-heart-pulse mr-2 text-info icon-responsive"></i> Áreas Médicas Disponibles
                    </h5>
                    <p class="text-muted mb-2">Especialidades médicas que ofrece el sistema.</p>
                    
                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalSpecialties }}</h3>
                        <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

            <!-- Citas Programadas -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-danger border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="bi bi-calendar-check mr-2 text-danger icon-responsive"></i> Citas Médicas Programadas
                    </h5>
                    <p class="text-muted mb-2">Próximas consultas agendadas por los usuarios.</p>
                    
                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalEvents }}</h3>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horarios Disponibles -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="bi bi-clock-history mr-2 text-secondary icon-responsive"></i> Horarios de Atención
                    </h5>
                    <p class="text-muted mb-2">Listado de horarios que ofrece el sistema.</p>
                    
                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalSpecialties }}</h3>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Listado de Citas Médicas {{Auth::user()->doctor->id}}</h3>
                <div class="card-tools">
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
                            title: 'Paciente creado!',  
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
                            <th scope="col">Nro</th>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Registro</th>
                            <th scope="col">Ficha Médica</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach ($events as $event)
                            <tr class="text-center">
                                <td class="text-center"> {{ $contador++ }}</td>
                                <td>{{ $event->specialty->name}}</td>
                                <td>{{ $event->specialty->location}}</td>
                                <td>{{ $event->user->name}} {{ $event->user->last_name}}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end)->format('H:i') }}</td>
                                <td title="{{ $event->created_at->format('Y-m-d H:i') }}">
                                    {{ $event->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('doctor.edit.patient', ['user_id' => $event->user->id]) }}" 
                                        class="btn btn-sm btn-primary mb-1">
                                        Editar
                                    </a>
                                </td>
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
                      },
                
                      // Botones
                      buttons: [
                        {
                          extend: 'collection',
                          text: 'Exportar Datos',
                          orientation: 'landscape',
                          buttons: [
                            { extend: 'copy', text: 'Copiar' },
                            { extend: 'pdf' },
                            { extend: 'csv' },
                            { extend: 'excel' },
                            { extend: 'print', text: 'Imprimir' }
                          ]
                        },
                      ]
                    })
                    .buttons()
                    .container()
                    .appendTo('#example1_wrapper .col-md-6:eq(0)');
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
</div>
