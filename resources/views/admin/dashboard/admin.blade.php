<div class="row">
    <!-- Usuarios Registrados -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-success rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1">{{ $totalUsers }}</h3>
                    <p class="text-muted mb-0">Usuarios Registrados</p>
                </div>
                <div class="text-success" style="font-size: 32px; opacity: 0.75;">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Médicos Activos -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-info rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1">{{ $totalDoctors }}</h3>
                    <p class="text-muted mb-0">Médicos Activos</p>
                </div>
                <div class="text-info" style="font-size: 32px; opacity: 0.75;">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
            <a href="{{ route('admin.doctors.index') }}" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Pacientes Registrados -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-warning rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1">{{ $totalPatients }}</h3>
                    <p class="text-muted mb-0">Pacientes Registrados</p>
                </div>
                <div class="text-warning" style="font-size: 32px; opacity: 0.75;">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
            <a href="{{ route('admin.patients.index') }}" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Citas Programadas -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-primary rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1">{{ $totalEvents }}</h3>
                    <p class="text-muted mb-0">Citas Programadas</p>
                </div>
                <div class="text-primary" style="font-size: 32px; opacity: 0.75;">
                    <i class="bi bi-calendar-check"></i>
                </div>
            </div>
            <a href="{{ route('admin.events.index') }}" class="small-box-footer">
                Ver Agenda <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Especialidades Médicas -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-danger rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1">{{ $totalSpecialties }}</h3>
                    <p class="text-muted mb-0">Especialidades Médicas</p>
                </div>
                <div class="text-danger" style="font-size: 32px; opacity: 0.75;">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
            <a href="{{ route('admin.specialties.index') }}" class="small-box-footer">
                Administrar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Configuración -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-white shadow-sm border border-secondary rounded-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-dark mb-1"> - </h3>
                    <p class="text-muted mb-0">Ajustes del Sistema</p>
                </div>
                <div class="text-secondary" style="font-size: 32px; opacity: 0.75;">
                    <i class="bi bi-gear"></i>
                </div>
            </div>
            <a href="#" class="small-box-footer">
                Configuración <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
