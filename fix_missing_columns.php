<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    
    echo "=== AÑADIENDO COLUMNAS FALTANTES ADICIONALES ===\n";
    
    // Añadir las columnas que faltan según el import_pasos.php
    $columnas_adicionales = [
        'tiempo_estimado_horas INTEGER',
        'archivo_origen TEXT'
    ];
    
    foreach ($columnas_adicionales as $columna) {
        try {
            $pdo->exec("ALTER TABLE pasos_plantilla ADD COLUMN $columna");
            echo "Columna añadida: $columna\n";
        } catch (Exception $e) {
            echo "Error añadiendo $columna: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n=== ESTRUCTURA FINAL DE LA TABLA PASOS_PLANTILLA ===\n";
    $result = $pdo->query('PRAGMA table_info(pasos_plantilla)');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'] . ' - ' . $row['type'] . "\n";
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>