# Especificación de requisitos · Miga

**Proyecto:** Sistema web de punto de venta para una panadería artesanal  
**Versión de esta especificación:** 0.2 · actualización 4 de octubre de 2026  
**Estado:** requisitos actualizados contra la implementación; las funciones presentes en código aún requieren la matriz de aceptación académica  
**Fuentes:** `Requerimientos_Proyectos_Finales_Software.md` (requisitos generales y proyectos POS 1, 4 y 6) y `Lineamientos_Documentacion_Proyecto_Final_Software.pdf` (estructura y evidencia de documentación).

> Esta tabla diferencia la presencia de una función en el código de su validación de aceptación. La aplicación ya contiene los módulos descritos; falta ejecutar y documentar los casos de la matriz, revisar el ER y completar la evidencia académica.

## 1. Propósito

Organizar las ventas de mostrador y el control de productos de una panadería. El personal prepara el carrito y cobra una venta; el sistema valida las existencias, calcula importes en el servidor, conserva la operación y actualiza el inventario. El encargado administra el catálogo y consulta la operación del negocio.

**Nombre del sistema:** Miga.  
**Público principal:** cajeros y personal administrador de una panadería.  
**Moneda de operación propuesta:** MXN.  
**Orientación:** aplicación web académica. Las decisiones de operación con varias terminales y venta real se revisarán antes de considerar despliegue productivo.

## 2. Problema, objetivos y límites

### Problema

Las ventas y las existencias llevadas manualmente pueden causar cobros incorrectos, diferencias de inventario y dificultad para revisar el historial del día. El proyecto centralizará el catálogo, el cobro y el registro de movimientos.

### Objetivo general

Implementar una aplicación web que registre ventas de una panadería, mantenga un inventario trazable y permita consultar resultados mediante una interfaz conectada a una API y a una base de datos relacional.

### Objetivos específicos

1. Administrar productos, categorías y clientes con operaciones CRUD protegidas por rol.
2. Registrar ventas con folio, detalle e importes calculados en el backend.
3. Actualizar existencias y registrar movimientos en una transacción consistente.
4. Ofrecer búsqueda, filtros, historial y reportes con información persistida.
5. Añadir un programa sencillo de puntos para clientes frecuentes como función diferenciadora del POS personalizado.
6. Documentar la instalación, arquitectura, datos, API, pruebas y resultados reales.

### Incluye

Catálogo de panes, categorías, existencias y movimientos de inventario; ventas y sus detalles; registro opcional de cliente; pagos en efectivo y registro de pago con tarjeta; folio y consulta de ticket; cancelación autorizada con reversión de existencias; puntos de fidelidad; usuarios y permisos; tablero, dos reportes, dos gráficas, filtros e historial.

### Fuera de alcance inicial

Procesamiento o almacenamiento de datos bancarios, conexión a terminal de pago, factura fiscal, contabilidad, compras automatizadas a proveedores, múltiples sucursales, aplicación móvil nativa y despliegue público con datos reales. Un pago etiquetado como “tarjeta” en el prototipo es únicamente un registro informativo.

## 3. Personas y permisos

| Rol | Tareas permitidas | Restricciones |
|---|---|---|
| Administrador/encargado | Administrar catálogo, categorías, usuarios, entradas de inventario y puntos; consultar reportes, historial y auditoría; cancelar ventas con motivo | El backend verifica el rol en cada operación protegida |
| Cajero | Consultar catálogo, buscar productos, registrar y consultar ventas y asociar cliente | No administra usuarios ni catálogo, no ajusta inventario ni cancela ventas |

La identidad se obtiene de la sesión autenticada del servidor; el backend no debe aceptar un rol enviado por el navegador como prueba de autorización.

## 4. Requisitos funcionales

Prioridad: **M** = necesaria para una entrega académica completa; **D** = diferenciadora o deseable. El estado refleja el código revisado el 4 de octubre de 2026; “implementado” no significa que ya se haya completado la prueba de aceptación.

