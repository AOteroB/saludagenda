<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Médico - {{ $history->patient->name }} {{ $history->patient->last_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
<style>
    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        margin-bottom: 30px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .styled-table thead tr {
        background-color: #34495e;
        color: #fff;
        text-align: left;
        font-weight: 600;
        font-size: 13pt;
    }

    .styled-table thead th {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .styled-table tbody tr:hover {
        background-color: #e8f0fe;
    }

    .styled-table tbody td {
        padding: 12px 15px;
        border-top: 1px solid #ddd;
        vertical-align: middle;
        font-size: 11pt;
        color: #333;
    }

    /* Para los th dentro del tbody que usas para etiquetas */
    .styled-table tbody th {
        background-color: #ecf0f1;
        font-weight: 600;
        width: 25%;
        padding: 12px 15px;
        border-top: 1px solid #ddd;
        color: #34495e;
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
