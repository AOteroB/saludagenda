<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historiales Médicos - {{ $patient->name }} {{ $patient->last_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <style>
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .styled-table th, .styled-table td {
            border: 1px solid #dee2e6;
            padding: 0.5rem;
        }

        .styled-table th {
            background-color: #34495e;
            color: white;
        }

        .section-title {
            font-size: 14pt;
            color: #2c3e50;
            margin-top: 40px;
        }
    </style>
</head>

<body style="font-size: 10pt; color: #333;" onload="window.print()">

    <table width="100%" style="border-bottom: 2px solid #ccc; margin-bottom: 20px;">
        <tr>
            <td style="font-size: 8pt;">
                <strong style="color: #2c3e50;">Clínica Salud Agenda</strong><br>
                <span>Av. de Ejemplo S/N</span><br>
                <span>Cádiz, CP 11012</span><br>
                <span>Tel: (+34) 111 222 333</span><br>
                <span>Email: contacto@saludagenda.com</span><br>
            </td>
            <td style="text-align: right;">
                <img src="{{ public_path('dist/img/Logotipo.png') }}" width="60" alt="Logo">
            </td>
        </tr>
    </table>

    <h2 style="text-align: center; font-size: 16pt; margin-bottom: 10px; color: #34495e;">
        Historial Clínico Completo del Paciente
    </h2>

    <p style="text-align: center; font-size: 11pt;">
        <strong>{{ $patient->name }} {{ $patient->last_name }}</strong> - DNI: {{ $patient->dni }}
    </p>

    @forelse ($patient->medicalHistories as $history)
        <h3 class="section-title">Consulta del {{ $history->date }}</h3>
        <table class="styled-table">
            <tbody>
                <tr>
                    <th>Médico</th>
                    <td>Dr. {{ $history->doctor->name }} {{ $history->doctor->last_name }} ({{ $history->doctor->specialty->name }})</td>
                </tr>
                <tr>
                    <th>Diagnóstico</th>
                    <td>{{ $history->diagnosis }}</td>
                </tr>
                <tr>
                    <th>Tratamiento</th>
                    <td>{{ $history->treatment }}</td>
                </tr>
                <tr>
                    <th>Observaciones</th>
                    <td>{{ $history->notes ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    @empty
        <p>No hay historiales médicos registrados para este paciente.</p>
    @endforelse

</body>
</html>
