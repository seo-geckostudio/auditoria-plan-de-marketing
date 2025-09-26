<?php
// Script simplificado para crear la base de datos SQLite
require_once __DIR__ . '/config/database_config.php';

try {
    // Crear directorio si no existe
    $dataDir = dirname(SQLITE_DB_PATH);
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    // Conectar a SQLite
    $pdo = new PDO('sqlite:' . SQLITE_DB_PATH, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    echo "Conexión SQLite establecida exitosamente\n";
    
    // Crear tablas básicas para SQLite
    $tables = [
        "CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            rol TEXT DEFAULT 'usuario',
            activo INTEGER DEFAULT 1,
            fecha_creacion DATETIME DEFAULT (datetime('now')),
            fecha_actualizacion DATETIME DEFAULT (datetime('now'))
        )",
        
        "CREATE TABLE IF NOT EXISTS clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre_empresa TEXT NOT NULL,
            contacto_nombre TEXT,
            contacto_email TEXT,
            contacto_telefono TEXT,
            sector TEXT,
            url_principal TEXT,
            pais TEXT,
            notas TEXT,
            fecha_creacion DATETIME DEFAULT (datetime('now')),
            fecha_actualizacion DATETIME DEFAULT (datetime('now'))
        )",
        
        "CREATE TABLE IF NOT EXISTS fases (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            descripcion TEXT,
            orden INTEGER NOT NULL,
            activo INTEGER DEFAULT 1,
            fecha_creacion DATETIME DEFAULT (datetime('now')),
            fecha_actualizacion DATETIME DEFAULT (datetime('now'))
        )",
        
        "CREATE TABLE IF NOT EXISTS pasos_plantilla (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            fase_id INTEGER NOT NULL,
            titulo TEXT NOT NULL,
            descripcion TEXT,
            contenido TEXT,
            orden INTEGER NOT NULL,
            activo INTEGER DEFAULT 1,
            fecha_creacion DATETIME DEFAULT (datetime('now')),
            fecha_actualizacion DATETIME DEFAULT (datetime('now')),
            FOREIGN KEY (fase_id) REFERENCES fases(id)
        )",
        
        "CREATE TABLE IF NOT EXISTS auditorias (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            cliente_id INTEGER NOT NULL,
            usuario_id INTEGER NOT NULL,
            titulo TEXT NOT NULL,
            descripcion TEXT,
            estado TEXT DEFAULT 'pendiente',
            porcentaje_completado REAL DEFAULT 0.00,
            fecha_inicio DATETIME,
            fecha_fin DATETIME,
            fecha_creacion DATETIME DEFAULT (datetime('now')),
            fecha_actualizacion DATETIME DEFAULT (datetime('now')),
            FOREIGN KEY (cliente_id) REFERENCES clientes(id),
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        )"
    ];
    
    foreach ($tables as $sql) {
        $pdo->exec($sql);
        echo "Tabla creada exitosamente\n";
    }
    
    // Insertar datos básicos
    
    // Insertar usuario administrador
    $stmt = $pdo->prepare("
        INSERT OR REPLACE INTO usuarios (id, nombre, email, password, rol, activo, fecha_creacion, fecha_actualizacion) 
        VALUES (1, 'Administrador', 'admin@auditoria.com', ?, 'admin', 1, datetime('now'), datetime('now'))
    ");
    $stmt->execute([password_hash('admin123', PASSWORD_DEFAULT)]);
    echo "Usuario administrador creado\n";
    
    // Insertar fases básicas
    $fases = [
        [1, 'Preparación', 'Fase inicial de preparación y configuración', 1],
        [2, 'Keyword Research', 'Investigación y análisis de palabras clave', 2],
        [3, 'Arquitectura', 'Análisis de arquitectura web y estructura', 3],
        [4, 'Recopilación de Datos', 'Recopilación y análisis de datos SEO', 4]
    ];
    
    foreach ($fases as $fase) {
        $stmt = $pdo->prepare("
            INSERT OR REPLACE INTO fases (id, nombre, descripcion, orden, activo, fecha_creacion, fecha_actualizacion) 
            VALUES (?, ?, ?, ?, 1, datetime('now'), datetime('now'))
        ");
        $stmt->execute($fase);
    }
    echo "Fases básicas creadas\n";
    
    // Insertar cliente de ejemplo
    $stmt = $pdo->prepare("
        INSERT OR REPLACE INTO clientes (id, nombre_empresa, contacto_nombre, contacto_email, contacto_telefono, sector, url_principal, pais, notas, fecha_creacion, fecha_actualizacion) 
        VALUES (1, 'Empresa Ejemplo', 'Juan Pérez', 'juan@ejemplo.com', '123456789', 'Tecnología', 'https://ejemplo.com', 'España', 'Cliente de ejemplo para pruebas', datetime('now'), datetime('now'))
    ");
    $stmt->execute();
    echo "Cliente de ejemplo creado\n";
    
    echo "\n=== BASE DE DATOS SQLITE CREADA EXITOSAMENTE ===\n";
    echo "Archivo: " . SQLITE_DB_PATH . "\n";
    echo "Usuario administrador: admin@auditoria.com / admin123\n";
    echo "Cliente de ejemplo creado\n";
    echo "4 fases básicas configuradas\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>