# Proyecto Laravel 10

Este es un proyecto basado en Laravel 10 que utiliza **Vite**, **Bootstrap**, **FullCalendar** y **SweetAlert2** en el frontend.

## 🧰 Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL u otra base de datos compatible

## 🚀 Instalación

1. Clona el repositorio

```bash
git clone https://github.com/AOteroB/saludagenda.git
cd tu-repo
```

2. Instala las dependencias de PHP y JS

```bash
composer install
npm install
```

3. Copia el archivo de entorno y genera la clave de la app

```bash
cp .env.example .env
php artisan key:generate
```

4. Configura la base de datos en `.env`

5. Ejecuta las migraciones

```bash
php artisan migrate
```

6. Inicia los servidores de desarrollo

En una terminal:

```bash
php artisan serve
```

En otra terminal:

```bash
npm run dev
```

> Esto es necesario para compilar los assets con Vite (JS, SCSS, etc).

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
