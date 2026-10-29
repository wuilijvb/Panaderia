# API real de Miga

Contrato obtenido del código de `api.php`, revisión 28/10/2026. Esta tabla
documenta implementación; no afirma que todas las rutas hayan pasado aceptación.
Base local XAMPP: `/hotel/panaderia/api/`. Alternativa sin reescritura:
`api.php?resource=products`. Respuestas JSON; errores: `{"error":"mensaje"}`.

Autenticación por cookie de sesión PHP, no JWT. Antes de escribir, abrir index.php
y obtener el token del meta `csrf-token`; enviarlo como `X-CSRF-Token` junto con
la cookie y `Content-Type: application/json`. Todas las mutaciones, incluido login,
requieren CSRF. La configuración inicial solo acepta conexión local sin usuarios.

| Método | Ruta | Acceso / entrada principal |
|---|---|---|
| GET | auth/me | Público; authenticated, needs_setup, user |
| POST | setup | Local inicial; name, username, password (12+ caracteres) |
| POST | auth/login | Público con CSRF; username, password |
| POST | auth/logout | Sesión |
| GET | products | Sesión; q, category_id, low_stock=1, sort, page, limit |
| GET | products/{id} | Sesión |
| POST | products | Administrador; name, category_id, code, price_cents, stock, minimum_stock, icon |
| PUT / DELETE | products/{id} | Administrador; editar / desactivar |
| GET / POST | categories | Sesión / administrador; name al crear |
| PUT / DELETE | categories/{id} | Administrador; name / baja lógica |
| GET / POST | customers | Sesión / administrador; name, email, phone |
| GET | customers/{id} | Sesión; detalle y resumen de ventas |
| PUT / DELETE | customers/{id} | Administrador; editar / baja lógica |
| GET / POST | users | Administrador; name, username, password, role al crear |
| PUT / DELETE | users/{id} | Administrador; name, role, password opcional / baja lógica |
| GET | inventory/movements | Sesión; product_id, type, page, limit |
| POST | inventory/movements | Administrador; product_id, quantity, type (entrada/ajuste), reason |
| GET | sales | Sesión; from, to, q, payment, status, sort, page, limit |
| POST | sales | Sesión; ejemplo debajo |
| GET | sales/{id} | Sesión; detalle y partidas |
| POST | sales/{id}/cancel | Administrador; reason |
| GET | dashboard/summary | Sesión; from, to |
| GET | dashboard/series | Sesión; from, to |
| GET | dashboard/top-products | Sesión; from, to |
| GET | reports/sales | Administrador; from, to, status, q, sort, page, limit |
| GET | reports/products | Administrador; from, to |
| GET | reports/sales-by-day | Administrador; from, to |
| GET | reports/top-products | Administrador; from, to |
| GET | audit-log | Administrador; page, limit |
| GET | settings | Sesión |
| PUT | settings/tax-rate | Administrador; tax_rate_bps (0 a 3000) |

Ejemplo de petición POST sales (no es resultado observado):

```json
{"request_key":"demo-venta-20261028-01","items":[{"id":1,"quantity":2}],"payment":"Efectivo","paid_cents":5000,"customer_id":null,"redeem_points":0}
```

El servidor calcula importes en centavos y devuelve id, created_at, total_cents,
subtotal_cents, tax_cents, tax_rate_bps, discount_cents, points_redeemed,
points_awarded, paid_cents, change_cents, payment y status con HTTP 201.
La misma request_key con igual contenido devuelve la venta sin duplicarla;
si cambia el contenido se rechaza. DELETE desactiva registros, no borra ventas.

Códigos definidos en código: 200 consulta/cambio, 201 creación, 401 sin sesión o
credenciales incorrectas, 403 permisos/CSRF, 404 inexistente, 409 conflicto,
422 validación, 429 límite de login y 500 error interno. Registrar respuestas
observadas en la matriz de pruebas antes de declarar cumplimiento.
Fechas AAAA-MM-DD, rangos de hasta 366 días y páginas de hasta 100 registros.
Las rutas de producción/cierre/merma del plan aún no están implementadas.
