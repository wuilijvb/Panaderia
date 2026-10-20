# Guía para la documentación final · Miga

Esta guía convierte los `Lineamientos_Documentacion_Proyecto_Final_Software.pdf` adjuntos en una estructura lista para completar para el sistema de punto de venta de la panadería. La entrega solicitada por esos lineamientos es un **PDF final**: este archivo Markdown es el índice de trabajo, las instrucciones de contenido y la lista de evidencias; no lo sustituye.

**Proyecto:** Miga · Punto de venta para panadería  
**Versión documental:** 0.2, guía de trabajo actualizada el 4 de octubre de 2026  
**Origen del índice:** apartados 1–22 del PDF de lineamientos 2026.  
**Estado:** estructura de trabajo basada en el PDF; la aplicación ya está implementada, pero el informe final y la evidencia de pruebas/capturas siguen pendientes.

> No inventar integrantes, fechas, resultados de prueba, aportaciones de Git, métricas, credenciales ni funcionalidades. Dejar `[Pendiente: ...]` hasta obtener el dato o capturar evidencia verificable. Distinguir “planeado”, “en desarrollo”, “implementado” y “comprobado”.

## Cómo convertir esta guía en la entrega

1. Reemplazar cada marcador `[Pendiente: ...]` con evidencia o decisión confirmada.
2. Mantener el cronograma planeado y registrar por separado fechas y resultados reales.
3. Insertar capturas propias, legibles y fechadas de la versión final; anonimizar datos personales.
4. Actualizar la matriz de trazabilidad cuando un requisito se implemente y se pruebe.
5. Verificar que diagramas, endpoints, base de datos, permisos y pantallas coincidan con el código final.
6. Añadir índice, numeración, títulos a imágenes/tablas, enlaces y anexos, exportar a PDF y revisar visualmente todas sus páginas.

## Portada y control del documento

**Nombre del proyecto:** Miga · Sistema de punto de venta para una panadería  
**Materia:** [Pendiente: nombre oficial]  
**Docente:** [Pendiente: nombre]  
**Grupo:** [Pendiente: grupo]  
**Integrantes:** [Pendiente: nombres completos y contribución]  
**Fecha de entrega:** [Pendiente: confirmar]  
**Versión del sistema/documento:** [Pendiente: release y versión]  
**Repositorio Git:** [Pendiente: enlace]  
**Sistema desplegado:** [Pendiente: enlace o “No aplica, demostración local”]

| Versión | Fecha | Responsable | Descripción |
|---|---|---|---|
| 0.1 | 04/10/2026 | [Pendiente: responsable] | Estructura inicial derivada de los lineamientos; aún sin validar contra la entrega final |

## Índice del informe

### 1. Portada y control del documento

Identificar proyecto, equipo, asignatura, versión, fecha, repositorio y sistema entregado. Incluir tabla de control de cambios.

### 2. Resumen ejecutivo

En media a una página describir el problema de cobro/inventario, usuarios, solución, tecnología realmente usada, funciones terminadas, resultado final y estado de las pruebas. Redactar esta sección al final para que refleje resultados observados.

### 3. Problema, objetivos y alcance

#### 3.1 Planteamiento del problema

Explicar quién registra las ventas y existencias, qué dificultades tiene el proceso actual y qué consecuencias resuelve el sistema. Distinguir escenario simulado de observaciones reales.

#### 3.2 Objetivo general y objetivos específicos

Anotar objetivos verificables ligados a caja, inventario, catálogo, historial, seguridad y reportes.

#### 3.3 Alcance y exclusiones

Enumerar módulos terminados, roles realmente implementados, procesos soportados y exclusiones (por ejemplo, procesamiento real de tarjeta o factura fiscal). Comparar contra `docs/01-REQUERIMIENTOS-DEL-SISTEMA.md`.

### 4. Modelo de negocio y contexto de uso

