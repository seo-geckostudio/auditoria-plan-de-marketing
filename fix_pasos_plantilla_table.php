<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    
    echo "=== AÑADIENDO COLUMNAS FALTANTES A LA TABLA PASOS_PLANTILLA ===\n";
    
    // Añadir las columnas que faltan según el esquema
    $columnas_a_añadir = [
        'codigo_paso TEXT',
        'nombre TEXT',
        'instrucciones TEXT',
        'orden_en_fase INTEGER',
        'es_critico INTEGER DEFAULT 0',
        'tiempo_estimado INTEGER',
        'herramientas_necesarias TEXT',
        'criterios_validacion TEXT'
    ];
    
    foreach ($columnas_a_añadir as $columna) {
        try {
            $pdo->exec("ALTER TABLE pasos_plantilla ADD COLUMN $columna");
            echo "Columna añadida: $columna\n";
        } catch (Exception $e) {
            echo "Error añadiendo $columna: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n=== ESTRUCTURA ACTUALIZADA DE LA TABLA PASOS_PLANTILLA ===\n";
    $result = $pdo->query('PRAGMA table_info(pasos_plantilla)');
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'] . ' - ' . $row['type'] . "\n";
    }
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>