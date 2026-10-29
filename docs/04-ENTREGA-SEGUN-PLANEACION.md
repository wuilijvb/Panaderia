# Entrega y avance de Miga - Equipo 02

Revisión: 28 de octubre de 2026. Fuente: Documentacion_Planeacion (1).pdf,
versión 1.0. Fecha final de la planeación: **6 de noviembre de 2026**.
El cronograma anterior que proponía 16 de noviembre queda como antecedente,
no como fecha vigente. Este documento describe un avance, no una entrega final aprobada.

## Qué se tiene que subir

1. **GitHub:** código del sistema, README de instalación, esquema y semillas,
   `.env.example`, documentación de API y BD, diagramas, pruebas y evidencias,
   matriz de trazabilidad. Repositorio: https://github.com/wuilijvb/Panaderia.
2. **Teams, actividad Proyecto Unidad 2:** la planeación con el nombre
   `Planeacion_Proyecto_Equipo02.pdf`. La carga en Teams queda pendiente;
   no se ha identificado una sesión ni el destino de la actividad.
3. **Entrega final:** `Documentacion_Final_Equipo02.pdf`, repositorio y demostración
   ensayada. El informe final debe seguir los lineamientos docentes y contener
   resultados y capturas reales. No se reemplaza por este resumen de avance.
4. **Evidencia de equipo:** historial de los tres integrantes, ramas, PR revisados,
   tablero y etiquetas de sprint reales. No crear contribuciones ni tags retroactivos.

## Documentación breve de lo preparado

Miga es un punto de venta web para panadería. El navegador presenta el catálogo,
carrito y vistas de administración; JavaScript consulta una API JSON escrita en PHP.
La API verifica sesión, permisos y CSRF, consulta SQLite y registra ventas,
partidas y movimientos dentro de transacciones. El administrador gestiona usuarios,
productos, categorías e inventario; el cajero registra ventas. También hay clientes,
puntos, historial, tablero y reportes de ventas/productos.

La entrega de avance reúne el código local con el historial que ya existía en GitHub,
conserva los documentos remotos de `Documentos/` y añade documentación en `docs/`.
No incluye las bases SQLite locales, sesiones ni contraseñas del equipo.
Instalación y uso: consultar `README.md`. API: `docs/api.md`. Datos y arquitectura:
`docs/database.md`. La configuración de ejemplo explica la variable `BAKERY_DB`;
no se requiere una contraseña predeterminada y el primer administrador se crea localmente.

## Comparación con el plan

| Entregable o requisito | Evidencia actual | Pendiente |
|---|---|---|
| R-01 arquitectura cliente-servidor | index.php, app.js, api.php, db.php | Diagrama incluido en database.md; revisión de equipo |
| R-02 BD relacionada | schema.sql con 11 tablas | Revisión 3FN y captura de BD; semillas reproducibles en db.php, no seed.sql independiente |
| R-03 a R-06 CRUD, API, acceso y roles | Código de API y tabla en api.md | Ejecución completa de endpoints y permisos |
| R-07, R-12, R-13 tablero, reportes y gráficas | Código existente | Capturas y conciliación de cifras contra BD |
| R-08, R-09 reglas y transacción | API con BEGIN IMMEDIATE, COMMIT y ROLLBACK | Prueba de fallo intermedio y RN-06 |
| R-10, R-11 listados e historial | Listados y audit_log | Evidencia funcional |
| R-14, R-15 errores y seguridad | Validaciones, hash, consultas preparadas, sesión y CSRF | Matriz HTTP y revisión de seguridad |
| R-16, R-20 interfaz | Pantallas y estilos existentes | Capturas laptop/tablet/celular y estados de interfaz |
| R-17 Git | Historial conservado y rama de entrega | Revisiones y contribuciones reales de cada integrante |
| R-18 documentación | README, api.md, database.md, .env.example | Colección Postman y prueba en otra máquina |
| R-19 PDF final | Guía de estructura existente | Informe final con resultados reales |
| Diferenciador: producción y merma | No se encontraron tabla ni endpoints específicos | Implementar A-15 y reporte producción/merma; los puntos no sustituyen este requisito |
| Perfil | Identidad de sesión en auth/me | Verificar pantalla y alcance de edición del perfil |
| Diseño | Interfaz implementada | Seis wireframes y comparación con pantallas |

## Decisiones técnicas que deben quedar asentadas

El plan propuso React/Vite, Express, JWT y MySQL/MariaDB. La versión local usa
HTML/CSS/JavaScript, PHP 8.2, sesiones con cookie y SQLite. El apartado 5.1 del
plan permite ajustar tecnologías; el equipo debe registrar y revisar esta decisión.
Las rutas actuales están en inglés (`products`, `sales`, `users`), en vez de las
rutas en español propuestas. La cancelación real usa POST, no PATCH.
El acceso de cajero al historial debe revisarse frente a la restricción del plan
de consultar únicamente sus ventas: el listado actual no impone ese filtro por rol.

## Próximos hitos originales

- 30/10: venta completa y reversión comprobada; producción y merma pendientes.
- 03/11: venta desde interfaz y pantallas de negocio integradas.
- 04/11: gráficas/reportes y casos ejecutados con evidencia.
- 05/11: correcciones e informe final.
- 06/11: repositorio, PDF y demostración.

Los hitos de 13, 16, 19 y 23 de octubre se evalúan contra los archivos existentes;
no se afirma que se completaron en esas fechas. La autoría de los commits usa
la identidad Git ya configurada y no representa aportaciones de otros integrantes.