| ID | Requisito | Prioridad | Estado al 04/10/2026 |
|---|---|---|---|
| RF-01 | El personal podrá iniciar y cerrar sesión con credenciales; el administrador creará las cuentas del equipo y la contraseña se almacenará como hash seguro. No habrá autorregistro público para acceder a la caja. | M | Implementado: configuración del primer administrador, alta de personal desde Usuarios, acceso, salida y hash; falta registrar casos de acceso. |
| RF-02 | El administrador podrá crear, consultar, actualizar y desactivar productos. | M | Implementado: alta, consulta, edición y baja lógica por API/UI; pendiente matriz de casos. |
| RF-03 | Cada producto tendrá nombre, categoría, precio en centavos, existencia, mínimo de alerta, estado e identificación legible. | M | Implementado: código, categoría, precio en centavos, stock, mínimo y estado. |
| RF-04 | El administrador podrá administrar categorías mediante CRUD. | M | Implementado: CRUD de categorías con restricción por productos activos. |
| RF-05 | El cajero buscará productos por nombre o código y filtrará por categoría, disponibilidad y stock bajo. | M | Implementado: búsqueda nombre/código y filtros por categoría, disponibilidad y stock bajo. |
| RF-06 | El cajero podrá agregar, incrementar, disminuir y quitar artículos del carrito. | M | Implementado en la caja: agregar, incrementar, disminuir y quitar partidas. |
| RF-07 | El sistema calculará subtotal, impuestos configurados y total en el servidor; el cliente no podrá enviar un total confiable. | M | Implementado: el servidor calcula subtotal, tasa configurable, descuento y total; inicia en 0%. |
| RF-08 | El cajero podrá registrar la cantidad recibida en efectivo y ver el cambio. | M | Implementado: efectivo recibido y cambio se calculan en centavos. |
| RF-09 | El cajero podrá asociar un cliente a una venta, o registrar una venta sin cliente. | M | Implementado: cliente opcional en venta; venta de mostrador disponible. |
| RF-10 | Cada venta completada tendrá folio único, fecha, usuario, método de pago, estado, importes y partidas inmutables con precio cobrado. | M | Implementado: folio, usuario, cliente opcional, fecha, estado, pago e importes con partidas históricas. |
| RF-11 | Una operación de venta guardará cabecera, detalles, movimientos y descuento de stock en una transacción; si algo falla, se revertirán todos los cambios. | M | Implementado con transacción de venta, detalle, movimientos y stock; falta probar escenarios de fallo. |
| RF-12 | El administrador podrá registrar entradas y ajustes de inventario con motivo, fecha y usuario responsable. | M | Implementado: entradas y ajustes con motivo, actor y fecha en historial. |
| RF-13 | El sistema alertará sobre productos agotados y por debajo del stock mínimo. | M | Implementado: lista de stock bajo, agotados deshabilitados y tablero de alertas. |
| RF-14 | El cajero consultará el historial paginado y filtrado por rango de fechas, folio, cajero, cliente y método de pago. | M | Implementado: paginación, fechas, folio, cajero, cliente, método, estado y ordenamiento. |
| RF-15 | Un cajero podrá volver a imprimir o consultar el ticket de una venta previa. | M | Implementado: detalle e impresión de ticket desde el historial. |
| RF-16 | El administrador cancelará una venta con motivo y permiso; el sistema registrará el evento y compensará existencias una sola vez. | M | Implementado: administrador cancela con motivo, audita y repone stock una sola vez. |
| RF-17 | El tablero mostrará resumen del período elegido, importe vendido, número de ventas, alertas y productos destacados con datos de la API. | M | Implementado: rango, ventas netas, conteo, alertas, productos y gráficas desde la API. |
| RF-18 | El sistema generará dos reportes: ventas por intervalo y productos más vendidos/stock bajo, desde datos persistidos. | M | Implementado: reporte de ventas por intervalo y reporte de productos vendidos/stock. |
| RF-19 | Al menos dos gráficas dinámicas mostrarán información de ventas o productos obtenida de endpoints del backend. | M | Implementado: dos gráficas reciben datos del backend y rango del tablero. |
| RF-20 | El sistema guardará un historial de operaciones sensibles: autenticaciones, cambios de catálogo, ajustes de stock, ventas y cancelaciones. | M | Implementado: auditoría de accesos exitosos, catálogo, inventario, ventas, cancelaciones y ajustes. |
| RF-21 | Los clientes tendrán CRUD y podrán consultar/acumular puntos de fidelidad conforme a ventas válidas. | D | Implementado como diferenciador: CRUD de clientes, 1 punto por $10 y redención de $1 por punto. |
| RF-22 | Las listas principales tendrán paginación y ordenamiento donde el volumen de resultados lo amerite. | M | Implementado en productos, clientes, ventas y reportes: paginación y opciones de ordenamiento. |
| RF-23 | La interfaz presentará estados de carga, éxito, validación, error y ausencia de resultados con mensajes claros. | M | Parcial: hay conexión, mensajes de error/éxito y vacíos; falta recorrer estados de carga/error en aceptación. |

