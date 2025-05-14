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
        .nav-sidebar .nav-link:hover {
            background: rgba(222, 225, 227, 0.3);
            border-radius: 0.25rem;
        }

        .nav-sidebar .nav-link.active {
            background-color: #6a7c97 !important;
            color: white !important;
        }

        .nav-header {
            font-weight: bold;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>

<!-- Sección para inyectar scripts adicionales desde otras vistas -->
@stack('scripts')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Barra de navegación superior -->
        <nav class="main-header navbar navbar-expand" style="background:#193c5f; color: white;">
            <!-- Menú lateral izquierda -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Botón para expandir/colapsar el menú lateral -->
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <!-- Enlace al panel principal -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.index') }}" class="nav-link text-white font-weight-bold">
                        <i class="fas fa-heartbeat text-danger mr-1"></i>Sistema de Gestión Médica
                    </a>
                </li>
            </ul>

            <!-- Información del usuario (parte derecha del navbar) -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle nav-link" alt="Imagen de Usuario" style="height: 35px;">
                </li>
            </ul>
        </nav>
        <!-- Fin del navbar -->

        <!-- Contenedor lateral (sidebar) -->
        <aside class="main-sidebar elevation-4" style="background: #193c5f; color: white;">
            <!-- Logo de la marca -->
            <a href="{{ route('admin.index') }}" class="brand-link d-flex align-items-center">
                <img src="{{ url('dist/img/Logo.png') }}" class="img-circle elevation-2" alt="Logo" style="width: 65px; height: 65px; margin-right:5px">
                <span class="brand-text fw-bold text-white"> SALUD AGENDA</span>
            </a>

            <!-- Panel lateral con datos del usuario -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom border-secondary">
                    <div class="info ms-2">
                        <a href="#" class="d-block text-white fw-semibold">
                            {{ Auth::user()->name }} - 
                            {{ Auth::user()->roles->pluck('name')->first() }} <!-- Muestra el rol del usuario -->
                        </a>
                    </div>
                </div>

                <!-- Menú de navegación lateral -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-header text-white">NAVEGACIÓN</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-home text-white"></i>
                                <p>Inicio</p>
                            </a>
                        </li>

                        @can('admin.user.index')
                            <li class="nav-header text-white">GESTIÓN DE ACCESO</li>

                            <li class="nav-item has-treeview {{ request()->is('admin/user*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }} text-white">
                                    <i class="nav-icon fas fa-users text-white"></i>
                                    <p>Usuarios<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }} text-white">
                                            <i class="fas fa-list-alt nav-icon text-white"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.create') }}" class="nav-link {{ request()->routeIs('admin.user.create') ? 'active' : '' }} text-white">
                                            <i class="fas fa-user-plus nav-icon text-white"></i>
                                            <p>Crear Nuevo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link text-white">
                                    <i class="nav-icon fas fa-user-shield text-white"></i>
                                    <p>Roles y Permisos</p>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-header text-white">MÓDULOS MÉDICOS</li>

                        <li class="nav-item has-treeview {{ request()->is('admin/specialties*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/specialties*') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-heartbeat text-white"></i>
                                <p>Especialidades<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.specialties.index') }}" class="nav-link {{ request()->routeIs('admin.specialties.index') ? 'active' : '' }} text-white">
                                        <i class="fas fa-list-alt nav-icon text-white"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.specialties.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.specialties.create') }}" class="nav-link {{ request()->routeIs('admin.specialties.create') ? 'active' : '' }} text-white">
                                            <i class="fas fa-plus-square nav-icon text-white"></i>
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
                                    <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.index') ? 'active' : '' }} text-white">
                                        <i class="fas fa-list-alt nav-icon text-white"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.doctors.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.doctors.create') }}" class="nav-link {{ request()->routeIs('admin.doctors.create') ? 'active' : '' }} text-white">
                                            <i class="fas fa-user-plus nav-icon text-white"></i>
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
                                        <a href="{{ route('admin.patients.index') }}" class="nav-link {{ request()->routeIs('admin.patients.index') ? 'active' : '' }} text-white">
                                            <i class="fas fa-list-alt nav-icon text-white"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    @can('admin.patients.create')
                                        <li class="nav-item">
                                            <a href="{{ route('admin.patients.create') }}" class="nav-link {{ request()->routeIs('admin.patients.create') ? 'active' : '' }} text-white">
                                                <i class="fas fa-user-plus nav-icon text-white"></i>
                                                <p>Crear Nuevo</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <li class="nav-header text-white">CITAS MÉDICAS</li>

                        <li class="nav-item has-treeview {{ request()->is('admin/schedules*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/schedules*') ? 'active' : '' }} text-white">
                                <i class="nav-icon fas fa-calendar-check text-white"></i>
                                <p>Horarios<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('admin.schedules.index') }}" class="nav-link {{ request()->routeIs('admin.schedules.index') ? 'active' : '' }} text-white">
                                        <i class="fas fa-calendar-alt nav-icon text-white"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                @can('admin.schedules.create')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.schedules.create') }}" class="nav-link {{ request()->routeIs('admin.schedules.create') ? 'active' : '' }} text-white">
                                            <i class="fas fa-plus-circle nav-icon text-white"></i>
                                            <p>Crear Nuevo</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-header text-white">INFORMES</li>

                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.reports.index') }}" class="nav-link text-white">
                                <i class="fas fa-file-medical-alt nav-icon text-white"></i>
                                <p>Listados PDF<i class="right fas fa-angle-left"></i></p>
                            </a>
                        </li>

                        <!-- Sección: Cuenta -->
                        <li class="nav-header text-white">CUENTA</li>
        
                        <li class="nav-item">
                            <a href=""
                               class="nav-link text-white"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text-danger">Cerrar Sesión</p>
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
        <div class="content-wrapper" style="background-color: #f4f7fc">
            
             <!-- Encabezado de contenido (Título y breadcrumb) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <!-- Título dinámico de la vista actual -->
                        <div class="col-sm-6">
                            <h4 class="font-weight-light text-dark m-0">{{ $vistaActual }}</h4>
                        </div><!-- /.col -->

                        <!-- Breadcrumb (navegación secundaria) -->
                        <div class="col-sm-6">
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
        <footer class="main-footer">
            <!-- Información adicional a la derecha (solo en pantallas medianas o grandes) -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Información por defecto a la izquierda -->
            <strong>Copyright &copy; 2025. <a>Ángel Otero Burgos</a>.</strong> Todos los derechos reservados.
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
