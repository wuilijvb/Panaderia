# Cronograma de avances y commits

**Proyecto:** Miga · Punto de venta para panadería
**Fecha límite indicada:** 16 de noviembre de 2026

Este plan organiza los avances desde el 20 de octubre de 2026. Las fechas futuras son metas: cada commit se creará cuando el cambio esté realizado y revisado. El historial no se retrofechará.

| Fecha meta | Avance y archivos previstos | Mensaje de commit sugerido | Estado |
|---|---|---|---|
| 20 oct 2026 | Agregar reglas para excluir archivos locales y registrar este cronograma. Archivos: `.gitignore`, `Documentos/03-CRONOGRAMA-DE-AVANCES.md`. | `chore: proteger datos locales y planificar avances` | Hecho hoy |
| 23 oct 2026 | Revisar la caja, navegación móvil, textos, contraste y uso con teclado. Archivos probables: `index.php`, `program.css`, `app.js`. | `ui: pulir navegación y caja adaptable` | Planeado |
| 27 oct 2026 | Preparar pruebas reproducibles para acceso, catálogo, inventario y una venta/cancelación. Archivos probables: `tests/`, `api.php`, `README.md`. | `test: cubrir flujos principales con datos de prueba` | Planeado |
| 3 nov 2026 | Completar la explicación del modelo de datos, rutas de API e instalación. Archivos probables: `schema.sql`, `api.php`, `db.php`, `README.md`, `Documentos/`. | `docs: completar guía técnica y modelo de datos` | Planeado |
| 10 nov 2026 | Probar escritorio y móvil, corregir hallazgos y guardar evidencia real. Archivos probables: `app.js`, `program.css`, `Documentos/Evidencias/`. | `fix: resolver hallazgos de aceptación` | Planeado |
| 14 nov 2026 | Integrar resultados y evidencias en la documentación final. Archivos probables: `Documentos/` e informe final. | `docs: preparar informe final y evidencias` | Planeado |
| 16 nov 2026 | Revisar la entrega y confirmar que no se incluyan bases locales ni credenciales. | `release: preparar entrega del POS` | Planeado |

## Registro real

- El repositorio ya contenía el commit `9b0c7f7` con los requerimientos del sistema.
- El 20 de octubre de 2026 se agregan las reglas de exclusión y este cronograma. Este avance no incorpora el código completo del POS ni la base de datos local.
- Las metas futuras se marcarán como realizadas solo al completar cada cambio y sus comprobaciones.