## 5. Requisitos no funcionales

| ID | Requisito verificable |
|---|---|
| RNF-01 | La interfaz web será adaptable a escritorio, tablet y teléfono, sin desbordamiento horizontal en las vistas principales. |
| RNF-02 | Las contraseñas usarán `password_hash`/`password_verify` o equivalente robusto; el sistema no guardará credenciales en texto plano. |
| RNF-03 | Toda escritura y consulta protegida pasará por la API/backend. El navegador no accederá directamente a la base de datos. |
| RNF-04 | Las consultas usarán parámetros; las entradas se validarán en el backend y los mensajes no expondrán consultas, contraseñas ni trazas internas. |
| RNF-05 | La sesión usará cookies `HttpOnly` y `SameSite`, regeneración de identificador tras iniciar sesión y protección CSRF en operaciones de escritura. |
| RNF-06 | La API usará JSON y códigos HTTP adecuados; los totales y cantidades monetarias se representarán como enteros en centavos. |
| RNF-07 | El esquema relacional preservará claves foráneas e integridad y se normalizará hasta 3FN cuando aplique. |
| RNF-08 | El código identificará configuración y secretos mediante variables de entorno. Ninguna clave o contraseña real se subirá al repositorio. |
| RNF-09 | Las funciones principales usarán controles de teclado, etiquetas accesibles, foco visible y contraste legible. La animación respetará `prefers-reduced-motion`. |
| RNF-10 | La aplicación informará indisponibilidad de API con una vista recuperable, sin dejar una pantalla en blanco ni mostrar detalles internos. |
| RNF-11 | La versión entregada podrá crearse desde un script de esquema y semillas reproducibles y tendrá instrucciones claras para arrancar localmente. |
| RNF-12 | Los reportes de ventas usarán límites máximos de fechas/resultados; toda paginación validará página y tamaño del lado servidor. |

## 6. Reglas de negocio

1. No se confirma una venta si un producto no existe, está desactivado o no tiene existencias suficientes.
2. Cantidades de carrito y de partidas de venta son enteros positivos; las existencias nunca pueden quedar negativas.
3. El backend obtiene precio y categoría desde la base de datos y calcula los importes; no confía en el precio ni total del navegador.
4. Folio, cabecera, detalle y movimientos relacionados se registran atómicamente. Ante un error se ejecuta `ROLLBACK`.
5. El identificador de idempotencia identifica el contenido de la solicitud; reutilizarlo para otro contenido se rechaza y reintentar la misma solicitud no duplica la venta.
6. La venta confirmada conserva una copia histórica del nombre y precio unitario aplicado aunque después se edite el catálogo.
7. Efectivo recibido debe ser igual o mayor al total; cambio = efectivo recibido − total. Un pago etiquetado con tarjeta no produce un cargo financiero.
8. Solo un administrador puede ajustar stock o cancelar una venta; la cancelación exige motivo, genera auditoría y repone existencias una sola vez.
9. Una venta cancelada no se elimina físicamente del historial ni cuenta como venta neta; el reporte separa ventas brutas, cancelaciones y ventas netas.
10. Los puntos se generan solo con ventas válidas conforme a una tasa configurable, se redimen con autorización explícita y revierten al cancelar la venta asociada.
11. Toda fecha operacional se almacena de forma uniforme y se presenta según la zona horaria configurada para la sucursal.
12. La categoría y el precio de una venta se conservan en el detalle como datos históricos verificables.

