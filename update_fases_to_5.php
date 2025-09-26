<?php
/**
 * Script para actualizar la base de datos con las 5 fases del sistema
 * Ejecutar una sola vez para migrar de 4 a 5 fases
 */

require_once 'config/database.php';

try {
    // Conectar a la base de datos
    $pdo = obtenerConexion();
    
    echo "Iniciando actualización de fases...\n";
    
    // Verificar si ya existe la fase 0
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM fases WHERE numero_fase = 0");
    $stmt->execute();
    $existe_fase_0 = $stmt->fetchColumn() > 0;
    
    if (!$existe_fase_0) {
        // Insertar la nueva Fase 0: Marketing Digital
        $stmt = $pdo->prepare("
            INSERT INTO fases (numero_fase, nombre, descripcion, orden, activo) 
            VALUES (0, 'Contexto Marketing Digital', 'Análisis opcional del contexto de marketing digital y competencia', 0, 1)
        ");
        $stmt->execute();
        echo "✓ Fase 0 (Marketing Digital) agregada\n";
    } else {
        echo "✓ Fase 0 ya existe\n";
    }
    
    // Verificar si ya existe la fase 5
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM fases WHERE numero_fase = 5");
    $stmt->execute();
    $existe_fase_5 = $stmt->fetchColumn() > 0;
    
    if (!$existe_fase_5) {
        // Insertar la nueva Fase 5: Entregables Finales
        $stmt = $pdo->prepare("
            INSERT INTO fases (numero_fase, nombre, descripcion, orden, activo) 
            VALUES (5, 'Entregables Finales', 'Generación de informes ejecutivos y técnicos finales', 5, 1)
        ");
        $stmt->execute();
        echo "✓ Fase 5 (Entregables Finales) agregada\n";
    } else {
        echo "✓ Fase 5 ya existe\n";
    }
    
    // Actualizar nombres de fases existentes según nueva documentación
    $actualizaciones = [
        1 => ['nombre' => 'Análisis Inicial', 'descripcion' => 'Análisis inicial del sitio web y recopilación de datos básicos'],
        2 => ['nombre' => 'Análisis de Contenido', 'descripcion' => 'Evaluación detallada del contenido y estructura del sitio'],
        3 => ['nombre' => 'Análisis de Competencia', 'descripcion' => 'Análisis comparativo con la competencia y benchmarking'],
        4 => ['nombre' => 'Análisis Técnico', 'descripcion' => 'Análisis técnico completo del sitio web y datos de rendimiento']
    ];
    
    foreach ($actualizaciones as $numero_fase => $datos) {
        $stmt = $pdo->prepare("
            UPDATE fases 
            SET nombre = ?, descripcion = ? 
            WHERE numero_fase = ?
        ");
        $stmt->execute([$datos['nombre'], $datos['descripcion'], $numero_fase]);
        echo "✓ Fase $numero_fase actualizada: {$datos['nombre']}\n";
    }
    
    // Mostrar todas las fases actuales
    echo "\n=== FASES ACTUALES ===\n";
    $stmt = $pdo->query("SELECT numero_fase, nombre, descripcion FROM fases ORDER BY numero_fase");
    while ($fase = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Fase {$fase['numero_fase']}: {$fase['nombre']}\n";
        echo "  Descripción: {$fase['descripcion']}\n\n";
    }
    
    echo "✅ Actualización completada exitosamente\n";
    
} catch (Exception $e) {
    echo "❌ Error durante la actualización: " . $e->getMessage() . "\n";
    exit(1);
}
?>