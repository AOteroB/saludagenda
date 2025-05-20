<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Restablecer Contraseña | SaludAgenda</title>

  {{-- Fuente e iconos --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Estilos personalizados --}}
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #C4FFFF;
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    input[type="email"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 0.75rem;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="email"]:focus {
      border-color: #3FBBC0;
      box-shadow: 0 0 0 2px #C4FFFF;
    }

    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    @keyframes slideFadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .slide-fade-in {
      animation: slideFadeIn 1s ease forwards;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen text-gray-800">

  <div
    class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-4xl flex flex-col sm:flex-row slide-fade-in">

    {{-- Lado Izquierdo --}}
    <div
      class="hidden sm:flex w-1/2 bg-[#3FBBC0] text-white flex-col justify-center items-center p-10 animate-slide-in-left">
      <h2 class="text-4xl font-bold mb-4">¿Olvidaste tu contraseña?</h2>
      <p class="text-sm text-center">No te preocupes, ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
    </div>

    {{-- Lado Derecho --}}
    <div class="w-full sm:w-1/2 p-10">
      <h3 class="text-2xl font-semibold mb-6 text-[#3FBBC0] text-center">Restablecer contraseña</h3>

      {{-- Mensaje de estado --}}
      @if (session('status'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        {{ session('status') }}
      </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium">Correo electrónico</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
          @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Botón --}}
        <button type="submit"
          class="w-full bg-[#3FBBC0] hover:bg-[#3FBBC0] hover:shadow-lg text-white font-semibold py-3 rounded-xl transition-transform transform hover:scale-105 duration-300">
          Enviar enlace para restablecer
        </button>
      </form>

      {{-- Link al login --}}
      <p class="mt-6 text-center text-sm">
        ¿Recordaste tu contraseña?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a>
      </p>

    </div>

  </div>

</body>
</html>
