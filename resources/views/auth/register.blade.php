<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Cuenta</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #C4FFFF;
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      color: #1f2937;
    }

    .max-w-4xl{
      max-width: 70rem !important;
    }

    input, select {
      width: 100%;
      padding: 8px !important;
      font-size: 14px !important;
      border: 1px solid #ccc;
      border-radius: 0.75rem;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus, select:focus {
      border-color: #3FBBC0;
      box-shadow: 0 0 0 2px #C4FFFF;
    }
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-4xl flex">

    <!-- Lado Izquierdo -->
    <div class="w-1/2 bg-[#3FBBC0] text-white flex flex-col justify-center items-center p-10">
      <h2 class="text-4xl font-bold mb-2">¡Únete a nosotros!</h2>
      <p class="text-sm text-center">Crea tu cuenta y accede a tu ficha de paciente en línea.</p>
    </div>

    <!-- Lado Derecho -->
    <div class="w-1/2 p-10">
      <h3 class="text-2xl font-semibold mb-6 text-[#3FBBC0] text-center">Crea tu cuenta</h3>

      <p class="text-sm text-gray-600 mb-4">
        Si ya eres paciente, solo completa tu nombre, correo, contraseña y DNI.<br>
        Si no, rellena los demás campos para crear tu ficha.
      </p>

      {{-- Mostrar errores generales --}}
      @if ($errors->any())
        <div class="mb-4">
          <ul class="text-red-500 text-sm list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

<form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
  @csrf

  <!-- Nombre -->
  <div>
    <label for="name" class="block text-sm font-medium">Nombre *</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <!-- Apellidos -->
  <div>
    <label for="last_name" class="block text-sm font-medium">Apellidos</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
  </div>

  <!-- Fecha de nacimiento -->
  <div>
    <label for="dob" class="block text-sm font-medium">Fecha de nacimiento</label>
    <input type="date" name="dob" id="dob" value="{{ old('dob') }}">
  </div>

  <!-- DNI -->
  <div>
    <label for="dni" class="block text-sm font-medium">DNI/NIE</label>
    <input type="text" name="dni" id="dni" value="{{ old('dni') }}">
    @error('dni') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

 
  <!-- Dirección -->
  <div class="col-span-2">
    <label for="address" class="block text-sm font-medium">Dirección</label>
    <input type="text" name="address" id="address" value="{{ old('address') }}">
  </div>
  
  <!-- Código postal -->
  <div>
    <label for="postal_code" class="block text-sm font-medium">Código Postal</label>
    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}">
  </div>
  
  <!-- Sexo -->
  <div>
    <label for="sex" class="block text-sm font-medium">Sexo</label>
    <select name="sex" id="sex">
      <option value="">Selecciona</option>
      <option value="hombre" {{ old('sex') == 'hombre' ? 'selected' : '' }}>Hombre</option>
      <option value="mujer" {{ old('sex') == 'mujer' ? 'selected' : '' }}>Mujer</option>
    </select>
  </div>

  <!-- Teléfono -->
  <div>
    <label for="phone" class="block text-sm font-medium">Teléfono</label>
    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}">
  </div>

  <!-- Teléfono de emergencia -->
  <div>
    <label for="phone_emergence" class="block text-sm font-medium">Teléfono de emergencia</label>
    <input type="tel" name="phone_emergence" id="phone_emergence" value="{{ old('phone_emergence') }}">
  </div>

  <!-- Email -->
  <div class="col-span-2">
    <label for="email" class="block text-sm font-medium">Correo electrónico *</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <!-- Contraseña -->
  <div>
    <label for="password" class="block text-sm font-medium">Contraseña *</label>
    <input type="password" name="password" id="password" required>
    <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, una mayúscula y un número.</p>
    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <!-- Confirmar contraseña -->
  <div>
    <label for="password_confirmation" class="block text-sm font-medium">Confirmar contraseña *</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
  </div>

  <!-- Botón -->
  <div class="col-span-2">
    <button type="submit"
      class="w-full bg-[#3FBBC0] hover:bg-[#3FBBC0] hover:shadow-lg text-white font-semibold py-3 rounded-xl transition-transform transform hover:scale-105">
      Registrarse
    </button>
  </div>
</form>


      <p class="mt-6 text-center text-sm">
        ¿Ya tienes una cuenta?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a>
      </p>
    </div>
  </div>
</body>
</html>