Documentar usuarios/clientes, necesidad, propuesta de valor, proceso principal, recursos para operación y costos o sostenimiento solo cuando sean aplicables. Señalar el supuesto académico. Definir indicadores de valor: errores de inventario, tiempo de cobro y ventas netas por período, solo si la aplicación puede medirlos.

### 5. Planeación, cronograma y seguimiento

Las fechas son pendientes hasta que el equipo las confirme. Llenar entregable y evidencia concreta por hito; evitar filas vagas como “avanzar backend”.

| Fase | Inicio planeado | Fin planeado | Responsable | Entregable estimado | Evidencia esperada | Estado real |
|---|---|---|---|---|---|---|
| Análisis | [Pendiente] | [Pendiente] | [Pendiente] | Requisitos, reglas, alcance y modelo de negocio | Revisión y versión del archivo | [Pendiente] |
| Diseño | [Pendiente] | [Pendiente] | [Pendiente] | ER, arquitectura, flujo, wireframes | Diagramas revisados | [Pendiente] |
| Backend | [Pendiente] | [Pendiente] | [Pendiente] | Auth, CRUD, API, transacciones y permisos | Endpoints ejecutados | [Pendiente] |
| Frontend | [Pendiente] | [Pendiente] | [Pendiente] | Caja, inventario, administración y reportes | Capturas integradas | [Pendiente] |
| Pruebas | [Pendiente] | [Pendiente] | [Pendiente] | Casos aprobados/corregidos y revisión móvil | Matriz y evidencia | [Pendiente] |
| Entrega | [Pendiente] | [Pendiente] | Equipo | Código, base, PDF y demostración | Release/repositorio y PDF | [Pendiente] |

Agregar tabla de seguimiento: **fecha planeada, fecha real, entregable esperado, resultado realmente obtenido, desviación, causa y corrección**. Registrar dependencias, riesgos, integración y contingencias reales.

### 6. Requerimientos, reglas de negocio y aceptación

Usar los ID `RF-*`, `RNF-*` y `CA-*` de la especificación. Marcar cumplimiento solo si hay evidencia. Incluir criterios de aceptación por módulo y sus exclusiones.

### 7. Arquitectura y decisiones técnicas

#### 7.1 Diagrama

Insertar diagrama con usuario, interfaz, petición HTTP, API/backend y base de datos; incluir autenticación y servicios externos únicamente si existen. Aclarar que el navegador no accede directamente a la BD.

#### 7.2 Justificación

Explicar estructura frontend/backend, lenguaje/framework, motor y configuración de BD, límites del prototipo, API, lugar de reglas de negocio, validaciones, sesión y autorización. Comparar lo que se había planeado con las decisiones que realmente se entregaron.

#### 7.3 Flujo de una operación

Describir una venta de principio a fin: cajero → carrito → JSON → autenticación/permiso → validación y consulta de precios/stock → transacción de venta/detalle/movimiento → `COMMIT` o `ROLLBACK` → respuesta JSON → actualización de pantalla y ticket.

### 8. UX/UI, navegación y evidencia visual

Describir usuarios, navegación, legibilidad, jerarquía, accesibilidad, vista móvil, estados de carga/error/éxito y justificación de la plantilla visual Ember Table adaptada al punto de venta. Incluir bocetos de inicio de sesión, dashboard, caja, formulario/detalle y reportes, aunque sean entregables futuros claramente identificados. Comparar un boceto con la pantalla final y explicar diferencias. No llamar “boceto original” a la implementación si no se conservó una versión previa.

### 9. Diseño de la base de datos

Agregar diagrama ER, explicación de entidades y relaciones, PK/FK, cardinalidades, 3FN, integridad, índices, y capturas o consultas de la base real. Anexar o enlazar los scripts de esquema y semillas. Conciliar el modelo documentado con las tablas realmente instaladas.

| Tabla real | Propósito | PK/FK | Evidencia/archivo |
|---|---|---|---|
| [Pendiente: completar según esquema final] | | | |

### 10. Diseño y documentación de API

