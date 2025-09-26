<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Debug: Error en insertarRegistro</h1>";

// 1. Verificar conexión
echo "<h2>1. Verificación de Conexión</h2>";
try {
    $pdo = obtenerConexion();
    echo "✅ Conexión: OK<br>";
    
    // Verificar estructura de tabla auditorias
    $stmt = $pdo->query("PRAGMA table_info(auditorias)");
    $columnas = $stmt->fetchAll();
    echo "📋 Estructura de tabla auditorias:<br>";
    foreach ($columnas as $col) {
        echo "  - {$col['name']} ({$col['type']}) " . ($col['notnull'] ? "NOT NULL" : "NULL") . "<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 2. Probar inserción manual
echo "<h2>2. Prueba de Inserción Manual</h2>";
$datos = [
    'nombre' => 'Test Manual',
    'descripcion' => 'Descripción test',
    'url_sitio' => 'https://test.com',
    'cliente_id' => 1,
    'usuario_id' => 1,
    'estado' => 'pendiente',
    'fecha_inicio' => date('Y-m-d H:i:s'),
    'porcentaje_completado' => 0
];

try {
    $pdo = obtenerConexion();
    
    // Construir consulta SQL manualmente para debug
    $campos = array_keys($datos);
    $placeholders = array_fill(0, count($campos), '?');
    $sql = "INSERT INTO auditorias (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $placeholders) . ")";
    
    echo "📋 SQL generado: {$sql}<br>";
    echo "📋 Valores: " . json_encode(array_values($datos)) . "<br>";
    
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute(array_values($datos));
    
    if ($resultado) {
        $id = $pdo->lastInsertId();
        echo "✅ Inserción manual: OK - ID: {$id}<br>";
    } else {
        echo "❌ Inserción manual: FALLÓ<br>";
        $errorInfo = $stmt->errorInfo();
        echo "Error: " . print_r($errorInfo, true) . "<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error en inserción manual: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 3. Probar función insertarRegistro con debug
echo "<h2>3. Prueba de insertarRegistro con Debug</h2>";

// Modificar temporalmente la función para mostrar errores
function insertarRegistroDebug($tabla, $datos) {
    try {
        $pdo = obtenerConexion();
        
        $campos = array_keys($datos);
        $placeholders = array_fill(0, count($campos), '?');
        
        $sql = "INSERT INTO {$tabla} (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $placeholders) . ")";
        
        echo "📋 SQL de insertarRegistro: {$sql}<br>";
        echo "📋 Datos: " . json_encode($datos) . "<br>";
        
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute(array_values($datos));
        
        if ($resultado) {
            $id = $pdo->lastInsertId();
            echo "✅ insertarRegistro: OK - ID: {$id}<br>";
            return $id;
        } else {
            echo "❌ insertarRegistro: FALLÓ<br>";
            $errorInfo = $stmt->errorInfo();
            echo "Error PDO: " . print_r($errorInfo, true) . "<br>";
            return false;
        }
        
    } catch (Exception $e) {
        echo "❌ Excepción en insertarRegistro: " . $e->getMessage() . "<br>";
        return false;
    }
}

$datosTest = [
    'nombre' => 'Test insertarRegistro',
    'descripcion' => 'Descripción test función',
    'url_sitio' => 'https://testfuncion.com',
    'cliente_id' => 1,
    'usuario_id' => 1,
    'estado' => 'pendiente',
    'fecha_inicio' => date('Y-m-d H:i:s'),
    'porcentaje_completado' => 0
];

$resultado = insertarRegistroDebug('auditorias', $datosTest);

echo "<hr>";
echo "<h2>🔍 Resumen</h2>";
echo "Este debug muestra exactamente qué está pasando con la inserción en la base de datos.<br>";
?>