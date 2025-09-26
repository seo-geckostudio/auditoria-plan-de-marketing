<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    
    echo "=== AÑADIENDO COLUMNA numero_fase A LA TABLA FASES ===\n";
    
    // Añadir la columna numero_fase
    $pdo->exec("ALTER TABLE fases ADD COLUMN numero_fase INTEGER");
    
    // Actualizar los valores basándose en el orden existente
    $pdo->exec("UPDATE fases SET numero_fase = orden");
    
    echo "Columna numero_fase añadida exitosamente.\n";
    
    // Verificar la estructura actualizada
    echo "\n=== ESTRUCTURA ACTUALIZADA DE LA TABLA FASES ===\n";
    $result = $pdo->query('PRAGMA table_info(fases)');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'] . ' - ' . $row['type'] . "\n";
    }
    
    echo "\n=== DATOS ACTUALIZADOS EN FASES ===\n";
    $result = $pdo->query('SELECT id, nombre, orden, numero_fase FROM fases');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']}, Nombre: {$row['nombre']}, Orden: {$row['orden']}, Numero Fase: {$row['numero_fase']}\n";
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>