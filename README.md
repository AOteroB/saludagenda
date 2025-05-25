# Proyecto Laravel 10

Este es un proyecto basado en Laravel 10 que utiliza **Vite**, **Bootstrap**, **FullCalendar** y **SweetAlert2** en el frontend.

## 🧰 Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL u otra base de datos compatible

## 🚀 Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/AOteroB/saludagenda.git
cd saludagenda
```

2. Instala las dependencias de PHP y JS:

```bash
composer install
npm install
```

3. Copia el archivo de entorno y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configura la conexión a la base de datos en `.env`.

5. Ejecuta las migraciones:

```bash
php artisan migrate
```

6. Inicia los servidores de desarrollo:

En una terminal:

```bash
php artisan serve
```

En otra terminal:

```bash
npm run dev
```

💡 **Notas:**  
El proyecto está preparado para pruebas de envío de correo con Mailpit. Puedes ejecutarlo con:

```bash
mailpit
```

Luego accede a [http://localhost:8025](http://localhost:8025) para ver los correos enviados (confirmaciones, cancelaciones de citas, restablecimiento de contraseña, etc.).

> **Nota:** `npm run dev` es necesario para compilar los assets con Vite (JS, SCSS, etc).

## ⚙️ Comandos útiles

- `npm run dev` – Ejecuta Vite en modo desarrollo con recarga automática.
- `npm run build` – Compila los assets para producción.

## 🧪 Testing

```bash
php artisan test
```

## 📦 Paquetes destacados

- [laravel/ui](https://github.com/laravel/ui) – Autenticación básica y scaffolding.
- [spatie/laravel-permission](https://spatie.be/docs/laravel-permission) – Gestión de roles y permisos.
- [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) – Exportación de PDFs.

---

## 🧑‍💻 Autor

Ángel Otero – [AOteroB](https://github.com/AOteroB)

---

## 🧪 Cuentas de prueba

Puedes iniciar sesión con los siguientes usuarios para probar la aplicación con distintos roles:

| Rol      | Email                     | Contraseña   |
|----------|---------------------------|--------------|
| Admin    | admin@admin.com           | 123456789A   |
| Doctor   | medicina_1@example.com    | 123456789A   |
| Paciente | paciente0@example.com     | 123456789A   |

## 📂 Base de datos

Se incluye el archivo `saludagenda.sql` para importar en tu gestor de base de datos (por ejemplo, phpMyAdmin).

> ⚠️ **Importante:**  
> Si ejecutas solo las migraciones (`php artisan migrate`), **los usuarios de prueba no se crearán automáticamente**.  
> Asegúrate de importar la base de datos si deseas usar las cuentas de prueba mencionadas.

También recuerda revisar que la configuración `.env` esté correctamente ajustada a tu entorno local.