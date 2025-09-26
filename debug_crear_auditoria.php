<?php
// Debug específico para crearAuditoria
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Debug Específico: crearAuditoria</h1>";

try {
    $pdo = obtenerConexion();
    echo "<h2>✅ Conexión establecida</h2>";
    
    // Datos de prueba
    $datos = [
        'titulo' => 'Test Audit crearAuditoria',
        'descripcion' => 'Test Description crearAuditoria',
        'cliente_id' => 1,
        'usuario_id' => 1,
        'estado' => 'planificada',
        'fecha_inicio' => '2025-09-26',
        'porcentaje_completado' => 0
    ];
    
    echo "<h2>📋 Datos de prueba:</h2>";
    foreach ($datos as $key => $value) {
        echo "- $key: $value<br>";
    }
    
    echo "<hr>";
    
    // Paso 1: Probar insertarRegistro directamente
    echo "<h2>1. Probar insertarRegistro directamente</h2>";
    $auditoriaId = insertarRegistro('auditorias', $datos);
    
    if ($auditoriaId) {
        echo "✅ insertarRegistro: OK - ID: {$auditoriaId}<br>";
    } else {
        echo "❌ insertarRegistro: FALLÓ<br>";
        echo "Terminando debug aquí porque insertarRegistro no funciona.<br>";
        exit;
    }
    
    echo "<hr>";
    
    // Paso 2: Probar registrarCambio con el ID obtenido
    echo "<h2>2. Probar registrarCambio con ID: {$auditoriaId}</h2>";
    try {
        registrarCambio($auditoriaId, $datos['usuario_id'], 'creacion', 'Auditoría creada');
        echo "✅ registrarCambio: OK<br>";
    } catch (Exception $e) {
        echo "❌ Error en registrarCambio: " . $e->getMessage() . "<br>";
        echo "Archivo: " . $e->getFile() . "<br>";
        echo "Línea: " . $e->getLine() . "<br>";
    }
    
    echo "<hr>";
    
    // Paso 3: Simular crearAuditoria paso a paso
    echo "<h2>3. Simular crearAuditoria paso a paso</h2>";
    
    $datos2 = [
        'titulo' => 'Test Audit crearAuditoria 2',
        'descripcion' => 'Test Description crearAuditoria 2',
        'cliente_id' => 1,
        'usuario_id' => 1,
        'estado' => 'planificada',
        'fecha_inicio' => '2025-09-26',
        'porcentaje_completado' => 0
    ];
    
    echo "📋 Paso 3.1: Llamar insertarRegistro<br>";
    $auditoriaId2 = insertarRegistro('auditorias', $datos2);
    
    if ($auditoriaId2) {
        echo "✅ insertarRegistro (paso 3.1): OK - ID: {$auditoriaId2}<br>";
        
        echo "📋 Paso 3.2: Llamar registrarCambio<br>";
        try {
            registrarCambio($auditoriaId2, $datos2['usuario_id'], 'creacion', 'Auditoría creada');
            echo "✅ registrarCambio (paso 3.2): OK<br>";
            echo "✅ Simulación de crearAuditoria: EXITOSA<br>";
        } catch (Exception $e) {
            echo "❌ Error en registrarCambio (paso 3.2): " . $e->getMessage() . "<br>";
        }
    } else {
        echo "❌ insertarRegistro (paso 3.1): FALLÓ<br>";
    }
    
    echo "<hr>";
    
    // Paso 4: Probar la función crearAuditoria real
    echo "<h2>4. Probar función crearAuditoria real</h2>";
    
    $datos3 = [
        'titulo' => 'Test Audit crearAuditoria 3',
        'descripcion' => 'Test Description crearAuditoria 3',
        'cliente_id' => 1,
        'usuario_id' => 1,
        'estado' => 'planificada',
        'fecha_inicio' => '2025-09-26',
        'porcentaje_completado' => 0
    ];
    
    echo "📋 Datos para crearAuditoria: " . json_encode($datos3) . "<br>";
    
    try {
        $auditoriaId3 = crearAuditoria($datos3);
        if ($auditoriaId3) {
            echo "✅ crearAuditoria: OK - ID: {$auditoriaId3}<br>";
        } else {
            echo "❌ crearAuditoria: FALLÓ (retornó false)<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error en crearAuditoria: " . $e->getMessage() . "<br>";
        echo "Archivo: " . $e->getFile() . "<br>";
        echo "Línea: " . $e->getLine() . "<br>";
        echo "Stack trace: " . $e->getTraceAsString() . "<br>";
    }
    
    echo "<hr>";
    
    // Paso 5: Verificar estado final de la base de datos
    echo "<h2>5. Estado final de la base de datos</h2>";
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM auditorias");
    $stmt->execute();
    $count = $stmt->fetch();
    echo "📊 Total de auditorías en la base de datos: {$count['total']}<br>";
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM historial_cambios");
    $stmt->execute();
    $count = $stmt->fetch();
    echo "📊 Total de cambios en historial: {$count['total']}<br>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error general:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Archivo: " . $e->getFile() . "</p>";
    echo "<p>Línea: " . $e->getLine() . "</p>";
    echo "<p>Stack trace: " . $e->getTraceAsString() . "</p>";
}
?>