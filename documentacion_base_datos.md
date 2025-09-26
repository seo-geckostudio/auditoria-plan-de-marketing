# 📊 DOCUMENTACIÓN DE BASE DE DATOS - Sistema de Auditorías SEO

## 🎯 Objetivo
Esta base de datos está diseñada para gestionar de manera eficiente múltiples auditorías SEO simultáneas, permitiendo un seguimiento detallado del progreso, archivos y colaboración entre consultores.

---

## 🏗️ ARQUITECTURA GENERAL

### Principios de Diseño
- **Normalización**: Estructura normalizada para evitar redundancia
- **Escalabilidad**: Diseño que permite crecimiento sin reestructuración
- **Flexibilidad**: Adaptable a diferentes tipos de auditorías
- **Trazabilidad**: Registro completo de cambios y actividades
- **Performance**: Índices optimizados para consultas frecuentes

---

## 📋 ESTRUCTURA DE TABLAS

### 1. **usuarios**
**Propósito**: Gestión de consultores y administradores del sistema

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| nombre | VARCHAR(100) | Nombre completo del usuario |
| email | VARCHAR(150) | Email único para login |
| password | VARCHAR(255) | Contraseña hasheada |
| rol | ENUM | 'admin' o 'consultor' |
| activo | BOOLEAN | Estado del usuario |

**Relaciones**: 
- 1:N con `auditorias` (consultor responsable)
- 1:N con `auditoria_pasos` (usuario asignado)

---

### 2. **clientes**
**Propósito**: Información de empresas que solicitan auditorías

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| nombre_empresa | VARCHAR(200) | Nombre de la empresa |
| contacto_nombre | VARCHAR(100) | Persona de contacto |
| contacto_email | VARCHAR(150) | Email de contacto |
| url_principal | VARCHAR(255) | Sitio web principal |
| sector | VARCHAR(100) | Sector/industria |

**Relaciones**: 
- 1:N con `auditorias`

---

### 3. **fases**
**Propósito**: Las 5 fases principales del proceso de auditoría

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| numero_fase | TINYINT | Número de fase (0-4) |
| nombre | VARCHAR(100) | Nombre de la fase |
| descripcion | TEXT | Descripción detallada |
| orden_visualizacion | TINYINT | Orden de mostrar |

**Datos Iniciales**:
0. Contexto Marketing Digital (Opcional)
1. Preparación Inicial
2. Keyword Research  
3. Arquitectura del Sitio
4. Análisis Técnico
5. Entregables Finales

**Relaciones**: 
- 1:N con `pasos_plantilla`

---

### 4. **pasos_plantilla**
**Propósito**: Plantilla de pasos disponibles (importados desde documentos .md)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| fase_id | INT (FK) | Referencia a fase |
| codigo_paso | VARCHAR(50) | Código único (ej: "00_checklist_accesos") |
| nombre | VARCHAR(200) | Nombre descriptivo del paso |
| descripcion | TEXT | Descripción detallada |
| instrucciones | TEXT | Instrucciones específicas |
| orden_en_fase | TINYINT | Orden dentro de la fase |
| es_critico | BOOLEAN | Si es paso crítico |
| tiempo_estimado_horas | DECIMAL(4,2) | Tiempo estimado |
| archivo_origen | VARCHAR(255) | Archivo .md original |

**Relaciones**: 
- N:1 con `fases`
- 1:N con `auditoria_pasos`

---

### 5. **auditorias**
**Propósito**: Auditorías principales del sistema

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| cliente_id | INT (FK) | Referencia al cliente |
| usuario_id | INT (FK) | Consultor responsable |
| nombre_auditoria | VARCHAR(200) | Nombre descriptivo |
| fecha_inicio | DATE | Fecha de inicio |
| fecha_fin_estimada | DATE | Fecha estimada de finalización |
| estado | ENUM | 'planificada', 'en_progreso', 'pausada', 'completada', 'cancelada' |
| prioridad | ENUM | 'baja', 'media', 'alta', 'urgente' |
| porcentaje_completado | DECIMAL(5,2) | Porcentaje de progreso |
| configuracion_json | JSON | Configuraciones específicas |

**Relaciones**: 
- N:1 con `clientes`
- N:1 con `usuarios`
- 1:N con `auditoria_pasos`

---

### 6. **auditoria_pasos**
**Propósito**: Pasos específicos de cada auditoría con su estado

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| auditoria_id | INT (FK) | Referencia a auditoría |
| paso_plantilla_id | INT (FK) | Referencia a plantilla |
| estado | ENUM | 'pendiente', 'en_progreso', 'completado', 'omitido', 'bloqueado' |
| fecha_inicio | DATETIME | Cuándo se inició |
| fecha_completado | DATETIME | Cuándo se completó |
| tiempo_real_horas | DECIMAL(4,2) | Tiempo real invertido |
| datos_completados | JSON | Datos específicos del paso |
| usuario_asignado_id | INT (FK) | Usuario asignado |

**Relaciones**: 
- N:1 con `auditorias`
- N:1 con `pasos_plantilla`
- N:1 con `usuarios`
- 1:N con `archivos`

