-- =====================================================
-- ESQUEMA DE BASE DE DATOS - SISTEMA DE AUDITORÍAS SEO
-- =====================================================
-- Versión: 1.0 (SQLite)
-- Fecha: 2024
-- Descripción: Base de datos SQLite para gestionar auditorías SEO con múltiples fases y pasos

-- =====================================================
-- TABLA: usuarios
-- Descripción: Gestión de consultores/usuarios del sistema
-- =====================================================
CREATE TABLE usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    rol TEXT DEFAULT 'consultor' CHECK (rol IN ('admin', 'consultor')),
    activo INTEGER DEFAULT 1,
    fecha_creacion TEXT DEFAULT (datetime('now')),
    fecha_actualizacion TEXT DEFAULT (datetime('now'))
);

-- =====================================================
-- TABLA: clientes
-- Descripción: Información de los clientes para las auditorías
-- =====================================================
CREATE TABLE clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre_empresa TEXT NOT NULL,
    contacto_nombre TEXT,
    contacto_email TEXT,
    contacto_telefono TEXT,
    sector TEXT,
    url_principal TEXT,
    pais TEXT,
    notas TEXT,
    fecha_creacion TEXT DEFAULT (datetime('now')),
    fecha_actualizacion TEXT DEFAULT (datetime('now'))
);

-- =====================================================
-- TABLA: fases
-- Descripción: Las 6 fases principales de la auditoría (0-5)
-- =====================================================
CREATE TABLE fases (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero_fase INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    orden_visualizacion INTEGER NOT NULL,
    activa INTEGER DEFAULT 1,
    UNIQUE (numero_fase)
);

-- =====================================================
-- TABLA: pasos_plantilla
-- Descripción: Plantilla de pasos disponibles por fase (importados de documentos)
-- =====================================================
CREATE TABLE pasos_plantilla (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fase_id INTEGER NOT NULL,
    codigo_paso TEXT NOT NULL, -- Ej: "00_checklist_accesos"
    nombre TEXT NOT NULL,
    descripcion TEXT,
    instrucciones TEXT,
    orden_en_fase INTEGER NOT NULL,
    es_critico INTEGER DEFAULT 0, -- Si es paso crítico para continuar
    tiempo_estimado_horas REAL DEFAULT NULL,
    archivo_origen TEXT, -- Nombre del archivo .md original
    activo INTEGER DEFAULT 1,
    fecha_creacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (fase_id) REFERENCES fases(id) ON DELETE CASCADE,
    UNIQUE (fase_id, codigo_paso)
);

-- =====================================================
-- TABLA: auditorias
-- Descripción: Auditorías principales del sistema
-- =====================================================
CREATE TABLE auditorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL, -- Consultor responsable
    nombre_auditoria TEXT NOT NULL,
    descripcion TEXT,
    fecha_inicio TEXT NOT NULL,
    fecha_fin_estimada TEXT,
    fecha_fin_real TEXT NULL,
    estado TEXT DEFAULT 'planificada' CHECK (estado IN ('planificada', 'en_progreso', 'pausada', 'completada', 'cancelada')),
    prioridad TEXT DEFAULT 'media' CHECK (prioridad IN ('baja', 'media', 'alta', 'urgente')),
    porcentaje_completado REAL DEFAULT 0.00,
    notas_generales TEXT,
    configuracion_json TEXT, -- Configuraciones específicas de la auditoría (JSON como texto)
    fecha_creacion TEXT DEFAULT (datetime('now')),
    fecha_actualizacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE RESTRICT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
);

-- =====================================================
-- TABLA: auditoria_pasos
-- Descripción: Pasos específicos de cada auditoría con su estado
-- =====================================================
CREATE TABLE auditoria_pasos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_id INTEGER NOT NULL,
    paso_plantilla_id INTEGER NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK (estado IN ('pendiente', 'en_progreso', 'completado', 'omitido', 'bloqueado')),
    fecha_inicio TEXT NULL,
    fecha_completado TEXT NULL,
    tiempo_real_horas REAL DEFAULT NULL,
    notas TEXT,
    datos_completados TEXT, -- Datos específicos completados en este paso (JSON como texto)
    usuario_asignado_id INTEGER NULL, -- Usuario asignado a este paso específico
    orden_personalizado INTEGER NULL, -- Permite reordenar pasos si es necesario
    fecha_creacion TEXT DEFAULT (datetime('now')),
    fecha_actualizacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (auditoria_id) REFERENCES auditorias(id) ON DELETE CASCADE,
    FOREIGN KEY (paso_plantilla_id) REFERENCES pasos_plantilla(id) ON DELETE RESTRICT,
    FOREIGN KEY (usuario_asignado_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    UNIQUE (auditoria_id, paso_plantilla_id)
);

-- =====================================================
-- TABLA: archivos
-- Descripción: Archivos subidos asociados a pasos de auditoría
-- =====================================================
CREATE TABLE archivos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_paso_id INTEGER NOT NULL,
    nombre_original TEXT NOT NULL,
    nombre_archivo TEXT NOT NULL, -- Nombre único en el servidor
    ruta_archivo TEXT NOT NULL,
    tipo_mime TEXT,
    tamaño_bytes INTEGER NOT NULL,
    descripcion TEXT,
    es_principal INTEGER DEFAULT 0, -- Si es el archivo principal del paso
    fecha_subida TEXT DEFAULT (datetime('now')),
    subido_por_usuario_id INTEGER NOT NULL,
    FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
    FOREIGN KEY (subido_por_usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
);

