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
                                <td class="text-center"> {{ $contador++ }}</td>
                                <td>{{ $event->specialty->name}}</td>
                                <td>{{ $event->specialty->location}}</td>
                                <td>Dr. {{ $event->doctor->name}} {{ $event->doctor->last_name}}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end)->format('H:i') }}</td>
                                <td title="{{ $event->created_at->format('Y-m-d H:i') }}">
                                    {{ $event->created_at->diffForHumans() }}
                                </td>
                                <td class="text-center">
   
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
@endsection
