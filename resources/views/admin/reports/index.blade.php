@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-primary"><i class="fas fa-file-download"></i> Listados y Exportaciones en PDF</h2>
            <p class="text-muted">Descarga documentos organizados de las distintas entidades del sistema.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        {{-- Card: Personal Médico --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-user-md"></i> Personal Médico</h5>
                </div>
                <div class="card-body">
                    <p>Listado completo del personal médico registrado en el sistema.</p>
                    <a href="{{ route('admin.doctors.pdf') }}" class="btn btn-success">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Card: Pacientes --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-procedures"></i> Pacientes</h5>
                </div>
                <div class="card-body">
                    <p>Exporta el listado de pacientes registrados con sus datos principales.</p>
                    <a href="{{ route('admin.patients.pdf') }}" class="btn btn-info text-white">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Card: Especialidades --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0"><i class="fas fa-stethoscope"></i> Especialidades</h5>
                </div>
                <div class="card-body">
                    <p>Consulta el listado de especialidades médicas disponibles.</p>
                    <a href="{{ route('admin.specialties.pdf') }}" class="btn btn-warning text-white">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Card: Usuarios --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-users-cog"></i> Usuarios del Sistema</h5>
                </div>
                <div class="card-body">
                    <p>Lista de usuarios con sus roles y permisos asignados.</p>
                    <a href="{{ route('admin.user.pdf') }}" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
