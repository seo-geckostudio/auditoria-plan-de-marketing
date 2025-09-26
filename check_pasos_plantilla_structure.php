<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    
    echo "=== ESTRUCTURA DE LA TABLA PASOS_PLANTILLA ===\n";
    $result = $pdo->query('PRAGMA table_info(pasos_plantilla)');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'] . ' - ' . $row['type'] . "\n";
    }
    
    echo "\n=== DATOS ACTUALES EN PASOS_PLANTILLA (PRIMEROS 3) ===\n";
    $result = $pdo->query('SELECT * FROM pasos_plantilla LIMIT 3');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>