<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Inicio - Salud Agenda</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ url('dist/img/Logo.png') }}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
          <i class="bi bi-clock me-1"></i> Lunes - Sábado, de 08:00 a 22:00 
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-phone me-1"></i> Llámanos +34 111 222 333
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <img src="assets/img/Logotipo.png" alt="Logo">
          <h1 class="sitename">Salud Agenda</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Inicio</a></li>
            <li><a href="#services">Servicios</a></li>
            <li><a href="#specialties">Áreas Médicas</a></li>
            <li><a href="#contact">Contacto</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn" href="{{ route('login') }}">Iniciar Sesión</a>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>¡Bienvenido a Salud Agenda!</h3>
              <p>Con Salud Agenda puedes gestionar tus citas médicas de manera fácil, rápida y segura. Encuentra especialistas, elige el horario que mejor te convenga y lleva el control de tu salud desde un solo lugar.</p>
              <a class="cta-btn" href="{{ route('login') }}">Iniciar sesión</a>
              <a class="cta-btn" href="{{ route('register') }}">Registrarse</a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="services" class="featured-services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Servicios</h2>
        <p>Pensado para pacientes, creado para profesionales</p>
      </div><!-- End Section Title -->
      <div class="container">

        <div id="service-rotator">

          <!-- Grupo 1: Servicios para pacientes -->
          <div class="row gy-4 service-group active">

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-calendar-check icon"></i></div>
                <h4><a href="" class="stretched-link">Reserva de citas en línea</a></h4>
                <p>Agenda tu consulta médica en pocos minutos, desde cualquier dispositivo y sin complicaciones.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-heartbeat icon"></i></div>
                <h4><a href="" class="stretched-link">Acceso a especialistas</a></h4>
                <p>Elige entre una amplia variedad de médicos y especialidades para encontrar la atención que necesitas.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-clock icon"></i></div>
                <h4><a href="" class="stretched-link">Gestión de horarios</a></h4>
                <p>Consulta la disponibilidad en tiempo real y selecciona el horario que mejor se adapte a tu agenda.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-phone-alt icon"></i></div>
                <h4><a href="" class="stretched-link">Ayuda por teléfono</a></h4>
                <p>¿Necesitas ayuda? Nuestro equipo puede ayudarte a agendar tu cita por teléfono.</p>
              </div>
            </div>

          </div>

          <!-- Grupo 2: Servicios para clínicas -->
          <div class="row gy-4 service-group">

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-tools icon"></i></div>
                <h4><a href="" class="stretched-link">Gestión integral de citas</a></h4>
                <p>Optimiza la planificación de consultas médicas y evita tiempos muertos en la agenda.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-chart-line icon"></i></div>
                <h4><a href="" class="stretched-link">Reportes y métricas</a></h4>
                <p>Accede a estadísticas de asistencia, cancelaciones y desempeño del equipo médico.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-users-cog icon"></i></div>
                <h4><a href="" class="stretched-link">Multiusuario con roles</a></h4>
                <p>Define permisos y accesos para médicos, recepcionistas y administradores.</p>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
              <div class="service-item position-relative">
                <div class="icon"><i class="fas fa-lock icon"></i></div>
                <h4><a href="" class="stretched-link">Seguridad y privacidad</a></h4>
                <p>Datos protegidos conforme a la normativa de protección de datos sanitarios.</p>
              </div>
            </div>

          </div>

        </div>

        <!-- Controles manuales -->
        <div class="service-controls text-center mt-4">
          <button id="prevService" class="btn btn-light me-2"><i class="fas fa-chevron-left"></i></button>
          <button id="nextService" class="btn btn-light"><i class="fas fa-chevron-right"></i></button>
        </div>

      </div>

    </section><!-- /Services Section -->

    <style>
      .service-group {
        display: none;
        transition: opacity 0.5s ease-in-out;
      }
      .service-group.active {
        display: flex;
        flex-wrap: wrap;
      }
      #prevService, #nextService {
        background-color: #3FBBC0;
        color: white;
      }

      #prevService:hover, #nextService:hover {
        background-color: white; 
        color: #3FBBC0; 
        border: 1px solid #3FBBC0; 
      }
    </style>

    <script>
      let currentService = 0;
      const serviceGroups = document.querySelectorAll('#service-rotator .service-group');
      const totalGroups = serviceGroups.length;

      function showService(index) {
        serviceGroups.forEach(group => group.classList.remove('active'));
        serviceGroups[index].classList.add('active');
      }

      function nextService() {
        currentService = (currentService + 1) % totalGroups;
        showService(currentService);
      }

      function prevService() {
        currentService = (currentService - 1 + totalGroups) % totalGroups;
        showService(currentService);
      }

      // Cambio automático cada 8 segundos
      setInterval(nextService, 8000);

      // Eventos para botones
      document.getElementById('nextService').addEventListener('click', nextService);
      document.getElementById('prevService').addEventListener('click', prevService);
    </script>


    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-user-md flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalDoctors }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Doctores</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="far fa-hospital flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalSpecialties }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Especialidades</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-flask flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
                <p>Laboratorios</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-user-check flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalUsers ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Usuarios</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <div class="row justify-content-around gy-4">
          <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="assets/img/about.jpg" alt=""></div>

          <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <h3>¿Por qué elegir nuestra plataforma médica?</h3>
            <p>Hacemos que tu experiencia de atención médica sea más simple, segura y eficiente. Estas son algunas de nuestras ventajas más valoradas:</p>

            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
              <i class="fa-solid fa-hand-holding-medical flex-shrink-0"></i>
              <div>
                <h4><a class="stretched-link">Atención médica sin complicaciones</a></h4>
                <p>Reserva citas, consulta horarios o encuentra especialistas desde tu móvil sin necesidad de llamadas ni papeleo.</p>
            </div>
            </div><!-- End Icon Box -->

            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
              <i class="fa-solid fa-suitcase-medical flex-shrink-0"></i>
              <div>
                <h4><a class="stretched-link">Amplia red de especialistas</a></h4>
                <p>Accede a médicos de diversas especialidades en clínicas de confianza, todo desde una sola plataforma.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
              <i class="fa-solid fa-flask flex-shrink-0"></i>
              <div>
                <h4><a href="" class="stretched-link">Vinculación con laboratorios</a></h4>
                <p>Colaboramos con centros de investigación y laboratorios certificados para mejorar el diagnóstico y tratamiento.</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
              <i class="fa-solid fa-user-shield flex-shrink-0"></i>
              <div>
                <h4><a href="#" class="stretched-link">Seguridad y privacidad de tus datos</a></h4>
                <p>Tu información médica está protegida bajo estrictos estándares de seguridad y confidencialidad digital.</p>
              </div>
            </div><!-- End Icon Box -->
          </div>
        </div>
      </div>
    </section><!-- /Features Section -->

    <!-- Tabs Section -->
    <section id="specialties" class="tabs section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Especialidades</h2>
        <p>Contamos con una amplia variedad de especialidades médicas para ofrecerte una atención integral y personalizada en cada etapa de tu salud.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    
                <!-- Especialidades visibles -->
                  <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-general">Medicina General</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-pediatria">Pediatría</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-cardiologia">Cardiología</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-dermatologia">Dermatología</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-oftalmologia">Oftalmología</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-traumatologia">Traumatología y Ortopedia</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-mas">Ver más</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
              
                  <div class="tab-pane active show" id="tab-general">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Medicina General</h3>
                        <p class="fst-italic">Atención primaria para todas las edades, desde la prevención hasta el tratamiento.</p>
                        <p>Evaluamos y gestionamos de forma integral las necesidades de salud, brindando atención personalizada y derivaciones especializadas si es necesario.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
              
                  <div class="tab-pane" id="tab-pediatria">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Pediatría</h3>
                        <p class="fst-italic">Cuidamos la salud y el desarrollo de los más pequeños.</p>
                        <p>Desde recién nacidos hasta adolescentes, ofrecemos seguimiento y prevención de enfermedades infantiles con un enfoque cálido y profesional.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
              
                  <div class="tab-pane" id="tab-cardiologia">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Cardiología</h3>
                        <p class="fst-italic">Diagnóstico y tratamiento de enfermedades cardiovasculares.</p>
                        <p>Contamos con tecnología avanzada para prevenir, detectar y tratar afecciones del corazón y los vasos sanguíneos.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
              
                  <div class="tab-pane" id="tab-dermatologia">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Dermatología</h3>
                        <p class="fst-italic">Cuidado y tratamiento de la piel, cabello y uñas.</p>
                        <p>Abordamos desde condiciones comunes como el acné hasta enfermedades dermatológicas complejas con un enfoque estético y médico.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/gallery-3.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
              
                  <div class="tab-pane" id="tab-oftalmologia">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Oftalmología</h3>
                        <p class="fst-italic">Salud visual en todas las etapas de la vida.</p>
                        <p>Tratamos afecciones oculares como miopía, cataratas o glaucoma, con diagnóstico especializado y soluciones quirúrgicas cuando se requieren.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
              
                  <div class="tab-pane" id="tab-traumatologia">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Traumatología y Ortopedia</h3>
                        <p class="fst-italic">Recuperamos tu movilidad y calidad de vida.</p>
                        <p>Atención integral en lesiones musculoesqueléticas, fracturas, artrosis y rehabilitación postquirúrgica con un equipo altamente especializado.</p>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/gallery-7.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab-mas">
                    <div class="row">
                      <div class="col-lg-8 details">
                        <h3>Otras Especialidades</h3>
                        <p class="fst-italic">Conoce todas las demás especialidades disponibles en nuestro centro.</p>
                        <ul>
                          <li><strong>Ginecología y Obstetricia:</strong> Revisiones, embarazos, control hormonal, etc.</li>
                          <li><strong>Otorrinolaringología (ORL):</strong> Oídos, nariz y garganta.</li>
                          <li><strong>Endocrinología:</strong> Hormonas, tiroides, diabetes, obesidad.</li>
                          <li><strong>Neurología:</strong> Sistema nervioso, dolores de cabeza, epilepsia, etc.</li>
                          <li><strong>Urología:</strong> Sistema urinario masculino y femenino, próstata.</li>
                          <li><strong>Alergología:</strong> Diagnóstico y tratamiento de alergias.</li>
                          <li><strong>Neumología:</strong> Pulmones, asma, apnea del sueño, EPOC.</li>
                          <li><strong>Hematología:</strong> Enfermedades de la sangre, anemias, leucemias.</li>
                          <li><strong>Oncología:</strong> Cáncer y tratamiento oncológico.</li>
                          <li><strong>Nefrología:</strong> Enfermedades renales.</li>
                          <li><strong>Nutrición y Dietética:</strong> Alimentación equilibrada y seguimiento nutricional.</li>
                        </ul>
                      </div>
                      <div class="col-lg-4 text-center">
                        <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section><!-- /Tabs Section -->
  </main>

  <footer id="footer" class="footer light-background" style="background-color: #c4ffff;">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-6 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Salud Agenda</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Calle de Ejemplo, Cádiz</p>
            <p class="mt-3"><strong>Teléfono:</strong> <span>+34 111 222 333</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
  
        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Enlaces útiles</h4>
          <ul>
            <li><a href="#hero">Inicio</a></li>
            <li><a>Sobre nosotros</a></li>
            <li><a href="#specialties">Especialidades</a></li>
            <li><a>Términos y condiciones</a></li>
            <li><a>Política de privacidad</a></li>
          </ul>
        </div>
  
        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Atención al paciente</h4>
          <ul>
            <li><a href="{{ route('login') }}">Pedir cita</a></li>
            <li><a>Preguntas frecuentes</a></li>
            <li><a>Soporte</a></li>
            <li><a>Contacto</a></li>
          </ul>
        </div>
      </div>
    </div>
  
    <div class="container copyright text-center mt-4">
      <p>© <strong class="px-1 sitename">Salud Agenda</strong> - Todos los derechos reservados</p>
    </div>
  
  </footer>
  

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>