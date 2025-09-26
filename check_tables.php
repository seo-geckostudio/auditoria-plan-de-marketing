<?php
require_once 'config/database.php';

try {
    $pdo = obtenerConexion();
    $stmt = $pdo->query('SELECT name FROM sqlite_master WHERE type="table" ORDER BY name');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Tablas existentes en la base de datos:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    
    echo "\nVerificando estructura de tablas principales:\n";
    
    // Verificar estructura de auditorias
    if (in_array('auditorias', $tables)) {
        echo "\nEstructura de la tabla 'auditorias':\n";
        $stmt = $pdo->query('PRAGMA table_info(auditorias)');
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($columns as $column) {
            echo "  - {$column['name']} ({$column['type']})\n";
        }
    }
    
    // Verificar si existe auditoria_pasos
    if (in_array('auditoria_pasos', $tables)) {
        echo "\nEstructura de la tabla 'auditoria_pasos':\n";
        $stmt = $pdo->query('PRAGMA table_info(auditoria_pasos)');
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($columns as $column) {
            echo "  - {$column['name']} ({$column['type']})\n";
        }
    } else {
        echo "\n⚠️  La tabla 'auditoria_pasos' NO existe en la base de datos.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>