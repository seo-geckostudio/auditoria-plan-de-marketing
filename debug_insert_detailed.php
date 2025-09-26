<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Debug Detallado: insertarRegistro</h1>";

// 1. Verificar conexión
echo "<h2>1. Verificación de Conexión</h2>";
try {
    $pdo = obtenerConexion();
    echo "✅ Conexión: OK<br>";
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "<br>";
    exit;
}

// 2. Verificar estructura de tabla auditorias
echo "<h2>2. Estructura de Tabla auditorias</h2>";
try {
    $stmt = $pdo->query("PRAGMA table_info(auditorias)");
    $columnas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "📋 Columnas disponibles:<br>";
    foreach ($columnas as $columna) {
        echo "  - {$columna['name']} ({$columna['type']}) " . 
             ($columna['notnull'] ? "NOT NULL" : "NULL") . 
             ($columna['dflt_value'] ? " DEFAULT {$columna['dflt_value']}" : "") . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Error obteniendo estructura: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 3. Datos de prueba
echo "<h2>3. Datos de Prueba</h2>";
// Datos de prueba
$datos = [
    'titulo' => 'Test Audit',
    'descripcion' => 'Test Description',
    'cliente_id' => 1,
    'usuario_id' => 1,
    'estado' => 'planificada',
    'fecha_inicio' => '2025-09-26',
    'porcentaje_completado' => 0
];

echo "📋 Datos a insertar:<br>";
foreach ($datos as $campo => $valor) {
    echo "  - {$campo}: {$valor}<br>";
}

echo "<hr>";

// 4. Probar inserción manual con PDO
echo "<h2>4. Inserción Manual con PDO</h2>";
try {
    $campos = array_keys($datos);
    $placeholders = ':' . implode(', :', $campos);
    $sql = "INSERT INTO auditorias (" . implode(', ', $campos) . ") VALUES ({$placeholders})";
    
    echo "📋 SQL generado: {$sql}<br>";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    foreach ($datos as $campo => $valor) {
        $stmt->bindValue(":{$campo}", $valor);
        echo "  - Binding :{$campo} = {$valor}<br>";
    }
    
    $resultado = $stmt->execute();
    
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

// 5. Probar función insertarRegistro con debug
echo "<h2>5. Función insertarRegistro con Debug</h2>";

// Vamos a copiar la lógica de insertarRegistro aquí para debuggear
try {
    $tabla = 'auditorias';
    $campos = array_keys($datos);
    $placeholders = ':' . implode(', :', $campos);
    $sql = "INSERT INTO {$tabla} (" . implode(', ', $campos) . ") VALUES ({$placeholders})";
    
    echo "📋 SQL de insertarRegistro: {$sql}<br>";
    
    $stmt = $pdo->prepare($sql);
    
    if (!$stmt) {
        echo "❌ Error preparando statement<br>";
        $errorInfo = $pdo->errorInfo();
        echo "Error PDO: " . print_r($errorInfo, true) . "<br>";
    } else {
        echo "✅ Statement preparado correctamente<br>";
        
        // Bind values
        foreach ($datos as $campo => $valor) {
            $stmt->bindValue(":{$campo}", $valor);
        }
        
        $resultado = $stmt->execute();
        
        if ($resultado) {
            $id = $pdo->lastInsertId();
            echo "✅ insertarRegistro simulado: OK - ID: {$id}<br>";
        } else {
            echo "❌ insertarRegistro simulado: FALLÓ<br>";
            $errorInfo = $stmt->errorInfo();
            echo "Error Statement: " . print_r($errorInfo, true) . "<br>";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error en insertarRegistro simulado: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 6. Probar la función real insertarRegistro
echo "<h2>6. Función Real insertarRegistro</h2>";
try {
    $id = insertarRegistro('auditorias', $datos);
    if ($id) {
        echo "✅ insertarRegistro real: OK - ID: {$id}<br>";
    } else {
        echo "❌ insertarRegistro real: FALLÓ<br>";
    }
} catch (Exception $e) {
    echo "❌ Error en insertarRegistro real: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>🔍 Resumen</h2>";
echo "Este debug detallado debe mostrar exactamente dónde está fallando la inserción.<br>";
?>