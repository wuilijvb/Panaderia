# Cronograma de avances y commits

> Antecedente conservado. Revisión 28/10/2026: la planeación proporcionada por el
> equipo establece entrega el **06/11/2026**, que sustituye la fecha de 16/11
> propuesta abajo. Los hitos vigentes y el estado real se detallan en
> `04-ENTREGA-SEGUN-PLANEACION.md`. Las metas originales no acreditan trabajo realizado.

**Proyecto:** Miga · Punto de venta para panadería  
**Fecha límite indicada:** 16 de noviembre de 2026

Este plan organiza el trabajo desde el 20 de octubre de 2026. Las fechas de la tabla son metas: un commit se crea únicamente cuando el cambio correspondiente se haya realizado y revisado. No se deben fabricar commits con fechas anteriores.

| Fecha meta | Avance y archivos previstos | Mensaje de commit sugerido | Estado |
|---|---|---|---|
| 20 oct 2026 | Punto inicial del proyecto; `.gitignore`, aplicación, API, esquema, plantilla y documentos existentes. Se excluyen la base SQLite local y las sesiones. | `chore: guardar punto inicial del POS en Git` | Preparado hoy |
| 23 oct 2026 | Revisar la caja, navegación en móvil, textos, contraste y uso con teclado. Archivos probables: `index.php`, `program.css`, `app.js`. | `ui: pulir navegación y caja adaptable` | Planeado |
| 27 oct 2026 | Preparar pruebas reproducibles con una base de prueba aislada: acceso, catálogo, inventario y una venta/cancelación. Archivos probables: `tests/`, `api.php`, `README.md`. | `test: cubrir flujos principales con datos de prueba` | Planeado |
| 3 nov 2026 | Revisar modelo de datos, rutas de API, instalación y permisos. Archivos probables: `schema.sql`, `docs/`, `README.md`. | `docs: completar guía técnica y modelo de datos` | Planeado |
| 10 nov 2026 | Ejecutar aceptación en escritorio y móvil, corregir hallazgos y guardar evidencia real. Archivos probables: `app.js`, `program.css`, `docs/evidencias/`. | `fix: resolver hallazgos de aceptación` | Planeado |
| 14 nov 2026 | Integrar resultados, capturas y datos académicos confirmados en la documentación final; revisar el PDF exportado. Archivos probables: `docs/`, informe final. | `docs: preparar informe final y evidencias` | Planeado |
| 16 nov 2026 | Revisión final, confirmar que el repositorio no contenga la base local ni credenciales, y entregar la versión aprobada. | `release: preparar entrega del POS` | Planeado |

## Registro real

- **20 oct 2026:** crear el repositorio local y guardar el estado existente del proyecto como primer punto verificable. El historial comienza en esta fecha; el código que ya existía no se repartirá en commits retroactivos.
- Las metas siguientes se marcarán como realizadas solo al completar el cambio y sus comprobaciones.
