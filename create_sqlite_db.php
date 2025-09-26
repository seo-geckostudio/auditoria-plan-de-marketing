<?php
// Script para crear la base de datos SQLite
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
    
    // Leer el esquema SQL y adaptarlo para SQLite
    $sql = file_get_contents(__DIR__ . '/database_schema.sql');
    
    // Adaptar el SQL para SQLite
    $sql = str_replace('AUTO_INCREMENT', '', $sql);
    $sql = str_replace('ENGINE=InnoDB', '', $sql);
    $sql = str_replace('CHARSET=utf8mb4', '', $sql);
    $sql = str_replace('COLLATE=utf8mb4_unicode_ci', '', $sql);
    $sql = str_replace('int(11)', 'INTEGER', $sql);
    $sql = str_replace('varchar(', 'TEXT(', $sql);
    $sql = str_replace('text', 'TEXT', $sql);
    $sql = str_replace('TEXT NOT NULL', 'TEXT', $sql);
    $sql = str_replace('datetime', 'DATETIME', $sql);
    $sql = str_replace('CURRENT_TIMESTAMP', "datetime('now')", $sql);
    $sql = str_replace('ON UPDATE CURRENT_TIMESTAMP', '', $sql);
    
    // Dividir en declaraciones individuales
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement) && !preg_match('/^(USE|CREATE DATABASE|DROP DATABASE)/i', $statement)) {
            try {
                $pdo->exec($statement);
                echo "Ejecutado: " . substr($statement, 0, 50) . "...\n";
            } catch (PDOException $e) {
                echo "Error en: " . substr($statement, 0, 50) . "... - " . $e->getMessage() . "\n";
            }
        }
    }
    
    // Insertar usuario administrador por defecto
    $stmt = $pdo->prepare("
        INSERT OR REPLACE INTO usuarios (id, nombre, email, password, rol, activo, fecha_creacion, fecha_actualizacion) 
        VALUES (1, 'Administrador', 'admin@auditoria.com', ?, 'admin', 1, datetime('now'), datetime('now'))
    ");
    
    $stmt->execute([password_hash('admin123', PASSWORD_DEFAULT)]);
    
    echo "Base de datos SQLite creada exitosamente\n";
    echo "Usuario administrador creado: admin@auditoria.com / admin123\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>