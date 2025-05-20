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
      <h2 class="text-4xl font-bold mb-4">¿Olvidaste tu contraseña?</h2>
      <p class="text-sm text-center">
        No te preocupes, aquí puedes restablecerla fácilmente.<br>
        Solo ingresa tu correo electrónico, tu nueva contraseña y confírmala.<br><br>
        El enlace de restablecimiento es seguro y expira en 60 minutos.
      </p>
    </div>

    {{-- Lado Derecho --}}
    <div class="w-full sm:w-1/2 p-10">

      <h3 class="text-2xl font-semibold mb-6 text-[#3FBBC0] text-center">Restablecer contraseña</h3>

      <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium">Correo electrónico</label>
          <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
          @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div>
          <label for="password" class="block text-sm font-medium">Nueva contraseña</label>
          <input id="password" type="password" name="password" required autocomplete="new-password">
          <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, una mayúscula y un número.</p>
          @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div>
          <label for="password_confirmation" class="block text-sm font-medium">Confirmar contraseña</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        {{-- Botón --}}
        <button type="submit" 
          class="w-full bg-[#3FBBC0] hover:bg-[#3FBBC0] hover:shadow-lg text-white font-semibold py-3 rounded-xl transition-transform transform hover:scale-105 duration-300">
          Restablecer contraseña
        </button>
      </form>

    </div>

  </div>

</body>
</html>
