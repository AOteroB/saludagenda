<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <style>
        .styled-table {
            border-collapse: collapse;
            width: 100%;
        }

        .styled-table th, .styled-table td {
            border: 1px solid #dee2e6;
            padding: 0.5rem;
        }

        .styled-table th {
            background-color: #34495e;
            font-weight: bold;
            color: white;
        }
    </style>
</head>

    <body style="font-size: 11pt; margin: 0; padding: 0; color: #333;">

        <table width="100%" style="border-bottom: 2px solid #ccc; margin-bottom: 20px;">
            <tr>
            <td style="vertical-align: top;font-size: 8pt">
                <strong style="color: #2c3e50;">Clínica Salud Agenda</strong><br>
                <span>Av. de Ejemplo S/N</span><br>
                <span>Cádiz, CP 11012</span><br>
                <span>Tel: (+34) 111 222 333</span><br>
                <span>Email: contacto@saludagenda.com</span><br>
            </td>
            <td style="text-align: right;">
                <img src="{{ public_path('dist/img/Logotipo.png') }}" alt="Logo" width="60">
            </td>
            </tr>
        </table>

        <h2 style="text-align: center; font-size: 16pt; margin-bottom: 30px; color: #34495e;">
            Listado de Usuarios Registrados
        </h2>

        <table class="styled-table">
            <thead>
                <tr>
                    <th class="font-weight-bold">Nombre</th>
                    <th class="font-weight-bold">Email</th>
                    <th class="font-weight-bold">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
