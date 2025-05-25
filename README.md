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

💡 **Notas Importantes:**  
El proyecto incluye assets precompilados, por lo que puede funcionar sin ejecutar npm install ni npm run dev.
Sin embargo, para modificar o compilar los archivos frontend (JS, SCSS, etc.), debes ejecutar ambos comandos.
Si no ejecutas npm run dev, la interfaz podría no reflejar cambios recientes en el frontend.

Por defecto, el proyecto está configurado para usar el driver de correo log, lo que significa que los emails se registran en los logs y no se envían realmente. Esto evita errores si no tienes un servidor SMTP activo en desarrollo.
Si quieres probar el envío real de correos, puedes usar Mailpit como servidor SMTP local. Para ello:

1. Cambia en .env la configuración del mailer a SMTP apuntando a Mailpit (ya configurado en .env.example comentado).

2. Ejecuta Mailpit:

    ```bash
    mailpit
    ```
3. Luego accede a [http://localhost:8025] para ver los correos enviados (confirmaciones, cancelaciones de citas, restablecimiento de contraseña, etc.).

> **Importante:**
> Ejecutar Mailpit y configurar el .env para SMTP es opcional y solo necesario si quieres pruebas reales de correo.

---

## 🧪 Testing

```bash
php artisan test
```
---

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

> ⚠️ **Importante:**  
> El resto de los usuarios en la base de datos también tienen la contraseña 123456789A, por lo que puedes usarla para realizar pruebas adicionales con diferentes cuentas.

---

## 📂 Base de datos

Se incluye el archivo `saludagenda.sql` para importar en tu gestor de base de datos (por ejemplo, phpMyAdmin).

> ⚠️ **Importante:**  
> Si ejecutas solo las migraciones (`php artisan migrate`), **los usuarios de prueba no se crearán automáticamente**.  
> Asegúrate de importar la base de datos si deseas usar las cuentas de prueba mencionadas.

También recuerda revisar que la configuración `.env` esté correctamente ajustada a tu entorno local.