Documentar cada endpoint efectivamente disponible con método, ruta, descripción, autenticación/rol, entradas, respuesta de éxito, errores y una petición/respuesta de ejemplo. Poner los endpoints meramente planificados en una sección aparte; no presentarlos como funcionales. Explicar JSON, validación, CSRF, idempotencia y códigos HTTP realmente configurados.

| Método | Ruta real | Función | Permiso | Entrada/respuesta | Códigos observados |
|---|---|---|---|---|---|
| [Pendiente: ejecutar y documentar] | | | | | |

### 11. Módulos y lógica de negocio

Por cada módulo explicar objetivo, usuarios, datos de entrada, pasos, reglas, tablas/endpoints/pantallas relacionadas, resultado esperado y captura de evidencia. Módulos a evaluar: usuarios/roles, productos/categorías, caja/ventas, inventario, clientes/puntos, historial/auditoría, dashboard/reportes.

### 12. Seguridad

Describir hash de contraseña, inicio/cierre/sesión, cookies, regeneración de sesión, CSRF, autorización de servidor, validación de parámetros, consultas preparadas, baja lógica, variables de entorno, restricciones de acceso a archivos de BD y manejo de errores. Incluir solo controles presentes y evidenciados; listar pendientes aparte.

### 13. Pruebas y validación

Completar con los resultados reales de la versión final. “Conforme” significa que se ejecutó y se observó la salida; no escribirlo por anticipado.

| ID | Caso / entrada | Resultado esperado | Resultado obtenido y evidencia | Estado |
|---|---|---|---|---|
| CP-01 | Inicio válido y salida de sesión | Acceso permitido; sesión invalidada al salir | [Pendiente de ejecutar] | Pendiente |
| CP-02 | Credencial inválida / acceso anónimo | 401/redirect seguro, sin revelar información | [Pendiente de ejecutar] | Pendiente |
| CP-03 | Cajero intenta acción administrativa | 403 y sin cambio en BD | [Pendiente de ejecutar] | Pendiente |
| CP-04 | Venta válida en efectivo | Folio, detalle, total, cambio y stock correctos | [Pendiente de ejecutar] | Pendiente |
| CP-05 | Efectivo menor al total | Rechazo sin registrar venta | [Pendiente de ejecutar] | Pendiente |
| CP-06 | Venta mayor al inventario | Error claro; transacción revertida | [Pendiente de ejecutar] | Pendiente |
| CP-07 | Falla intermedia/rollback | No quedan tablas parcialmente actualizadas | [Pendiente de ejecutar] | Pendiente |
| CP-08 | Reenvío idempotente / clave en conflicto | No duplica; conflicto si cambia contenido | [Pendiente de ejecutar] | Pendiente |
| CP-09 | Producto/cliente inexistente y campos inválidos | Error 404/422 apropiado | [Pendiente de ejecutar] | Pendiente |
| CP-10 | Doble cancelación o rol no autorizado | No repone stock más de una vez | [Pendiente de ejecutar] | Pendiente |
| CP-11 | Reportes para fechas sin datos/con datos | Rango correcto y cifras reconciliables | [Pendiente de ejecutar] | Pendiente |
| CP-12 | API desconectada y vista móvil | Mensaje recuperable y controles utilizables | [Pendiente de ejecutar] | Pendiente |

### 14. Instalación y despliegue

Incluir SO, PHP y extensiones/versiones efectivamente usadas, requisitos, XAMPP, ruta de instalación, configuración no secreta, creación de esquema, semillas, permisos de BD, comandos/rutas para iniciar frontend/backend/API, URL y puerto local, usuarios de demostración solo si se crearon con claves seguras, respaldo y limitaciones de despliegue. No publicar una contraseña real en el PDF/repositorio.

### 15. Resultados, limitaciones y conclusiones

#### 15.1 Resultados

Informar requisitos y módulos comprobados, cantidad de pruebas ejecutadas y aprobadas, indicadores calculados y evidencia.

#### 15.2 Limitaciones

