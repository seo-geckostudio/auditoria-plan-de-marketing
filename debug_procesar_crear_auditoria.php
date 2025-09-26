<?php
// Debug específico para procesarCrearAuditoria
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/forms.php';

echo "<h1>Debug Específico: procesarCrearAuditoria</h1>";

try {
    $pdo = obtenerConexion();
    echo "<h2>✅ Conexión establecida</h2>";
    
    // Simular datos POST completos
    $_POST = [
        'nombre' => 'Test Audit procesarCrearAuditoria',
        'descripcion' => 'Test Description procesarCrearAuditoria',
        'cliente_id' => '1',
        'usuario_id' => '1',
        'fecha_inicio' => '2025-09-26',
        'fecha_estimada_fin' => '2025-10-26',
        'fases' => ['planificacion', 'ejecucion']
    ];
    
    echo "<h2>📋 Datos POST simulados:</h2>";
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            echo "- $key: " . implode(', ', $value) . "<br>";
        } else {
            echo "- $key: $value<br>";
        }
    }
    
    echo "<hr>";
    
    // Paso 1: Probar validación
    echo "<h2>1. Probar validación de datos</h2>";
    $errores = validarDatosAuditoria($_POST);
    
    if (empty($errores)) {
        echo "✅ Validación: OK - Sin errores<br>";
    } else {
        echo "❌ Validación: FALLÓ<br>";
        echo "Errores encontrados:<br>";
        foreach ($errores as $campo => $error) {
            echo "  - $campo: $error<br>";
        }
        echo "Terminando debug aquí porque la validación falló.<br>";
        exit;
    }
    
    echo "<hr>";
    
    // Paso 2: Probar preparación de datos
    echo "<h2>2. Probar preparación de datos</h2>";
    $datos = [
        'cliente_id' => (int)$_POST['cliente_id'],
        'usuario_id' => (int)$_POST['usuario_id'],
        'titulo' => sanitizar($_POST['nombre']),
        'descripcion' => sanitizar($_POST['descripcion']),
        'fecha_inicio' => $_POST['fecha_inicio'],
        'fecha_fin' => $_POST['fecha_estimada_fin'] ?? null,
        'estado' => 'planificada',
        'porcentaje_completado' => 0.00
    ];
    
    echo "✅ Datos preparados:<br>";
    foreach ($datos as $key => $value) {
        echo "  - $key: $value<br>";
    }
    
    echo "<hr>";
    
    // Paso 3: Probar crearAuditoria con datos preparados
    echo "<h2>3. Probar crearAuditoria con datos preparados</h2>";
    try {
        $auditoriaId = crearAuditoria($datos);
        if ($auditoriaId) {
            echo "✅ crearAuditoria: OK - ID: {$auditoriaId}<br>";
        } else {
            echo "❌ crearAuditoria: FALLÓ (retornó false)<br>";
            echo "Terminando debug aquí porque crearAuditoria falló.<br>";
            exit;
        }
    } catch (Exception $e) {
        echo "❌ Error en crearAuditoria: " . $e->getMessage() . "<br>";
        echo "Terminando debug aquí porque crearAuditoria lanzó excepción.<br>";
        exit;
    }
    
    echo "<hr>";
    
    // Paso 4: Probar procesarCrearAuditoria completo
    echo "<h2>4. Probar procesarCrearAuditoria completo</h2>";
    
    // Resetear $_POST para la prueba completa
    $_POST = [
        'nombre' => 'Test Audit procesarCrearAuditoria COMPLETO',
        'descripcion' => 'Test Description procesarCrearAuditoria COMPLETO',
        'cliente_id' => '1',
        'usuario_id' => '1',
        'fecha_inicio' => '2025-09-26',
        'fecha_estimada_fin' => '2025-10-26',
        'fases' => ['planificacion', 'ejecucion']
    ];
    
    try {
        $resultado = procesarCrearAuditoria();
        
        echo "📋 Resultado de procesarCrearAuditoria:<br>";
        echo "  - success: " . ($resultado['success'] ? 'true' : 'false') . "<br>";
        echo "  - message: " . $resultado['message'] . "<br>";
        
        if (isset($resultado['auditoria_id'])) {
            echo "  - auditoria_id: " . $resultado['auditoria_id'] . "<br>";
        }
        
        if (isset($resultado['errores'])) {
            echo "  - errores: " . json_encode($resultado['errores']) . "<br>";
        }
        
        if ($resultado['success']) {
            echo "✅ procesarCrearAuditoria: EXITOSO<br>";
        } else {
            echo "❌ procesarCrearAuditoria: FALLÓ<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Error en procesarCrearAuditoria: " . $e->getMessage() . "<br>";
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
    echo "❌ Error general: " . $e->getMessage() . "<br>";
    echo "Archivo: " . $e->getFile() . "<br>";
    echo "Línea: " . $e->getLine() . "<br>";
}
?>