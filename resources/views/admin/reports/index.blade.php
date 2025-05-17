@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-secondary"><i class="fas fa-file-download"></i> Exportaciones PDF</h2>
            <p class="text-muted">Descarga documentos organizados de las distintas entidades del sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        {{-- Card: Personal Médico --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-2 text-dark">
                        <i class="fas fa-user-md mr-2 text-muted"></i> Personal Médico
                    </h5>
                    <p class="text-muted">Listado completo del personal médico registrado en el sistema.</p>
                    <div class="text-right">
                        <a href="{{ route('admin.doctors.pdf') }}" class="btn btn-dark">
                            <i class="fas fa-file-pdf mr-1"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Pacientes --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-2 text-dark">
                        <i class="fas fa-procedures mr-2 text-muted"></i> Pacientes
                    </h5>
                    <p class="text-muted">Exporta el listado de pacientes registrados con sus datos principales.</p>
                    <div class="text-right">
                        <a href="{{ route('admin.patients.pdf') }}" class="btn btn-dark">
                            <i class="fas fa-file-pdf mr-1"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Especialidades --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-2 text-dark">
                        <i class="fas fa-heartbeat mr-2 text-muted"></i> Especialidades
                    </h5>
                    <p class="text-muted">Consulta el listado de especialidades médicas disponibles.</p>
                    <div class="text-right">
                        <a href="{{ route('admin.specialties.pdf') }}" class="btn btn-dark">
                            <i class="fas fa-file-pdf mr-1"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Usuarios --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-2 text-dark">
                        <i class="fas fa-users mr-2 text-muted"></i> Usuarios del Sistema
                    </h5>
                    <p class="text-muted">Lista de usuarios con sus roles y permisos asignados.</p>
                    <div class="text-right">
                        <a href="{{ route('admin.user.pdf') }}" class="btn btn-dark">
                            <i class="fas fa-file-pdf mr-1"></i>Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Citas Reservadas --}}
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body">
                    <h5 class="mb-3 text-dark">
                        <i class="bi bi-calendar-check mr-2 text-muted"></i> Citas Reservadas
                    </h5>
                    <p class="text-muted">Consulta el listado de citas médicas reservadas.</p>
                    <form method="GET" action="{{ route('admin.events.pdf_dates') }}">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="fecha_inicio" class="text-muted">Fecha de inicio</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="fecha_fin" class="text-muted">Fecha de fin</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end justify-content-end">
                                <button type="submit" class="btn btn-dark btn-block">
                                    <i class="fas fa-file-pdf mr-1"></i> Descargar PDF
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- Botón para PDF general sin filtro de fechas --}}
                    <div class="mt-3 text-left">
                        <a href="{{ route('admin.events.pdf') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-file-alt mr-1"></i> Generar PDF con todas las citas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('fecha_inicio');
        const endDateInput = document.getElementById('fecha_fin');

        startDateInput.addEventListener('change', function () {
            endDateInput.min = this.value;
        });

        endDateInput.addEventListener('change', function () {
            if (this.value < startDateInput.value) {
                alert('La fecha de fin no puede ser anterior a la de inicio.');
                this.value = startDateInput.value;
            }
        });
    });
</script>


@endsection