Describir pendientes reales: pagos no procesados, comprobante sin validez fiscal, escala/concurrencia del motor si aplica, despliegue local, módulos inconclusos u otras limitaciones encontradas.

#### 15.3 Conclusiones

Explicar resultados, decisiones, aprendizajes del equipo y tres mejoras prioritarias sustentadas en experiencia de desarrollo.

### 16. Anexos

Incluir ER ampliado, arquitectura, wireframes adicionales, colección OpenAPI/Postman, capturas, evidencias complementarias, matriz completa, guía breve de usuario cuando se solicite y fragmentos de código relevantes con referencia al archivo/commit. Proteger datos personales y credenciales.

### 17. Evidencia de Git y colaboración

Añadir URL del repositorio, ramas/release, capturas o enlaces al historial de commits y tabla de contribuciones confirmada por el equipo. Documentar trabajo progresivo. No atribuir a una persona commits de otra ni inventar una rama o release.

### 18. Lista de revisión antes del PDF

- [ ] Portada con materia, docente, grupo, integrantes, fecha y versión confirmados.
- [ ] Resumen, problema, objetivos, alcance y exclusiones.
- [ ] Modelo de negocio/contexto.
- [ ] Cronograma con fases, responsable, evidencia, comparación planeado/real y dependencias.
- [ ] Requisitos, reglas, aceptación y trazabilidad.
- [ ] Arquitectura justificada y flujo completo.
- [ ] Boceto comparado con pantalla final y decisiones visuales.
- [ ] ER, tablas reales, diccionario, claves y script reproducible.
- [ ] Endpoints implementados documentados con JSON, permisos y respuestas observadas.
- [ ] Módulos, reglas y seguridad verificadas.
- [ ] Matriz con resultados observados, incluidos permisos, duplicidad, stock y transacciones.
- [ ] Instalación/configuración comprobada sin credenciales en claro.
- [ ] Evidencia real de repositorio y aportación de equipo.
- [ ] Resultados, limitaciones y conclusiones.
- [ ] Anexos necesarios, títulos de figura/tabla, índice y páginas numeradas.
- [ ] PDF exportado, legible y revisado visualmente página por página.

### 19. Matriz de trazabilidad

| Requisito | Descripción | Módulo/ruta real | Caso de prueba | Evidencia/commit | Estado |
|---|---|---|---|---|---|
| RF-01 | [Pendiente] | [Pendiente] | [Pendiente] | [Pendiente] | Planeado |
| RF-11 | Venta transaccional y consistencia de inventario | [Completar con ruta real] | CP-04/CP-06/CP-07 | [Pendiente] | Por comprobar |
| RNF-03 | Navegador sin acceso directo a BD | [Completar con evidencia de capas] | CP-02 | [Pendiente] | Por comprobar |

Ampliar filas hasta cubrir cada `RF-*`, `RNF-*` y criterio prioritario. “Por comprobar” no equivale a “cumplido”.

### 20. Fuentes y control de veracidad

Fuentes de esta estructura: `Lineamientos_Documentacion_Proyecto_Final_Software.pdf` (edición académica 2026) y `Requerimientos_Proyectos_Finales_Software.md` adjuntos por el usuario. Las reglas y mínimos académicos se documentan como requisitos. Cualquier diferencia o interpretación del docente se resuelve con la guía docente y queda asentada en el control de versión.

### 21. Estructura recomendada para archivos de entrega

```text
panaderia/
├── README.md
├── .env.example
├── .gitignore
├── database/
│   ├── schema.sql
│   ├── seed.sql
│   └── README.md
└── docs/
    ├── 01-REQUERIMIENTOS-DEL-SISTEMA.md
    ├── 02-ESTRUCTURA-DE-DOCUMENTACION.md
    ├── api.md
    ├── database.md
    ├── diagrams/
    ├── evidence/
    └── final-project-report.pdf
```

Es una propuesta para la entrega. Adoptar carpetas y scripts solo cuando correspondan al repositorio final real; el PDF debe apuntar a sus ubicaciones existentes.
