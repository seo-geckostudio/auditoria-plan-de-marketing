-- =====================================================
-- NUEVAS TABLAS PARA SISTEMA DE FORMULARIOS DINÁMICOS
-- =====================================================
-- Fecha: 2025-09-27
-- Propósito: Permitir formularios dinámicos para captura de datos

-- =====================================================
-- TABLA: paso_campos
-- Descripción: Define los campos de formulario para cada paso plantilla
-- =====================================================
CREATE TABLE paso_campos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    paso_plantilla_id INTEGER NOT NULL,
    nombre_campo TEXT NOT NULL, -- nombre del campo (sin espacios, ej: "empresa_nombre")
    tipo_campo TEXT NOT NULL CHECK (tipo_campo IN ('text', 'textarea', 'select', 'number', 'date', 'email', 'url', 'checkbox', 'radio')),
    etiqueta TEXT NOT NULL, -- texto que ve el usuario
    placeholder TEXT, -- texto de ejemplo en el campo
    descripcion_ayuda TEXT, -- texto de ayuda adicional
    opciones TEXT, -- JSON con opciones para select/radio/checkbox
    valor_por_defecto TEXT, -- valor inicial del campo
    obligatorio INTEGER DEFAULT 0, -- 1 = campo requerido
    orden INTEGER DEFAULT 0, -- orden de visualización
    validacion_regex TEXT, -- expresión regular para validación
    min_length INTEGER, -- longitud mínima (para text/textarea)
    max_length INTEGER, -- longitud máxima (para text/textarea)
    min_value REAL, -- valor mínimo (para number)
    max_value REAL, -- valor máximo (para number)
    activo INTEGER DEFAULT 1,
    fecha_creacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (paso_plantilla_id) REFERENCES pasos_plantilla(id) ON DELETE CASCADE,
    UNIQUE (paso_plantilla_id, nombre_campo)
);

-- =====================================================
-- TABLA: paso_datos
-- Descripción: Almacena los valores introducidos por el usuario
-- =====================================================
CREATE TABLE paso_datos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_paso_id INTEGER NOT NULL,
    campo_id INTEGER NOT NULL,
    valor TEXT, -- valor introducido por el usuario
    fecha_captura TEXT DEFAULT (datetime('now')),
    fecha_actualizacion TEXT DEFAULT (datetime('now')),
    usuario_id INTEGER, -- quién introdujo el dato
    FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
    FOREIGN KEY (campo_id) REFERENCES paso_campos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    UNIQUE (auditoria_paso_id, campo_id) -- un valor por campo por paso
);

-- =====================================================
-- TABLA: csv_configuraciones
-- Descripción: Configuraciones para importar diferentes tipos de CSV
-- =====================================================
CREATE TABLE csv_configuraciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    paso_plantilla_id INTEGER NOT NULL,
    nombre_configuracion TEXT NOT NULL, -- ej: "GSC_Keywords", "Ahrefs_Organic"
    descripcion TEXT,
    origen_herramienta TEXT, -- ej: "Google Search Console", "Ahrefs"
    columnas_esperadas TEXT NOT NULL, -- JSON con estructura esperada
    separador TEXT DEFAULT ',',
    delimitador_texto TEXT DEFAULT '"',
    codificacion TEXT DEFAULT 'UTF-8',
    tiene_cabeceras INTEGER DEFAULT 1,
    fila_inicio INTEGER DEFAULT 1, -- desde qué fila empezar a leer datos
    ejemplo_archivo TEXT, -- ruta a archivo de ejemplo
    instrucciones_exportacion TEXT, -- cómo exportar desde la herramienta
    activa INTEGER DEFAULT 1,
    fecha_creacion TEXT DEFAULT (datetime('now')),
    FOREIGN KEY (paso_plantilla_id) REFERENCES pasos_plantilla(id) ON DELETE CASCADE
);

