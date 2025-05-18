<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-black"><i class="fas fa-tachometer-alt"></i> Panel Principal</h2>
            <p class="text-muted mb-3">Resumen de las entidades y estadísticas del sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row">

        <!-- Mostrar SweetAlert si existe un mensaje de éxito en la sesión -->
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500 
                }).then(() => {
                    // Redirige automáticamente después de que el mensaje se cierre
                    window.location.href = '{{ url('/admin') }}';
                });
            </script>
        @endif

        <div class="col-lg-3 col-6">
            <div class="small-glass-card border-success">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3>{{ $totalEvents }}</h3>
                        <p>Mis próximas citas</p>
                    </div>
                    <div class="text-success icon-large">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
                <a href="{{ route('admin.events.show', ['id' => Auth::user()->id]) }}" class="small-box-footer">
                    Ver Citas <i class="fas fa-arrow-circle-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-glass-card border-primary">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3>{{ $totalDoctors }}</h3>
                        <p>Doctores Disponibles</p>
                    </div>
                    <div class="text-primary icon-large">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>
                <a href="{{ route('admin.doctors.index') }}" class="small-box-footer">
                    Ver Doctores <i class="fas fa-arrow-circle-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-glass-card border-danger">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3>{{ $totalSpecialties }}</h3>
                        <p>Especialidades</p>
                    </div>
                    <div class="text-danger icon-large">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                </div>
                <a href="{{ route('admin.specialties.index') }}" class="small-box-footer">
                    Ver Especialidades <i class="fas fa-arrow-circle-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-glass-card border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3>-</h3>
                        <p>Horarios de Atención</p>
                    </div>
                    <div class="text-secondary icon-large">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <a href="{{ route('admin.schedules.index') }}" class="small-box-footer">
                    Ver Horarios <i class="fas fa-arrow-circle-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white  d-flex  align-items-center">
                <h5 class="mb-0 text-dark">Calendario de Citas</h5>
                <button type="button" class="btn btn-sm btn-outline-primary ml-auto" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <!-- Modal -->
                    <form action="{{ route('admin.events.create') }}" method="POST" id="reservationForm">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border border-primary shadow-sm rounded-2">
                                    <div class="modal-header bg-white border-bottom border-primary">                                        
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Reservar Cita</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-light">
                                        <div class="row">
                                            <!-- Especialidad -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="specialty_id" class="form-label">Especialidad</label>
                                                    <select name="specialty_id" id="specialty_id" class="form-control" required>
                                                        @foreach ($specialties as $specialty)
                                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Fecha de la Cita -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="date" class="form-label">Día de la Cita</label>
                                                    <input type="date" name="date" class="form-control" id="date" min="{{ now()->toDateString() }}" required>
                                                </div>
                                            </div>

                                            <!-- Hora de la Cita -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="time" class="form-label">Hora de la Cita</label>
                                                    <input type="time" name="time" class="form-control" id="time" required>
                                                    <div class="small mt-1 text-muted">Solo se permiten reservas a :00, :20 o :40</div>
                                                    <script>
                                                        document.getElementById('time').addEventListener('input', function(event) {
                                                            let time = event.target.value;
                                                            let [hours, minutes] = time.split(':');
                                                    
                                                            // Verificamos si los minutos son diferentes de 00, 20, o 40
                                                            if (!['00', '20', '40'].includes(minutes)) {
                                                                // Si no es un valor permitido, se cambia a los minutos más cercanos
                                                                if (parseInt(minutes) < 20) {
                                                                    minutes = '00';
                                                                } else if (parseInt(minutes) < 40) {
                                                                    minutes = '20';
                                                                } else {
                                                                    minutes = '40';
                                                                }
                                                    
                                                                // Actualizamos el valor del campo con los minutos correctos
                                                                event.target.value = `${hours}:${minutes}`;
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>

                                            <!-- Estado de disponibilidad -->
                                            <div id="availabilityStatus"></div>

                                            <!-- Mensaje de disponibilidad -->
                                            <div id="availabilityMessage" class="col-md-12" style="display: none; color: red;">
                                                Este horario no está disponible.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-white border-top border-primary">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="submit-button" class="btn btn-primary" disabled>Reservar Cita</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'addEventButton'
        },
        customButtons: {
            addEventButton: {
                text: 'Reservar Cita',                
                click: function () {
                    document.getElementById('reservationForm').reset();
                    document.getElementById('availabilityStatus').innerHTML = '';
                    document.getElementById('submit-button').disabled = true;
                    $('#exampleModal').modal('show');
                }
            }
        },
        events: [
            @foreach ($events as $event)
                {
                    title: '{{ $event->title }}<br>({{ \Carbon\Carbon::parse($event->start)->format("H:i") }} - {{ \Carbon\Carbon::parse($event->end)->format("H:i") }})',
                    start: '{{ $event->start }}',
                    end: '{{ $event->end }}',
                    color: '{{ $event->color ?? '#3788d8' }}',
                },
            @endforeach
        ],
        eventContent: function(info) {
            return {
                html: '<div class="fc-event-title" style="white-space: normal;">' + info.event.title + '</div>'
            };
        },
        dateClick: function(info) {
            // Establece la fecha seleccionada en el input del formulario
            document.getElementById('date').value = info.dateStr;

            // Reinicia la hora y disponibilidad
            document.getElementById('time').value = '';
            $('#availabilityStatus').html('');
            $('#submit-button').prop('disabled', true);

            // Abre el modal
            $('#exampleModal').modal('show');
        }
    });
    calendar.render();
    // Modificamos el botón una vez el calendario se ha renderizado
    setTimeout(() => {
        const btn = document.querySelector('.fc-addEventButton-button');
        if (btn) {
            btn.classList.add('btn', 'btn-primary');
            btn.innerHTML = '<i class="fas fa-calendar-plus"></i> Reservar Cita';
        }
    }, 50);
});

    // Cuando el usuario cambie la especialidad o la hora
    document.getElementById('specialty_id').addEventListener('change', checkAvailability);
    document.getElementById('date').addEventListener('change', checkAvailability);
    document.getElementById('time').addEventListener('change', checkAvailability);

    // Función para comprobar la disponibilidad
    function checkAvailability() {
        var specialtyId = document.getElementById('specialty_id').value;
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;

        // Verificamos que todos los campos estén seleccionados
        if (specialtyId && date && time) {
            // Verificamos si la fecha y hora son posteriores a la actual
            const currentDate = new Date();
            const selectedDateTime = new Date(`${date}T${time}`);

            if (selectedDateTime < currentDate) {
                alert('La fecha y hora seleccionadas no son válidas. Deben ser posteriores a la fecha y hora actuales.');
                return; // Detenemos la ejecución si la fecha es anterior a la actual
            }

            // Realizamos la solicitud AJAX al servidor
            $.ajax({
                url: "{{ route('check.availability') }}",  // Ruta para verificar disponibilidad
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",  // CSRF token necesario para las solicitudes POST
                    specialty_id: specialtyId,
                    date: date,
                    time: time
                },
                success: function(response) {
                    // Si el doctor está disponible
                    if (response.available) {
                        $('#availabilityStatus').html('<span class="text-success">¡Horario disponible!</span>');
                        $('#submit-button').prop('disabled', false); // Habilitamos el botón de reserva
                    } else {
                        $('#availabilityStatus').html('<span class="text-danger">Horario no disponible.</span>');
                        $('#submit-button').prop('disabled', true); // Deshabilitamos el botón de reserva
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error en la solicitud AJAX:', error);
                }
            });
        }
    }

  </script>
