<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Médico - {{ $history->patient->name }} {{ $history->patient->last_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <style>
        .styled-table {
            width: 100%;
            border-collapse: collapse;
        }
        .styled-table th, .styled-table td {
            border: 1px solid #dee2e6;
            padding: 0.5rem;
        }
        .styled-table th {
            background-color: #34495e;
            color: white;
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

    <h2 style="text-align: center; font-size: 16pt; margin-bottom: 30px; color: #34495e;">
        Historial Médico Individual
    </h2>

    <table class="styled-table mb-4">
        <tbody>
            <tr>
                <th>Paciente</th>
                <td>{{ $history->patient->name }} {{ $history->patient->last_name }}</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>{{ $history->date }}</td>
            </tr>
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

</body>
</html>