## 7. Criterios de aceptación

| ID | Criterio observable |
|---|---|
| CA-01 | Credenciales válidas permiten acceso; inválidas no crean una sesión. Cerrar sesión invalida la sesión anterior. |
| CA-02 | Un cajero puede registrar una venta con varios artículos, pago en efectivo, efectivo recibido y cambio correctos. |
| CA-03 | Al confirmar una venta válida, el total, el detalle, el folio, la auditoría y el stock se guardan y se pueden consultar de nuevo. |
| CA-04 | Una cantidad superior al stock devuelve error comprensible y deja ventas, movimientos y stock sin cambios. |
| CA-05 | Enviar de nuevo la misma clave de idempotencia y el mismo contenido no crea una segunda venta. |
| CA-06 | Un cajero no puede crear/modificar productos, ajustar stock, administrar usuarios ni cancelar una venta, ni por interfaz ni invocando directamente la API. |
| CA-07 | La cancelación autorizada pide motivo, queda en historial y repone existencias una única vez. |
| CA-08 | Se pueden crear, leer, editar y desactivar productos, categorías y clientes mediante operaciones de API autorizadas. |
| CA-09 | El buscador, filtros, orden y paginación operan sobre resultados reales de la API. |
| CA-10 | Los reportes incluyen límite de fechas y sus totales concuerdan con ventas no canceladas almacenadas. |
| CA-11 | Dos gráficas consumen datos variables del backend y reflejan el rango seleccionado; no usan cifras escritas a mano. |
| CA-12 | Los puntos del cliente cambian por operaciones registradas y su saldo corresponde con el historial aplicable. |
| CA-13 | En celular y escritorio, caja, catálogo, inventario y diálogo se pueden recorrer y operar sin controles cortados. |
| CA-14 | Un fallo de API o validación se comunica y mantiene utilizables la navegación y la pantalla. |

## 8. Modelo de datos implementado

Las tablas efectivas del esquema SQLite al momento de la revisión son:

| Tabla | Responsabilidad y relaciones principales |
|---|---|
| `roles` | Catálogo de roles; se relaciona con cuentas de usuario |
| `users` | Cuenta, hash de contraseña, rol y estado |
| `categories` | Categoría normalizada de productos |
| `products` | Código, nombre, categoría, precio en centavos, stock mínimo y estado |
| `customers` | Datos mínimos de cliente y saldo de puntos; correo opcional y único si existe |
| `sales` | Folio, usuario, cliente opcional, fecha, estado, método de pago e importes |
| `sale_items` | Partidas; referencia venta y producto, conserva nombre y precio de venta |
| `inventory_movements` | Entradas, salidas y correcciones con producto, cantidad, motivo, usuario y referencia de operación |
| `audit_log` | Actor, acción, entidad, identificador, fecha y datos del cambio sin secretos |
| `login_attempts` | Intentos fallidos/exitosos con cuenta, dirección de origen y fecha para limitar intentos |
| `app_settings` | Valores operativos configurables; incluye tasa de impuesto en puntos base |

El `schema.sql` actual implementa las entidades listadas y las tablas de intentos/configuración; `db.php` conserva la base anterior y completa columnas faltantes. El diagrama ER, modelo lógico y diccionario de datos todavía deben producirse para el informe final a partir de este esquema real.

## 9. Contrato REST implementado

El backend implementa las siguientes rutas bajo `/api/` (también admite `api.php?resource=...`). Las escrituras requieren sesión y token CSRF; cada ruta administrativa vuelve a comprobar el rol en el servidor.

