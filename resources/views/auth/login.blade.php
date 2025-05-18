<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión | SaludAgenda</title>

  {{-- Fuente e iconos --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Estilos personalizados --}}
  <style>
    body { 
      font-family: 'Inter', sans-serif;
      background-color: #C4FFFF;  
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 0.75rem;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #3FBBC0;
      box-shadow: 0 0 0 2px #C4FFFF;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
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

  <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-4xl flex flex-col sm:flex-row slide-fade-in"> 

    {{-- Lado Izquierdo --}}
    <div class="hidden sm:flex w-1/2 bg-[#3FBBC0] text-white flex-col justify-center items-center p-10 animate-slide-in-left">
      <h2 class="text-4xl font-bold mb-4">¡Bienvenido de nuevo!</h2>
      <p class="text-sm text-center">Nos alegra verte otra vez. Ingresa tus datos para continuar.</p>
    </div>

    {{-- Lado Derecho --}}
    <div class="w-full sm:w-1/2 p-10">
      <h3 class="text-2xl font-semibold mb-6 text-[#3FBBC0] text-center">Inicia sesión en tu cuenta</h3>

      <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium">Correo electrónico</label>
          <input type="email" value="{{ old('email') }}" name="email" id="email" required>
          @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Password --}}
        <div>
          <label for="password" class="block text-sm font-medium">Contraseña</label>
          <input type="password" name="password" id="password" required>
          @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Remember Me y Link --}}
        <div class="flex justify-between items-center text-sm">
          <label class="inline-flex items-center">
            <input type="checkbox" name="remember" class="form-checkbox">
            <span class="ml-2">Recuérdame</span>
          </label>
          <a href="#" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
        </div>

        {{-- Botón --}}
        <button type="submit"
          class="w-full bg-[#3FBBC0] hover:bg-[#3FBBC0] hover:shadow-lg text-white font-semibold py-3 rounded-xl transition-transform transform hover:scale-105 duration-300">
          Iniciar Sesión
        </button> 
      </form>

      {{-- Registro --}}
      <p class="mt-6 text-center text-sm">
        ¿No tienes una cuenta?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate</a>
      </p>

    </div>

  </div>

</body>
</html>
