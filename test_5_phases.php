<?php
// Test script to verify the 5-phase system
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/forms.php';

echo "<h2>Testing 5-Phase System</h2>\n";

try {
    $pdo = obtenerConexion();
    
    // Test 1: Check all phases in database
    echo "<h3>1. Phases in Database:</h3>\n";
    $stmt = $pdo->query("SELECT id, nombre, descripcion, numero_fase, orden FROM fases ORDER BY numero_fase");
    $fases = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1'>\n";
    echo "<tr><th>ID</th><th>Número Fase</th><th>Nombre</th><th>Descripción</th><th>Orden</th></tr>\n";
    foreach ($fases as $fase) {
        echo "<tr>";
        echo "<td>{$fase['id']}</td>";
        echo "<td>{$fase['numero_fase']}</td>";
        echo "<td>{$fase['nombre']}</td>";
        echo "<td>" . substr($fase['descripcion'], 0, 50) . "...</td>";
        echo "<td>{$fase['orden']}</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    
    // Test 2: Check phase directories exist
    echo "<h3>2. Phase Directories:</h3>\n";
    $expectedDirs = [
        'FASE_0_MARKETING_DIGITAL',
        'FASE_1_PREPARACION', 
        'FASE_2_KEYWORD_RESEARCH',
        'FASE_3_ARQUITECTURA',
        'FASE_4_RECOPILACION_DATOS',
        'FASE_5_ENTREGABLES_FINALES'
    ];
    
    echo "<ul>\n";
    foreach ($expectedDirs as $dir) {
        $exists = is_dir($dir) ? "✓ EXISTS" : "✗ MISSING";
        echo "<li>{$dir}: {$exists}</li>\n";
    }
    echo "</ul>\n";
    
    // Test 3: Check import_pasos.php phase mapping
    echo "<h3>3. Phase Mapping in import_pasos.php:</h3>\n";
    if (file_exists('import_pasos.php')) {
        $content = file_get_contents('import_pasos.php');
        if (strpos($content, 'FASE_0_MARKETING_DIGITAL') !== false && 
            strpos($content, 'FASE_5_ENTREGABLES_FINALES') !== false) {
            echo "<p>✓ Phase mapping includes phases 0-5</p>\n";
        } else {
            echo "<p>✗ Phase mapping may be incomplete</p>\n";
        }
    }
    
    // Test 4: Test obtenerOpcionesFases function
    echo "<h3>4. obtenerOpcionesFases() Function Test:</h3>\n";
    if (function_exists('obtenerOpcionesFases')) {
        $opciones = obtenerOpcionesFases();
        echo "<p>Function returned " . count($opciones) . " phases:</p>\n";
        echo "<ul>\n";
        foreach ($opciones as $opcion) {
            echo "<li>Fase {$opcion['numero_fase']}: {$opcion['nombre']}</li>\n";
        }
        echo "</ul>\n";
    } else {
        echo "<p>✗ obtenerOpcionesFases function not found</p>\n";
    }
    
    echo "<h3>Summary:</h3>\n";
    echo "<p>Total phases in database: " . count($fases) . "</p>\n";
    echo "<p>Expected: 6 phases (0-5)</p>\n";
    
    if (count($fases) == 6) {
        echo "<p style='color: green;'>✓ SUCCESS: 5-phase system is properly configured!</p>\n";
    } else {
        echo "<p style='color: red;'>✗ ERROR: Expected 6 phases, found " . count($fases) . "</p>\n";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>\n";
}
?>