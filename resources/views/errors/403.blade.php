<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 403 | SaludAgenda</title>

  <!-- Fuente e iconos -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Estilos personalizados -->
  <style>
    body { 
      font-family: 'Inter', sans-serif;
      background-color: #001e3d;
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }

    .fade-in {
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in .btn {
      opacity: 0;
      animation: fadeBtn 0.5s ease-in-out 0.6s forwards;
    }

    @keyframes fadeBtn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn:hover {
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.5);
      transition: box-shadow 0.3s ease-in-out;
    }

    /* Estilo para el botón */
    .btn-primary {
      background-color: #005cb8;
      color: white;
      font-size: 16px;
      padding: 10px 25px;
      border-radius: 25px;
      display: inline-flex;
      align-items: center;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #001e3d;
      box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-primary i {
      margin-right: 8px;
    }

    /* Contenedor de la tarjeta */
    .card {
      background-color: #e6f2f9;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    /* Imagen de error */
    img {
      max-width: 100%;
      height: auto;
      margin-bottom: 20px;
    }

  </style>
</head>

<body>
  <div class="fade-in">
    <div class="card">
      <!-- Imagen de error 403 -->
      <img src="{{ url('/dist/img/error-403.png') }}" alt="Error 403" style="max-width: 400px; height: auto;" class="max-w-full h-auto mb-6 mx-auto">

      <!-- Mensaje de error -->
      <h1 class="text-3xl font-semibold text-gray-800 mb-4">¡Acceso Denegado!</h1>
      <p class="text-lg text-gray-600 mb-6">Lo sentimos, no tienes permisos para acceder a esta página.</p>

      <!-- Botón para volver al inicio -->
      <a href="{{ route('admin.index') }}" class="btn btn-primary">
        <i class="fas fa-home"></i> Volver a Inicio
      </a>
    </div>
  </div>
</body>
</html>