<style>
    /* Contenedor general del calendario */
    #calendar {
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
    }

    .fc {
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.05);
        padding: 1rem;
        border: 1px solid #0d6efd;
    }

    /* Encabezado del calendario */
    .fc-toolbar-title {
        font-size: 1.25rem;
        color: #0d6efd;
        font-weight: 500;
    }

    .fc-button {
        background-color: #fff !important;
        border: 1px solid #0d6efd !important;
        color: #0d6efd !important;
        border-radius: 0.25rem !important;
        padding: 0.25rem 0.75rem !important;
        transition: 0.2s ease-in-out;
    }

    .fc-button:hover {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .fc-button-primary:not(:disabled):active,
    .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }

    /* Celdas del calendario */
    .fc-daygrid-day-number {
        font-size: 0.875rem;
        color: #6c757d;
        padding-right: 4px;
    }

    .fc-event {
        background-color: #0d6efd;
        border: none;
        color: #fff;
        font-size: 0.75rem;
        padding: 2px 4px;
        border-radius: 0.25rem;
    }

    .fc-event-title {
        white-space: normal;
        font-weight: 400;
    }

    .fc-day-today {
        background-color: #e7f1ff;
    }

    .small-box>.small-box-footer {
        background-color: rgb(99 145 255 / 10%);
    }

    .small-glass-card {
    background: rgba(252, 252, 252, 0.6);
    border-radius: 16px;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
    overflow: hidden;
    padding: 1rem 1.5rem;
}

.border-success {
    border-top: 4px solid #28a745 !important; /* verde */
}

.border-primary {
    border-top: 4px solid #007bff !important; /* azul */
}

.border-danger {
    border-top: 4px solid #dc3545 !important; /* rojo */
}

.border-secondary {
    border-top: 4px solid #6c757d !important; /* gris */
}

.small-glass-card h3 {
    background-color: #f8f9fa;
    padding: 0.2rem 0.8rem;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.small-glass-card p {
    color: #6c757d;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

/* Link button similar */
.small-glass-card a.small-box-footer {
    color: #ffffff;
    background: linear-gradient(135deg, #4a90e2, #193c5f);
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.small-glass-card a.small-box-footer:hover {
    background: linear-gradient(135deg, #5aa9ff, #1a4673);
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

.small-glass-card .icon-large {
    font-size: 2rem;
    opacity: 0.75;
}

</style>
