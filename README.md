# Inventario de Distribuidores

Aplicación en **PHP 8 sin frameworks** para gestionar distribuidores/locales con CRUD completo, búsqueda AJAX e imágenes.

## Requisitos

- PHP 8+
- Extensión `pdo_sqlite` habilitada

## Estructura

- `/public` interfaz web y endpoints HTTP
- `/api` endpoint de búsqueda en JSON
- `/src` lógica de base de datos y utilidades
- `/uploads` imágenes subidas
- `/data` base SQLite (`app.db`)

## Ejecutar

```bash
php -S localhost:8000 -t public
```

Abrir en navegador: [http://localhost:8000](http://localhost:8000)

## Funcionalidades

- Creación automática de la base de datos en `/data/app.db` y tabla `distributors` al primer acceso.
- Listado responsive con Bootstrap 5.
- Búsqueda AJAX en tiempo real (sin recargar la página).
- CRUD completo: crear, editar y eliminar con confirmación por `POST`.
- Subida de imagen (`JPG`, `PNG`, `WEBP`) con tamaño máximo de `3MB` y nombre único.

## Entrypoint

- El entrypoint principal de la app es `public/index.php`.
- Debes iniciar el servidor apuntando a `public`:

```bash
php -S localhost:8000 -t public
```

Si ves **"Not Found"**, normalmente es porque se inició el servidor sin `-t public`.