| Método y endpoint implementado | Uso | Permiso |
|---|---|---|
| `POST /api/setup` | Crear el primer administrador con contraseña elegida en la instalación local | Solo primer acceso local |
| `POST /api/auth/login` | Iniciar sesión | Público con limitación de intentos |
| `POST /api/auth/logout` | Cerrar sesión | Usuario autenticado |
| `GET /api/auth/me` | Consultar sesión o indicar si requiere configuración inicial | Público / sesión |
| `GET /api/products` | Listar con búsqueda, filtro, sort y paginación | Autenticado |
| `GET /api/products/{id}` | Consultar producto | Autenticado |
| `POST /api/products` | Crear producto | Administrador |
| `PUT /api/products/{id}` | Editar producto | Administrador |
| `DELETE /api/products/{id}` | Desactivar producto mediante baja lógica | Administrador |
| `GET /api/categories` | Listar categorías | Autenticado |
| `POST /api/categories` | Crear categoría | Administrador |
| `PUT /api/categories/{id}` | Editar categoría | Administrador |
| `DELETE /api/categories/{id}` | Desactivar categoría si no rompe referencias | Administrador |
| `GET /api/customers` | Buscar/listar clientes con paginación | Autenticado |
| `POST /api/customers` | Crear cliente | Administrador |
| `PUT /api/customers/{id}` | Actualizar datos de cliente | Administrador |
| `DELETE /api/customers/{id}` | Baja lógica del cliente | Administrador |
| `POST /api/sales` | Registrar venta, cobrar en el sistema, descontar stock y guardar auditoría | Cajero, administrador; CSRF e idempotencia |
| `GET /api/sales` | Historial filtrado y paginado | Cajero, administrador |
| `GET /api/sales/{id}` | Detalle y ticket | Cajero según acceso autorizado, administrador |
| `POST /api/sales/{id}/cancel` | Cancelar y compensar inventario una sola vez | Administrador; motivo requerido |
| `GET /api/inventory/movements` | Consultar movimientos y filtros | Administrador; lectura limitada para caja |
| `POST /api/inventory/movements` | Registrar entrada o ajuste con motivo | Administrador |
| `GET /api/dashboard/summary` | Indicadores del rango | Autenticado |
| `GET /api/dashboard/series` | Serie de venta diaria para gráfica | Autenticado |
| `GET /api/dashboard/top-products` | Diez productos destacados para gráfica | Autenticado |
| `GET /api/reports/sales?from=&to=&page=&limit=` | Reporte paginado de ventas por fecha | Administrador |
| `GET /api/reports/products?from=&to=&sort=` | Ranking y alertas de productos | Administrador |
| `GET /api/reports/sales-by-day?from=&to=` | Serie temporal para gráfica de ventas | Administrador |
| `GET /api/reports/top-products?from=&to=&limit=` | Datos de gráfica de productos vendidos | Administrador |
| `GET /api/audit-log?page=` | Historial paginado de acciones privilegiadas | Administrador |
| `GET /api/settings` | Consultar tasa configurada para la caja | Autenticado |
| `PUT /api/settings/tax-rate` | Guardar tasa de 0 a 30 por ciento | Administrador |
| `GET/POST /api/users` y `PUT/DELETE /api/users/{id}` | Administración de usuarios y roles | Administrador |

La implementación responde con JSON: `401` sin sesión, `403` sin permiso o CSRF, `404` ruta/recurso inexistente, `409` duplicidad, `422` validación/regla de negocio, `429` exceso de intentos y `500` error interno genérico. Las altas responden `201`; consultas y cambios completados responden `200`.

## 10. Interfaz y navegación

- Inicio de sesión.
- Dashboard con resumen, alertas y dos gráficas.
- Punto de venta: buscador, filtros de categoría, lista, carrito, cantidades, cliente opcional, forma de pago, recibido, cambio y cierre de venta.
- Productos: lista paginada, alta, edición y desactivación.
- Categorías: lista y formulario CRUD.
- Inventario: existencias bajas y entradas/ajustes con motivo.
- Clientes: CRUD e historial/saldo de puntos.
- Ventas: filtros, detalle/ticket y cancelación visible solo para el rol autorizado.
- Reportes: rango de fecha, resultados tabulares y dos gráficas.
- Usuarios/roles y auditoría exclusivos del administrador.

La plantilla Ember Table conserva su lenguaje editorial para la identidad visual de panadería. Las pantallas de trabajo tienen prioridad operativa y deben seguir siendo legibles y accesibles; las animaciones decorativas no deben ocultar acciones de caja.

## 11. Brecha de implementación y orden de trabajo

