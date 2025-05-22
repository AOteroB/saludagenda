<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Configuración básica del documento -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salud Agenda</title>

    <!-- Fuentes personalizadas y estilos del tema -->
    <link href="{{ url('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Fuente alternativa -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700&display=fallback">

    <!-- Íconos FontAwesome -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Estilos del tema AdminLTE -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">

    <!-- Estilos adicionales añadidos desde otras vistas -->
    @stack('styles')

    <!-- Animaciones CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Biblioteca para alertas interactivas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Íconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- FullCalendar (para gestión de eventos o citas) -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url ('fullcalendar/es.global.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.js"></script>

    <!-- Estilos personalizados del menú lateral -->
    <style>
        .nav-header {
            font-weight: bold;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-header .nav-link{
            height:0%;
        }

        /* Glassmorphism Sidebar */
        .glass-sidebar {
            background: rgba(25, 60, 95, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            color: #f0f4f8;
            padding: 1rem 0;
            transition: background-color 0.3s ease;
        }

        .glass-sidebar .nav-link {
            color: #e8e8e8;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .glass-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            box-shadow: 0 0 8px #9fc5e8;
        }

        .glass-sidebar .nav-link.active {
            background: linear-gradient(135deg, #4a90e2, #193c5f);
            color: #fff;
            box-shadow: 0 0 10px #3b7ddd;
        }

        .glass-sidebar .nav-link .nav-icon {
            color: #a9bcd0;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .glass-sidebar .nav-link:hover .nav-icon,
        .glass-sidebar .nav-link.active .nav-icon {
            color: #ffffff;
        }

        .glass-sidebar .nav-header {
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            color: #9bb8d9;
            padding-left: 15px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        /* Submenu treeview */
        .nav-treeview {
            transition: max-height 0.3s ease, opacity 0.3s ease;
            overflow: hidden;
        }

        .menu-open > .nav-treeview {
            max-height: 500px; /* suficiente para mostrar */
            opacity: 1;
        }

        .nav-treeview > .nav-item > .nav-link {
            padding-left: 25px;
            font-size: 0.9rem;
            color: #cedcf0;
        }

        .nav-treeview > .nav-item > .nav-link:hover,
        .nav-treeview > .nav-item > .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        /* Logo style */
        .glass-logo {
            background: rgba(255, 255, 255, 0.1);
            padding: 1px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: #e3efff;
            transition: background 0.3s ease;
        }

        .glass-logo:hover {
            background: rgba(255, 255, 255, 0.2);
        }

    </style>
</head>

<!-- Sección para inyectar scripts adicionales desde otras vistas -->
@stack('scripts')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Barra de navegación superior -->
        <nav class="main-header navbar navbar-expand">
            <!-- Menú lateral izquierda -->
            <ul class="navbar-nav" style="color: black !important">
                <li class="nav-item">
                    <!-- Botón para expandir/colapsar el menú lateral -->
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button" style="color: black !important">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <!-- Enlace al panel principal -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.index') }}" class="nav-link" style="color: black !important">
                        <i class="fas fa-heartbeat text-danger mr-1"></i>Sistema de Gestión Médica
                    </a>
                </li>
            </ul>

            <!-- Información del usuario (parte derecha del navbar) -->
            @php
                // Obtenemos el usuario autenticado
                $user = Auth::user();

                // Obtenemos el nombre "crudo" del primer rol del usuario
                $rolRaw = $user->roles->pluck('name')->first();

                // Diccionario para traducir los nombres de rol a su forma legible
                $rolesTraducidos = [
                    'admin' => 'Administrador',
                    'patient' => 'Paciente',
                    'doctor' => 'Doctor',
                ];

                // Usamos la traducción si existe, o capitalizamos la primera letra si no está en el diccionario
                $rol = $rolesTraducidos[$rolRaw] ?? ucfirst($rolRaw);

                // Inicializamos variable para el nombre completo
                $nombreCompleto = '';

                // Si el rol es 'doctor' y tiene relación con el modelo Doctor, formateamos con "Dr." delante
                if ($rolRaw === 'doctor' && $user->doctor) {
                    $nombreCompleto = 'Dr. ' . $user->doctor->name . ' ' . $user->doctor->last_name;

                // Si el rol es 'patient' y tiene relación con el modelo Paciente
                } elseif ($rolRaw === 'patient' && $user->paciente) {
                    $nombreCompleto = $user->paciente->nombre . ' ' . $user->paciente->apellido;

                // En caso de que no tenga relaciones, usamos el nombre del usuario como fallback
                } else {
                    $nombreCompleto = $user->name;
                }
            @endphp

            <ul class="navbar-nav ml-auto">
                <!-- Texto de bienvenida con nombre completo y rol -->
                <li class="nav-item d-flex align-items-center" style="font-style: italic;">
                    Bienvenido, {{ $nombreCompleto }} - {{ $rol }}
                </li>

                <!-- Icono de usuario con menú desplegable -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Icono de perfil de usuario -->
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>

                    <!-- Menú desplegable (dropdown) -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- Opción para editar perfil -->
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Editar perfil
                        </a>

                        <!-- Opción para cerrar sesión -->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>

                        <!-- Formulario oculto que se dispara al hacer clic en "Cerrar sesión" -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Fin del navbar -->

        <!-- Contenedor lateral (sidebar) -->
        <aside class="main-sidebar glass-sidebar elevation-4" style="padding-top: 0px">
            <!-- Logo de la marca -->
            <a href="{{ route('admin.index') }}" class="brand-link d-flex align-items-center glass-logo">
                <img src="{{ url('dist/img/Logo.png') }}" alt="Logo" style="width: 65px; height: 65px;">
                <span class="brand-text fw-bold">SALUD AGENDA</span>
            </a>

            <!-- Panel lateral con datos del usuario -->
            <div class="sidebar">
                <!-- Menú de navegación lateral -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-header glass-header">NAVEGACIÓN</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-home text-white"></i>
                                <p>Inicio</p>
                            </a>
                        </li>

                        @can('admin.user.index')
                            <li class="nav-header glass-header">GESTIÓN DE ACCESO</li>

                            <li class="nav-item has-treeview {{ request()->is('admin/user*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }} text-white">
                                    <i class="nav-icon fas fa-users text-white"></i>
                                    <p>Usuarios<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                                            <i class="fas fa-list-alt nav-icon"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.create') }}" class="nav-link {{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                                            <i class="fas fa-user-plus nav-icon"></i>
                                            <p>Crear Nuevo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        <li class="nav-header glass-header">MÓDULOS MÉDICOS</li>

                        <li class="nav-item has-treeview {{ request()->is('admin/specialties*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/specialties*') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-heartbeat text-white"></i>
                                <p>Especialidades<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.specialties.index') }}" class="nav-link {{ request()->routeIs('admin.specialties.index') ? 'active' : '' }}">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.specialties.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.specialties.create') }}" class="nav-link {{ request()->routeIs('admin.specialties.create') ? 'active' : '' }}">
                                            <i class="fas fa-plus-square nav-icon"></i>
                                            <p>Crear Nueva</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item has-treeview {{ request()->is('admin/doctors*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/doctors*') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-user-md text-white"></i>
                                <p>Médicos<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.index') ? 'active' : '' }}">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.doctors.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.doctors.create') }}" class="nav-link {{ request()->routeIs('admin.doctors.create') ? 'active' : '' }}">
                                            <i class="fas fa-user-plus nav-icon"></i>
                                            <p>Crear Nuevo</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @can('admin.patients.index')
                            <li class="nav-item has-treeview {{ request()->is('admin/patients*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('admin/patients*') ? 'active' : '' }} text-white">
                                    <i class="fas fa-procedures nav-icon text-white"></i>
                                    <p>Pacientes<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.patients.index') }}" class="nav-link {{ request()->routeIs('admin.patients.index') ? 'active' : '' }}">
                                            <i class="fas fa-list-alt nav-icon"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    @can('admin.patients.create')
                                        <li class="nav-item">
                                            <a href="{{ route('admin.patients.create') }}" class="nav-link {{ request()->routeIs('admin.patients.create') ? 'active' : '' }}">
                                                <i class="fas fa-user-plus nav-icon"></i>
                                                <p>Crear Nuevo</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <li class="nav-header glass-header">CITAS MÉDICAS</li>

                        <li class="nav-item has-treeview {{ request()->is('admin/schedules*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/schedules*') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-clock text-white"></i>
                                <p>Horarios<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.schedules.index') }}" class="nav-link {{ request()->routeIs('admin.schedules.index') ? 'active' : '' }}">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.schedules.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.schedules.create') }}" class="nav-link {{ request()->routeIs('admin.schedules.create') ? 'active' : '' }}">
                                            <i class="fas fa-plus-circle nav-icon"></i>
                                            <p>Crear Nuevo</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item">
                            @if($rolRaw === 'patient' || $rolRaw === 'doctor')
                                <a href="{{ route('admin.events.show') }}" class="nav-link text-white">
                                    <i class="nav-icon fas fa-calendar-check text-white"></i>
                                    <p>Mis Citas</p>
                                </a>
                            @elseif($rolRaw === 'admin')
                                <a href="{{ route('admin.events.index') }}" class="nav-link text-white">
                                    <i class="nav-icon fas fa-calendar-check text-white"></i>
                                    <p>Citas Reservadas</p>
                                </a>
                            @endif
                        </li>


                        <li class="nav-header glass-header">INFORMES</li>
                        @can('admin.user.index')
                            <li class="nav-item has-treeview">
                                <a href="{{ route('admin.reports.index') }}" class="nav-link text-white">
                                    <i class="fas fa-file-pdf nav-icon text-white"></i>
                                    <p>Listados PDF</p>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.medical_histories.index') }}" class="nav-link text-white">
                                <i class="fas fa-file-medical-alt nav-icon text-white"></i>
                                <p>Historial Médico</i></p>
                            </a>
                        </li>

                        <!-- Sección: Cuenta -->
                        <li class="nav-header glass-header">CUENTA</li>
                            
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link text-white">
                                <i class="fas fa-user-edit nav-icon text-white"></i>
                                <p>Editar perfil</i></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                               class="nav-link text-white"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt text-white"></i>
                                <p>Cerrar Sesión</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
        
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- Éxito, advertencia, info, etc --}}
        @if (Session::has('message') && Session::has('icon'))
            <script>
                Swal.fire({
                    icon: "{{ Session::get('icon') }}",
                    title: "{{ Session::get('title', '¡Listo!') }}",
                    text: "{{ Session::get('message') }}",
                    background: "{{ Session::get('icon') === 'error' ? '#f8d7da' : '#e9f9ee' }}",
                    color: "{{ Session::get('icon') === 'error' ? '#721c24' : '#155724' }}",
                    iconColor: "{{ Session::get('icon') === 'error' ? '#dc3545' : '#28a745' }}",
                    showConfirmButton: {{ Session::get('icon') === 'error' ? 'true' : 'false' }},
                    timer: {{ Session::get('timer', 3000) }},
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: "{{ Session::get('icon') === 'error' ? '#dc3545' : '#28a745' }}",
                    customClass: {
                        popup: 'border shadow rounded-4 px-4 py-3',
                        title: 'fw-semibold fs-5',
                        confirmButton: 'btn px-4 py-2'
                    },
                    buttonsStyling: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            </script>
        @endif

        <!-- Contenedor principal del contenido -->
        <div class="content-wrapper">
            
             <!-- Encabezado de contenido (Título y breadcrumb) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <!-- Breadcrumb (navegación secundaria) -->
                    <div class="col-sm-12" style="text-align: right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">{{ $vistaActual }}</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->

            
            <!-- Contenido dinámico de cada vista -->
            <div class="container">
                @yield('content')
            </div>
        </div>
        <!-- /.control-sidebar -->

        <!-- Pie de página (footer) -->
        <footer class="main-footer text-center">
            <!-- Información por defecto a la izquierda -->
            <p>© <strong>Salud Agenda</strong> - Todos los derechos reservados. Desarrollado por Ángel Otero Burgos</p></p>
        </footer>
    </div>
    
    <!-- ./wrapper -->

    <!-- SCRIPTS NECESARIOS PARA LA FUNCIONALIDAD DE LA APP -->

    <!-- Bootstrap 4 (necesario para elementos interactivos) -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugins de DataTables (para tablas interactivas, exportar, paginar, etc.) -->    
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Script principal de AdminLTE (plantilla base del dashboard) -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>

    <!-- Colapsar el sidebar automáticamente en tablets (ancho entre 768px y 991px) 
    para evitar que bloquee la navbar y el contenido principal -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.innerWidth >= 768 && window.innerWidth <= 991) {
                document.body.classList.add("sidebar-collapse");
            }
        });
    </script>
    
</body>

</html>
