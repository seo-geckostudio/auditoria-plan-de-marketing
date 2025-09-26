<?php
require_once 'config/database.php';

try {
    $pdo = obtenerConexion();
    
    echo "Creando tablas faltantes...\n";
    
    // Crear tabla auditoria_pasos
    $sql_auditoria_pasos = "
    CREATE TABLE IF NOT EXISTS auditoria_pasos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        auditoria_id INTEGER NOT NULL,
        paso_plantilla_id INTEGER NOT NULL,
        estado TEXT DEFAULT 'pendiente' CHECK (estado IN ('pendiente', 'en_progreso', 'completado', 'omitido', 'bloqueado')),
        fecha_inicio TEXT NULL,
        fecha_completado TEXT NULL,
        tiempo_real_horas REAL DEFAULT NULL,
        notas TEXT,
        datos_completados TEXT,
        usuario_asignado_id INTEGER NULL,
        orden_personalizado INTEGER NULL,
        fecha_creacion TEXT DEFAULT (datetime('now')),
        fecha_actualizacion TEXT DEFAULT (datetime('now')),
        FOREIGN KEY (auditoria_id) REFERENCES auditorias(id) ON DELETE CASCADE,
        FOREIGN KEY (paso_plantilla_id) REFERENCES pasos_plantilla(id) ON DELETE RESTRICT,
        FOREIGN KEY (usuario_asignado_id) REFERENCES usuarios(id) ON DELETE SET NULL
    )";
    
    $pdo->exec($sql_auditoria_pasos);
    echo "✅ Tabla 'auditoria_pasos' creada exitosamente.\n";
    
    // Crear tabla archivos
    $sql_archivos = "
    CREATE TABLE IF NOT EXISTS archivos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        auditoria_paso_id INTEGER NOT NULL,
        nombre_archivo TEXT NOT NULL,
        nombre_original TEXT NOT NULL,
        ruta_archivo TEXT NOT NULL,
        tipo_mime TEXT,
        tamaño_bytes INTEGER,
        descripcion TEXT,
        fecha_subida TEXT DEFAULT (datetime('now')),
        usuario_subida_id INTEGER NOT NULL,
        FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_subida_id) REFERENCES usuarios(id) ON DELETE RESTRICT
    )";
    
    $pdo->exec($sql_archivos);
    echo "✅ Tabla 'archivos' creada exitosamente.\n";
    
    // Crear tabla comentarios
    $sql_comentarios = "
    CREATE TABLE IF NOT EXISTS comentarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        auditoria_paso_id INTEGER NOT NULL,
        usuario_id INTEGER NOT NULL,
        comentario TEXT NOT NULL,
        es_interno INTEGER DEFAULT 0,
        fecha_creacion TEXT DEFAULT (datetime('now')),
        FOREIGN KEY (auditoria_paso_id) REFERENCES auditoria_pasos(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
    )";
    
    $pdo->exec($sql_comentarios);
    echo "✅ Tabla 'comentarios' creada exitosamente.\n";
    
    // Verificar tablas creadas
    echo "\nVerificando tablas creadas:\n";
    $stmt = $pdo->query('SELECT name FROM sqlite_master WHERE type="table" ORDER BY name');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>