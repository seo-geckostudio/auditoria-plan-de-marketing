<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/forms.php';

echo "<h1>Debug: Audit Creation Process</h1>";

// Simular datos POST
$_POST = [
    'accion' => 'crear_auditoria',
    'nombre' => 'Test Audit Debug',
    'descripcion' => 'Test Description',
    'url_principal' => 'https://test.com',
    'cliente_id' => '1',
    'usuario_id' => '1',
    'fecha_inicio' => date('Y-m-d'),
    'fases' => ['1', '2'],
    'csrf_token' => 'test'
];

// Simular token CSRF válido
$_SESSION['csrf_token'] = 'test';

echo "<h2>1. Testing procesarCrearAuditoria</h2>";
try {
    $resultado = procesarCrearAuditoria();
    echo "<pre>Resultado: " . json_encode($resultado, JSON_PRETTY_PRINT) . "</pre>";
    
    if ($resultado['success'] && isset($resultado['auditoria_id'])) {
        $auditoriaId = $resultado['auditoria_id'];
        echo "<p>✅ Auditoría creada con ID: {$auditoriaId}</p>";
        
        echo "<h2>2. Testing obtenerAuditoria</h2>";
        $auditoria = obtenerAuditoria($auditoriaId);
        if ($auditoria) {
            echo "<p>✅ Auditoría encontrada:</p>";
            echo "<pre>" . json_encode($auditoria, JSON_PRETTY_PRINT) . "</pre>";
        } else {
            echo "<p>❌ Auditoría NO encontrada después de crearla</p>";
        }
        
        echo "<h2>3. Testing redirect URL</h2>";
        $redirectUrl = "?modulo=auditorias&accion=ver&id={$auditoriaId}";
        echo "<p>URL de redirección: <a href='{$redirectUrl}'>{$redirectUrl}</a></p>";
        
    } else {
        echo "<p>❌ Error en la creación de auditoría</p>";
        if (isset($resultado['errores'])) {
            echo "<pre>Errores: " . json_encode($resultado['errores'], JSON_PRETTY_PRINT) . "</pre>";
        }
    }
    
} catch (Exception $e) {
    echo "<p>❌ Excepción: " . $e->getMessage() . "</p>";
    echo "<p>Archivo: " . $e->getFile() . "</p>";
    echo "<p>Línea: " . $e->getLine() . "</p>";
}
?>