-- =====================================================
-- TABLA: comentarios
-- Descripción: Comentarios y notas en pasos específicos
-- =====================================================
CREATE TABLE comentarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_paso_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    comentario TEXT NOT NULL,
    es_interno INTEGER DEFAULT 0, -- Si es comentario interno o visible al cliente
    fecha_creacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
);

-- =====================================================
-- TABLA: historial_cambios
-- Descripción: Log de cambios importantes en las auditorías
-- =====================================================
CREATE TABLE historial_cambios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    tipo_cambio TEXT NOT NULL CHECK (tipo_cambio IN ('creacion', 'estado_auditoria', 'estado_paso', 'archivo_subido', 'comentario', 'asignacion')),
    descripcion TEXT NOT NULL,
    datos_anteriores TEXT NULL,
    datos_nuevos TEXT NULL,
    fecha_cambio TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (auditoria_id) REFERENCES auditorias(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
);

-- =====================================================
-- INSERCIÓN DE DATOS INICIALES
-- =====================================================

-- Insertar las 6 fases principales (0-5)
INSERT INTO fases (numero_fase, nombre, descripcion, orden_visualizacion) VALUES
(0, 'Contexto Marketing Digital', 'Análisis del contexto de marketing digital (opcional)', 0),
(1, 'Análisis Inicial', 'Preparación y configuración inicial de la auditoría', 1),
(2, 'Análisis de Contenido', 'Investigación de palabras clave y contenido', 2),
(3, 'Análisis de Competencia', 'Arquitectura de información y estructura del sitio', 3),
(4, 'Análisis Técnico', 'Recopilación y análisis de datos técnicos', 4),
(5, 'Entregables Finales', 'Generación de informes y entregables', 5);

-- Usuario administrador por defecto
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@sistema.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- =====================================================
-- ÍNDICES PARA OPTIMIZACIÓN
-- =====================================================

-- Índices para búsquedas frecuentes
CREATE INDEX idx_auditorias_estado ON auditorias(estado);
CREATE INDEX idx_auditorias_fecha_inicio ON auditorias(fecha_inicio);
CREATE INDEX idx_auditorias_cliente ON auditorias(cliente_id);
CREATE INDEX idx_auditorias_usuario ON auditorias(usuario_id);

CREATE INDEX idx_auditoria_pasos_estado ON auditoria_pasos(estado);
CREATE INDEX idx_auditoria_pasos_auditoria ON auditoria_pasos(auditoria_id);
CREATE INDEX idx_auditoria_pasos_fecha_completado ON auditoria_pasos(fecha_completado);

CREATE INDEX idx_archivos_paso ON archivos(auditoria_paso_id);
CREATE INDEX idx_archivos_fecha ON archivos(fecha_subida);

CREATE INDEX idx_comentarios_paso ON comentarios(auditoria_paso_id);
CREATE INDEX idx_comentarios_fecha ON comentarios(fecha_creacion);

CREATE INDEX idx_historial_auditoria ON historial_cambios(auditoria_id);
CREATE INDEX idx_historial_fecha ON historial_cambios(fecha_cambio);

-- =====================================================
-- VISTAS ÚTILES PARA CONSULTAS FRECUENTES
-- =====================================================

-- Vista: Resumen de auditorías con información del cliente
CREATE VIEW vista_auditorias_resumen AS
SELECT 
    a.id,
    a.nombre_auditoria,
    c.nombre_empresa as cliente,
    u.nombre as consultor,
    a.estado,
    a.porcentaje_completado,
    a.fecha_inicio,
    a.fecha_fin_estimada,
    COUNT(ap.id) as total_pasos,
    SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados,
    SUM(CASE WHEN ap.estado = 'pendiente' THEN 1 ELSE 0 END) as pasos_pendientes
FROM auditorias a
LEFT JOIN clientes c ON a.cliente_id = c.id
LEFT JOIN usuarios u ON a.usuario_id = u.id
LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
GROUP BY a.id;

-- Vista: Pasos por fase con información detallada
CREATE VIEW vista_pasos_por_fase AS
SELECT 
    f.numero_fase,
    f.nombre as fase_nombre,
    pt.codigo_paso,
    pt.nombre as paso_nombre,
    pt.es_critico,
    pt.tiempo_estimado_horas,
    pt.orden_en_fase
FROM fases f
LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
WHERE pt.activo = 1
ORDER BY f.numero_fase, pt.orden_en_fase;

-- =====================================================
-- COMENTARIOS FINALES
-- =====================================================
/*
ESTRUCTURA DE LA BASE DE DATOS:

1. USUARIOS: Gestión de consultores y administradores
2. CLIENTES: Información de empresas que solicitan auditorías
3. FASES: Las 6 fases principales del proceso de auditoría (0-5)
4. PASOS_PLANTILLA: Plantilla de pasos importados desde documentos .md
5. AUDITORIAS: Auditorías principales con información general
6. AUDITORIA_PASOS: Pasos específicos de cada auditoría con estados
7. ARCHIVOS: Archivos subidos asociados a cada paso
8. COMENTARIOS: Notas y comentarios en pasos específicos
9. HISTORIAL_CAMBIOS: Log completo de cambios para auditoría

CARACTERÍSTICAS PRINCIPALES:
- Estructura normalizada y escalable
- Soporte para múltiples usuarios y clientes
- Tracking completo de progreso y cambios
- Flexibilidad para personalizar pasos por auditoría
- Sistema de archivos organizado
- Índices optimizados para consultas frecuentes
- Vistas para facilitar consultas
- Compatibilidad con SQLite
- Sistema de 6 fases (0-5) con fase opcional de contexto
*/