-- =====================================================
-- TABLA: csv_datos
-- Descripción: Almacena datos importados desde CSV
-- =====================================================
CREATE TABLE csv_datos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    auditoria_paso_id INTEGER NOT NULL,
    csv_configuracion_id INTEGER NOT NULL,
    fila_numero INTEGER NOT NULL,
    datos_json TEXT NOT NULL, -- todos los campos de la fila en JSON
    validado INTEGER DEFAULT 0, -- si los datos han sido validados
    errores_validacion TEXT, -- errores encontrados en JSON
    fecha_importacion TEXT DEFAULT (datetime('now')),
    usuario_id INTEGER,
    FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
    FOREIGN KEY (csv_configuracion_id) REFERENCES csv_configuraciones(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- =====================================================
-- ACTUALIZAR TABLA: pasos_plantilla
-- Agregar columna para especificar métodos de entrada permitidos
-- =====================================================
ALTER TABLE pasos_plantilla ADD COLUMN metodos_entrada TEXT DEFAULT '["formulario"]';
-- JSON array: ["formulario", "archivo", "csv"]

-- =====================================================
-- ÍNDICES PARA OPTIMIZACIÓN
-- =====================================================
CREATE INDEX idx_paso_campos_plantilla ON paso_campos(paso_plantilla_id);
CREATE INDEX idx_paso_datos_auditoria_paso ON paso_datos(auditoria_paso_id);
CREATE INDEX idx_paso_datos_campo ON paso_datos(campo_id);
CREATE INDEX idx_csv_datos_auditoria_paso ON csv_datos(auditoria_paso_id);
CREATE INDEX idx_csv_datos_configuracion ON csv_datos(csv_configuracion_id);

-- =====================================================
-- INSERTAR DATOS DE EJEMPLO
-- =====================================================

-- Configuración para Brief Cliente (FASE 1)
INSERT INTO paso_campos (paso_plantilla_id, nombre_campo, tipo_campo, etiqueta, placeholder, descripcion_ayuda, obligatorio, orden) VALUES
(1, 'empresa_nombre', 'text', 'Nombre de la empresa', 'Ejemplo: TechCorp SL', 'Nombre oficial de la empresa del cliente', 1, 1),
(1, 'sector', 'select', 'Sector/Industria', '', 'Sector principal donde opera la empresa', 1, 2),
(1, 'url_principal', 'url', 'URL principal', 'https://www.ejemplo.com', 'Sitio web principal a auditar', 1, 3),
(1, 'contacto_nombre', 'text', 'Persona de contacto', 'Juan Pérez', 'Responsable del proyecto SEO en el cliente', 1, 4),
(1, 'contacto_email', 'email', 'Email de contacto', 'juan@ejemplo.com', 'Email del responsable del proyecto', 1, 5),
(1, 'objetivos_seo', 'textarea', 'Objetivos SEO principales', '', 'Describe los objetivos principales de la auditoría', 1, 6),
(1, 'mercados_objetivo', 'text', 'Mercados geográficos', 'España, Francia', 'Países o regiones donde quiere posicionar', 0, 7),
(1, 'competencia_principal', 'textarea', 'Competencia principal', '', 'Lista los 3-5 competidores directos más importantes', 0, 8);

-- Opciones para el campo sector
UPDATE paso_campos SET opciones = '["Ecommerce","SaaS","Servicios Locales","Turismo","Salud","Educación","Finanzas","Inmobiliario","Tecnología","Otros"]'
WHERE nombre_campo = 'sector';

-- Configuración CSV para Keywords Actuales (FASE 2)
INSERT INTO csv_configuraciones (paso_plantilla_id, nombre_configuracion, descripcion, origen_herramienta, columnas_esperadas, instrucciones_exportacion) VALUES
(3, 'GSC_Keywords', 'Exportación de keywords desde Google Search Console', 'Google Search Console',
'{"consulta": "string", "clics": "integer", "impresiones": "integer", "ctr": "float", "posicion": "float"}',
'1. Ir a Rendimiento > Consultas\n2. Filtrar últimos 12 meses\n3. Mostrar Clics, Impresiones, CTR, Posición\n4. Exportar CSV');

INSERT INTO csv_configuraciones (paso_plantilla_id, nombre_configuracion, descripcion, origen_herramienta, columnas_esperadas, instrucciones_exportacion) VALUES
(3, 'Ahrefs_Keywords', 'Keywords orgánicas desde Ahrefs', 'Ahrefs',
'{"keyword": "string", "position": "integer", "volume": "integer", "kd": "integer", "traffic": "integer", "url": "string"}',
'1. Site Explorer > Organic Keywords\n2. Seleccionar dominio completo\n3. Exportar todas las posiciones\n4. Descargar CSV');

-- Actualizar métodos permitidos para diferentes pasos
UPDATE pasos_plantilla SET metodos_entrada = '["formulario"]' WHERE codigo_paso LIKE '01_brief_cliente';
UPDATE pasos_plantilla SET metodos_entrada = '["formulario", "archivo"]' WHERE codigo_paso LIKE '02_roadmap%';
UPDATE pasos_plantilla SET metodos_entrada = '["csv", "formulario"]' WHERE codigo_paso LIKE '03_keywords%';
UPDATE pasos_plantilla SET metodos_entrada = '["csv", "formulario"]' WHERE codigo_paso LIKE '12_posicionamiento%';