<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    
    echo "=== ESTRUCTURA DE LA TABLA FASES ===\n";
    $result = $pdo->query('PRAGMA table_info(fases)');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'] . ' - ' . $row['type'] . "\n";
    }
    
    echo "\n=== DATOS ACTUALES EN FASES ===\n";
    $result = $pdo->query('SELECT * FROM fases LIMIT 5');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>