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
                <h5 class="mb-0">Historias Médicas del Paciente</h5>
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
            
            {{-- Filtrar para que los usuarios con rol "patient" solo vean su propio historial --}}
            @php
                $user = auth()->user();
                if ($user->hasRole('patient')) {
                    $patients = $patients->filter(function ($patient) use ($user) {
                        return $patient->id === $user->patient->id;
                    });
                }
            @endphp

            <div class="mb-4">
                <input type="text" id="historialSearch" class="form-control" placeholder="Buscar por paciente o diagnóstico...">
            </div>

            {{-- Recorremos todos los pacientes y mostramos sus historiales médicos agrupados, solo si tienen al menos uno registrado --}}
            @foreach ($patients as $patient)
                @if ($patient->medicalHistories->isNotEmpty())
                    <div class="glass-card mb-4 border border-black">
                        <div class="bg-light border-bottom px-4 py-3 d-flex justify-content-between align-items-center rounded-top">
                            <div class="fw-bold text-primary">
                                <i class="fas fa-user-injured me-2" style="margin-right: 5px"></i>{{ $patient->name }} {{ $patient->last_name }}
                            </div>
                            <span class="badge bg-primary-subtle text-dark">
                                {{ $patient->medicalHistories->count() }} historial/es
                            </span>
                                <a href="{{ route('admin.medical_histories.pdf_all', $patient->id) }}" class="btn btn-sm btn-dark" title="Imprimir todos los historiales del paciente">
                                    <i class="fas fa-print"></i> Descargar Historial Completo
                                </a>
                        </div>
                        <div class="glass-card-body p-3">
                            <ul class="list-group">
                                {{-- Iteramos sobre los pacientes y renderizamos una tarjeta por cada uno que tenga historiales médicos, 
                                mostrando su nombre y la cantidad de historiales asociados --}}
                                @foreach ($patient->medicalHistories as $history)
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
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $history->date }}</strong>
                                                <span class="text-muted"> | {{ $history->doctor->specialty->name }} - Dr. {{ $history->doctor->name }} {{ $history->doctor->last_name }}</span><br>
                                                <span>{{ Str::limit($history->diagnosis, 60) }}</span>
                                            </div>
                                            <div>
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
                                                <a href="{{ route('admin.medical_histories.pdf_single', $history->id) }}" class="btn btn-sm btn-outline-secondary" title="Imprimir historial individual">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('dist/css/index.css') }}">
@endpush


@push('scripts')
<script>
    // Función para eliminar tildes y convertir a minúsculas
    function normalizeText(text) {
        return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    $(document).ready(function () {

        // Confirmación al eliminar
        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            const form = this;
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
                    form.submit();
                }
            });
        });

        // Buscador que ignora tildes
        $('#historialSearch').on('keyup', function () {
            const searchTerm = normalizeText($(this).val());

            $('.glass-card.border.border-black').each(function () {
                const patientName = normalizeText($(this).find('.fw-bold.text-primary').text());

                let foundInHistories = false;
                $(this).find('ul.list-group li.list-group-item').each(function () {
                    const diagnosisText = normalizeText($(this).text());
                    if (diagnosisText.indexOf(searchTerm) !== -1) {
                        foundInHistories = true;
                        return false;
                    }
                });

                if (patientName.indexOf(searchTerm) !== -1 || foundInHistories) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endpush