La aplicación ya implementa los módulos planeados: esquema/migración SQLite, acceso por roles, catálogos, operación de caja, inventario, cancelación, auditoría, reportes y gráficas. Se hizo comprobación de sintaxis PHP/JavaScript, migración sin perder el catálogo local y apertura de la pantalla inicial. No se ha ejecutado la matriz completa de casos ni la validación adaptable del curso; por ello los estados de código no se presentan como pruebas de aceptación aprobadas.

| Fase | Entregable verificable | Dependencia |
|---|---|---|
| 1. Fundamentos | Diagrama ER, esquema ampliado, semillas, configuración documentada y migración/versionado del esquema | Decidir relaciones y conservar ventas existentes |
| 2. Acceso | CRUD de roles/usuarios, hash, sesión, protección de rutas, permisos backend y CSRF | Esquema y modo de sesión |
| 3. Catálogo | CRUD completo de producto/categoría con baja lógica, búsqueda/paginación y mínimos de stock | Acceso y esquema |
| 4. Operaciones | Clientes, carrito vinculado al usuario, transacción con movimientos, auditoría, idempotencia y cancelación reversible | Roles, inventario y modelo de venta |
| 5. Información | Dashboard conectado, 2 reportes filtrables, 2 gráficas API y paginación/orden | Datos persistidos confiables |
| 6. Pruebas y entrega | Matrices de permisos/reglas/errores, validación responsive, guía de instalación, Git e informe final sustentado en evidencia | Módulos funcionales |

### Pendientes para cerrar la entrega académica

- Elaborar y adjuntar diagrama ER, modelo lógico y diccionario de datos, contrastados con `schema.sql`.
- Ejecutar y documentar la matriz de acceso permitido/denegado, CSRF, reglas, permisos por rol, errores de base de datos, pagos, puntos, reversión, idempotencia y cancelación doble.
- Verificar visualmente caja, inventario, reportes y diálogo en escritorio/tableta/teléfono; guardar capturas legibles y resultados reales.
- Completar los datos reales de portada, equipo, docente, grupo, fecha, aportaciones, cronograma, Git y anexos de acuerdo con el PDF de lineamientos.
- Confirmar con el contexto académico la tasa impositiva real, método fiscal y si se exige un motor SQL distinto de SQLite; el valor inicial en la aplicación es 0% y el ticket no es fiscal.

## 12. Seguridad, pruebas y seguimiento

Casos de aceptación pendientes de ejecutar y registrar: acceso permitido y rechazado; permiso insuficiente llamando al endpoint directamente; campos vacíos e inválidos; producto y usuario inexistentes; duplicidad de cliente/código; stock insuficiente; fallo intermedio de transacción; reintento idéntico y clave idempotente reutilizada con contenido distinto; doble cancelación; acceso cruzado al ticket; CSRF; fallo de BD; filtros/rango de fechas; diseño adaptable; cálculo independiente del total, impuestos y cambio.

Cada requisito `RF-*`, `RNF-*` y `CA-*` se vinculará con módulo/endpoint y un caso `CP-*` en la matriz de trazabilidad de la documentación final. Mantener evidencia de ejecución, capturas legibles, esquema real, commits y observaciones; no cambiar un estado a “cumplido” solo porque la pantalla exista.

## 13. Datos y decisiones aún por confirmar

- Integrantes, grupo, asignatura, docente y fecha límite de entrega.
- Nombre oficial del negocio o confirmación de Miga como nombre ficticio.
- La caja permite configurar una tasa (0% inicial) y suma el impuesto sobre el precio ingresado; confirmar tasa y método aplicables antes de uso comercial, sin presentar el ticket como fiscal.
- La muestra define 1 punto por cada $10 de venta y $1 de descuento por punto; confirmar si el asesor quiere otro valor para la entrega.
- Datos personales mínimos y plazo de conservación de clientes.
- Si el alcance académico requiere MaríaDB/MySQL específicamente; el prototipo existente usa SQLite y la guía general recomienda motores relacionales, pero no convierte esa recomendación en mandato. Registrar decisión, justificación y límite de concurrencia.
- Objetivos de rendimiento, repositorio definitivo, método de trabajo Git y ambiente de despliegue.
