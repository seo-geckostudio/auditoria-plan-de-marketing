<?php
// Debug específico para historial_cambios y registrarCambio
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Debug: historial_cambios y registrarCambio</h1>";

try {
    $pdo = obtenerConexion();
    echo "<h2>✅ Conexión establecida</h2>";
    
    // 1. Verificar estructura de historial_cambios
    echo "<h2>1. Estructura de historial_cambios</h2>";
    $stmt = $pdo->prepare("PRAGMA table_info(historial_cambios)");
    $stmt->execute();
    $columnas = $stmt->fetchAll();
    
    echo "📋 Columnas de historial_cambios:<br>";
    foreach ($columnas as $columna) {
        echo "- {$columna['name']} ({$columna['type']}) - Null: {$columna['notnull']}<br>";
    }
    
    echo "<hr>";
    
    // 2. Verificar si la tabla existe y tiene datos
    echo "<h2>2. Verificar tabla historial_cambios</h2>";
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM historial_cambios");
    $stmt->execute();
    $count = $stmt->fetch();
    echo "📊 Total de registros en historial_cambios: {$count['total']}<br>";
    
    echo "<hr>";
    
    // 3. Probar inserción manual en historial_cambios
    echo "<h2>3. Inserción manual en historial_cambios</h2>";
    $datosHistorial = [
        'auditoria_id' => 1,
        'usuario_id' => 1,
        'tipo_cambio' => 'creacion',
        'descripcion' => 'Test manual de historial'
    ];
    
    $campos = array_keys($datosHistorial);
    $placeholders = array_fill(0, count($campos), '?');
    $sql = "INSERT INTO historial_cambios (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $placeholders) . ")";
    
    echo "📋 SQL: {$sql}<br>";
    echo "📋 Datos: " . json_encode($datosHistorial) . "<br>";
    
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute(array_values($datosHistorial));
    
    if ($resultado) {
        $id = $pdo->lastInsertId();
        echo "✅ Inserción manual en historial_cambios: OK - ID: {$id}<br>";
    } else {
        echo "❌ Inserción manual en historial_cambios: FALLÓ<br>";
        $errorInfo = $stmt->errorInfo();
        echo "Error: " . print_r($errorInfo, true) . "<br>";
    }
    
    echo "<hr>";
    
    // 4. Probar función registrarCambio
    echo "<h2>4. Función registrarCambio</h2>";
    try {
        registrarCambio(1, 1, 'creacion', 'Test de registrarCambio');
        echo "✅ registrarCambio: OK<br>";
        
        // Verificar que se insertó
        $stmt = $pdo->prepare("SELECT * FROM historial_cambios WHERE descripcion = 'Test de registrarCambio' ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $cambio = $stmt->fetch();
        
        if ($cambio) {
            echo "✅ Verificación: Cambio registrado correctamente<br>";
            echo "📋 Datos del cambio: " . json_encode($cambio) . "<br>";
        } else {
            echo "❌ Verificación: No se encontró el cambio registrado<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Error en registrarCambio: " . $e->getMessage() . "<br>";
    }
    
    echo "<hr>";
    
    // 5. Probar crearAuditoria con debug
    echo "<h2>5. Función crearAuditoria con debug</h2>";
    $datosAuditoria = [
        'titulo' => 'Test Audit para Debug Historial',
        'descripcion' => 'Test Description',
        'cliente_id' => 1,
        'usuario_id' => 1,
        'estado' => 'planificada',
        'fecha_inicio' => '2025-09-26',
        'porcentaje_completado' => 0
    ];
    
    echo "📋 Datos de auditoría: " . json_encode($datosAuditoria) . "<br>";
    
    try {
        $auditoriaId = crearAuditoria($datosAuditoria);
        if ($auditoriaId) {
            echo "✅ crearAuditoria: OK - ID: {$auditoriaId}<br>";
        } else {
            echo "❌ crearAuditoria: FALLÓ<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error en crearAuditoria: " . $e->getMessage() . "<br>";
        echo "Archivo: " . $e->getFile() . "<br>";
        echo "Línea: " . $e->getLine() . "<br>";
    }
    
} catch (Exception $e) {
    echo "<h2>❌ Error general:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Archivo: " . $e->getFile() . "</p>";
    echo "<p>Línea: " . $e->getLine() . "</p>";
}
?>