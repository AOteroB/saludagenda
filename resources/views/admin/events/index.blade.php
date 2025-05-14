@extends ('layouts.admin')

@section('content')
<div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Listado de Citas Médicas</h3>
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
                            background: '#f0fdf4', // fondo más suave
                            color: '#166534',       // texto verde oscuro
                            iconColor: '#22c55e'  // color del icono
                          });
                        </script>
                @endif
                    <table id="example1" class="table">
                        <thead style="text-align: center; background-color: #c5dffc !important; color:rgb(0, 0, 0)">
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
                                    <td>{{ $event->user->patient->name ?? 'Sin nombre' }}
                                        {{ $event->user->patient->last_name ?? 'Sin apellido' }}</td>
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
                          text: '<i class="fas fa-download me-1"></i> Exportar Datos',
                            orientation: 'ladscape',
                            buttons: [
                            { extend: 'copy', text: '<i class="fas fa-copy me-1"></i> Copiar' },
                            { extend: 'csv', text: '<i class="fas fa-file-csv me-1"></i> CSV' },
                            { extend: 'excel', text: '<i class="fas fa-file-excel me-1"></i> Excel' },
                            {
                                text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                                action: function ( e, dt, node, config ) {
                                window.open("{{ route('admin.patients.pdf') }}", '_blank');
                                }
                            },
                            {
                                text: '<i class="fas fa-print me-1"></i> Imprimir',
                                action: function ( e, dt, node, config ) {
                                const printWindow = window.open("{{ route('admin.patients.pdf') }}", '_blank');
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
@endsection

@push('styles')
    <style>
         /* Estilo para el botón principal "Exportar Datos" */
        .custom-export-btn {
            background-color: #5892d0 !important;
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