---

### 7. **archivos**
**Propósito**: Archivos subidos asociados a pasos

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| auditoria_paso_id | INT (FK) | Referencia al paso |
| nombre_original | VARCHAR(255) | Nombre original del archivo |
| nombre_archivo | VARCHAR(255) | Nombre único en servidor |
| ruta_archivo | VARCHAR(500) | Ruta completa |
| tipo_mime | VARCHAR(100) | Tipo de archivo |
| tamaño_bytes | INT | Tamaño en bytes |
| es_principal | BOOLEAN | Si es archivo principal |

**Relaciones**: 
- N:1 con `auditoria_pasos`
- N:1 con `usuarios` (quien subió)

---

### 8. **comentarios**
**Propósito**: Comentarios y notas en pasos específicos

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| auditoria_paso_id | INT (FK) | Referencia al paso |
| usuario_id | INT (FK) | Quien comentó |
| comentario | TEXT | Contenido del comentario |
| es_interno | BOOLEAN | Si es comentario interno |

**Relaciones**: 
- N:1 con `auditoria_pasos`
- N:1 con `usuarios`

---

### 9. **historial_cambios**
**Propósito**: Log completo de cambios para auditoría

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT (PK) | Identificador único |
| auditoria_id | INT (FK) | Referencia a auditoría |
| usuario_id | INT (FK) | Quien hizo el cambio |
| tipo_cambio | ENUM | Tipo de cambio realizado |
| descripcion | TEXT | Descripción del cambio |
| datos_anteriores | JSON | Estado anterior |
| datos_nuevos | JSON | Estado nuevo |

**Relaciones**: 
- N:1 con `auditorias`
- N:1 con `usuarios`

---

## 🔍 VISTAS PRINCIPALES

### vista_auditorias_resumen
Resumen completo de auditorías con información agregada:
- Información del cliente y consultor
- Estado y porcentaje de completado
- Conteo de pasos totales, completados y pendientes

### vista_pasos_por_fase
Listado organizado de todos los pasos disponibles por fase:
- Información de fase y paso
- Orden de ejecución
- Criticidad y tiempo estimado

---

## ⚙️ PROCEDIMIENTOS ALMACENADOS

### CalcularPorcentajeAuditoria(auditoria_id)
**Propósito**: Recalcula automáticamente el porcentaje de completado de una auditoría
**Parámetros**: ID de la auditoría
**Retorna**: Nuevo porcentaje calculado

---

## 🔄 TRIGGERS AUTOMÁTICOS

### actualizar_porcentaje_paso
**Evento**: Después de actualizar estado en `auditoria_pasos`
**Acción**: 
1. Recalcula porcentaje de la auditoría
2. Registra el cambio en `historial_cambios`

---

## 📈 ÍNDICES DE OPTIMIZACIÓN

### Índices Principales
- `idx_auditorias_estado`: Búsquedas por estado de auditoría
- `idx_auditorias_fecha_inicio`: Ordenamiento por fecha
- `idx_auditoria_pasos_estado`: Filtros por estado de pasos
- `idx_archivos_paso`: Archivos por paso
- `idx_historial_auditoria`: Historial por auditoría

---

## 🚀 CONSULTAS FRECUENTES

### 1. Obtener resumen de auditoría
```sql
SELECT * FROM vista_auditorias_resumen WHERE id = ?;
```

### 2. Pasos pendientes de una auditoría
```sql
SELECT ap.*, pt.nombre, pt.descripcion 
FROM auditoria_pasos ap
JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
WHERE ap.auditoria_id = ? AND ap.estado = 'pendiente'
ORDER BY pt.orden_en_fase;
```

### 3. Archivos de un paso específico
```sql
SELECT * FROM archivos 
WHERE auditoria_paso_id = ? 
ORDER BY es_principal DESC, fecha_subida DESC;
```

---

## 🔧 MANTENIMIENTO

### Tareas Regulares
1. **Limpieza de archivos**: Eliminar archivos huérfanos
2. **Optimización de índices**: Analizar y optimizar consultas lentas
3. **Backup**: Respaldo regular de datos críticos
4. **Monitoreo**: Revisar logs de cambios y actividad

### Consideraciones de Crecimiento
- La estructura soporta miles de auditorías simultáneas
- Los campos JSON permiten extensibilidad sin cambios de esquema
- Los índices están optimizados para las consultas más frecuentes

---

## 📋 CHECKLIST DE IMPLEMENTACIÓN

- [x] Crear esquema de base de datos
- [x] Insertar datos iniciales (fases, usuario admin)
- [x] Crear índices de optimización
- [x] Implementar vistas útiles
- [x] Crear procedimientos almacenados
- [x] Configurar triggers automáticos
- [ ] Crear script de importación de pasos desde documentos .md
- [ ] Implementar funciones PHP de conexión
- [ ] Crear funciones CRUD básicas
- [ ] Implementar sistema de backup automático

---

*Esta documentación debe actualizarse cada vez que se modifique la estructura de la base de datos.*