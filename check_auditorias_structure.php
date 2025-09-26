<?php
require_once 'config/database.php';

try {
    $pdo = obtenerConexion();
    
    echo "Estructura de la tabla 'auditorias':\n";
    $stmt = $pdo->query('PRAGMA table_info(auditorias)');
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "- {$column['name']} ({$column['type']})\n";
    }
    
    echo "\nDatos de ejemplo en auditorias:\n";
    $stmt = $pdo->query('SELECT * FROM auditorias LIMIT 3');
    $auditorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($auditorias) > 0) {
        foreach ($auditorias as $auditoria) {
            echo "ID: {$auditoria['id']}\n";
            foreach ($auditoria as $key => $value) {
                echo "  $key: $value\n";
            }
            echo "---\n";
        }
    } else {
        echo "No hay auditorías en la base de datos.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>