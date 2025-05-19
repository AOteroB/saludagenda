<!-- Incluir CSS general -->
<link rel="stylesheet" href="{{ url('dist/css/index.css') }}">

<style>
    .border-4 {
        border-top-width: 2px !important;
    }
    
    .table .thead-light th {
        background-color: #EEF6FC;
        color: #5282b2;
        border-color: #cdcdcd;
    }
    
    .btn-outline-secondary {
        color: #ffffff;
        background: linear-gradient(135deg, #4a90e2, #193c5f);
        transition: all 0.3s ease;
    }
    .border-purple {
        border-top: 2px solid #6f42c1 !important;
    }

    .border-teal {
        border-top: 2px solid #20c997 !important;
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
            <h2 class="text-black"><i class="fas fa-tachometer-alt"></i> Panel Principal</h2>
            <p class="text-muted mb-3">Resumen de las entidades y estadísticas del sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <!-- Usuarios Registrados -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-user-plus mr-2 text-primary icon-responsive"></i> Usuarios Registrados
                    </h5>
                    <p class="text-muted mb-2">Total de personas con acceso al sistema.</p>

                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalUsers }}</h3>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Médico -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-success border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-user-md mr-2 text-success icon-responsive"></i> Personal Médico Registrado
                    </h5>
                    <p class="text-muted mb-2">Profesionales de la salud activos en la plataforma.</p>
                    
                     <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0">{{ $totalDoctors }}</h3>
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                     </div>
                </div>
            </div>
        </div>

        <!-- Pacientes Registrados -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-danger border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-procedures mr-2 text-danger icon-responsive"></i> Pacientes Atendidos en el Sistema
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

        <!-- Citas Programadas -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-warning border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="bi bi-calendar-check mr-2 text-warning icon-responsive"></i> Citas Médicas Programadas
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

        <!-- Horarios -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-purple border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="bi bi-clock-history mr-2 text-purple icon-responsive"></i> Horarios de Atención
                    </h5>
                    <p class="text-muted mb-2">Disponibilidad horaria semanal del personal médico.</p>

                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0"> - </h3>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reportes PDF -->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-file-pdf mr-2 text-secondary icon-responsive"></i> Generador de Informes PDF
                    </h5>
                    <p class="text-muted mb-2">Herramienta para crear reportes detallados en PDF.</p>
                    
                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0"> - </h3>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historias Médicas-->
        <div class="col-sm-12 col-md-6 mb-4">
            <div class="card shadow-sm border-top border-teal border-4">
                <div class="card-body px-3" style="padding-bottom: 10px">
                    <h5 class="mb-1 text-dark">
                        <i class="fas fa-file-medical-alt mr-2 text-teal icon-responsive"></i> Historias Médicas
                    </h5>
                    <p class="text-muted mb-2">Registros clínicos individuales de cada paciente.</p>

                    <div class="d-flex justify-content-between align-items-center" style="padding: 10px">
                        <h3 class="text-dark bg-light px-3 py-1 rounded m-0"> - </h3>
                        <a href="{{ route('admin.medical_histories.index') }}" class="btn btn-outline-secondary">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
