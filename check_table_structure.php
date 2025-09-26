<?php
require_once 'config/database.php';

try {
    $pdo = obtenerConexion();
    
    echo "Estructura de la tabla 'auditorias':\n";
    $stmt = $pdo->query('PRAGMA table_info(auditorias)');
    $columns = $stmt->fetchAll();
    
    foreach($columns as $col) {
        echo $col['name'] . ' (' . $col['type'] . ")\n";
    }
    
    echo "\nPrimeras 3 filas de auditorias:\n";
    $stmt = $pdo->query('SELECT * FROM auditorias LIMIT 3');
    $rows = $stmt->fetchAll();
    
    foreach($rows as $row) {
        print_r($row);
        echo "---\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>