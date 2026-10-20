# Miga · Punto de venta para panadería

Sistema local en español construido conservando la plantilla **Ember Table** del directorio `template/`. Incluye interfaz de caja, API JSON en PHP y base de datos SQLite persistente. No requiere instalar paquetes externos ni conexión a internet.

## Iniciar en XAMPP

1. Activa Apache desde XAMPP.
2. Abre `http://localhost/hotel/panaderia/`.
3. En el primer acceso crea el administrador local. El sistema no trae una contraseña predeterminada; elige una contraseña propia de al menos 12 caracteres y guárdala.
4. Desde **Usuarios**, crea las cuentas de cajero y administrador que necesites.

No hay autorregistro público para entrar a la caja: por seguridad, el administrador da de alta al personal desde **Usuarios**. Cada empleado inicia sesión con el usuario y contraseña que le asigne. Los clientes de la panadería se registran aparte desde **Clientes**.

También se puede ejecutar desde esta carpeta:

```powershell
C:\xamppp\php\php.exe -S 127.0.0.1:8087 router.php
```

Después abre `http://127.0.0.1:8087/`. Se requiere PHP 8.1 o posterior, PDO SQLite y mbstring. La primera carga crea `data/panaderia.sqlite`, migra las tablas que ya existían y conserva los productos y ventas guardados. PHP necesita permiso de escritura en `data/`. El directorio de datos queda bloqueado por `.htaccess` y `router.php`.

## Funciones

- Caja con búsqueda por nombre/código, filtro de categoría, cantidades, pago en efectivo, cambio y registro de tarjeta (no procesa cargos bancarios).
- Catálogo con alta, edición y desactivación; administración de categorías; clientes con búsqueda, puntos y baja lógica.
- Usuarios con roles **Administrador** y **Cajero**, contraseñas cifradas con `password_hash`, sesión, token CSRF y límite de intentos de acceso.
- Inventario con existencias mínimas, entradas/ajustes con motivo, historial de movimientos, descuento de venta y reposición al cancelar una venta.
- Ventas atómicas con folio, detalle y precios congelados, cliente opcional, idempotencia, ticket imprimible y cancelación justificada solo por administración.
- Puntos: se acumula 1 por cada $10 MXN y se puede canjear 1 punto por $1 MXN. La cancelación revierte los puntos de la venta.
- Tablero filtrable con dos gráficas, reportes de ventas y productos, filtros, ordenamiento, paginación y auditoría de cambios.
- Tasa de impuesto configurable desde **Configuración**. El valor inicial es 0%; los precios del catálogo son la base antes de esa tasa. Revisa la tasa y el tratamiento aplicables antes de cualquier uso real: el ticket es interno y no sustituye una factura ni asesoría fiscal.

Los ocho panes sembrados y sus precios son datos de demostración; pueden editarse o reemplazarse desde **Productos**.

## API

La aplicación sirve rutas bajo `/api/...`; también acepta `api.php?resource=...`. La respuesta usa JSON y los errores incluyen `error`. Las mutaciones requieren la cookie de sesión y el encabezado `X-CSRF-Token` del elemento meta de `index.php`.

| Grupo | Rutas principales | Acceso |
|---|---|---|
| Sesión | `GET auth/me`, `POST setup`, `POST auth/login`, `POST auth/logout` | Inicio / sesión |
| Catálogo | `GET/POST products`, `GET/PUT/DELETE products/{id}` | Lectura con sesión; cambios administrador |
| Categorías | `GET/POST categories`, `PUT/DELETE categories/{id}` | Lectura con sesión; cambios administrador |
| Clientes | `GET/POST customers`, `GET/PUT/DELETE customers/{id}` | Lectura con sesión; cambios administrador |
| Usuarios | `GET/POST users`, `PUT/DELETE users/{id}` | Administrador |
| Inventario | `GET/POST inventory/movements` | Consulta con sesión; ajustes administrador |
| Ventas | `GET/POST sales`, `GET sales/{id}`, `POST sales/{id}/cancel` | Cancelar: administrador |
| Tablero y reportes | `GET dashboard/summary`, `dashboard/series`, `dashboard/top-products`, `reports/sales`, `reports/products`, `reports/sales-by-day`, `reports/top-products` | Tablero con sesión; reportes administrador |
| Configuración y auditoría | `GET settings`, `PUT settings/tax-rate`, `GET audit-log` | Cambios y auditoría: administrador |

Ejemplo de venta; el servidor recalcula precios, impuesto, puntos, total y cambio a partir del catálogo y la configuración:

```json
{"request_key":"ejemplo-venta-0001","items":[{"id":1,"quantity":2}],"payment":"Efectivo","paid_cents":5000,"customer_id":null,"redeem_points":0}
```

## Datos y cuidado del proyecto

El esquema está en `schema.sql`; `db.php` inicializa y migra la base de datos. Las tablas incluyen roles, usuarios, clientes, productos, categorías, ventas, partidas, movimientos, auditoría, intentos de inicio y configuración. Para respaldar, cierra el servidor y copia `data/panaderia.sqlite` a un lugar seguro. Las cuentas y contraseñas son responsabilidad de quien administra la copia local.

Es un prototipo académico de uso local. No lo publiques en internet con datos reales sin una revisión de seguridad, copias de respaldo, HTTPS y configuración de servidor apropiada.
