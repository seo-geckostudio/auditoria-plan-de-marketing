<?php
// Debug específico para insertarRegistro
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Debug Específico: insertarRegistro</h1>";

try {
    $pdo = obtenerConexion();
    echo "<h2>✅ Conexión establecida</h2>";
    
    // Datos de prueba
    $datos = [
        'titulo' => 'Test Audit Debug',
        'descripcion' => 'Test Description Debug',
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
    
    // Probar insertarRegistro con debug
    echo "<h2>🔍 Probando insertarRegistro...</h2>";
    
    // Activar modo debug en PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $resultado = insertarRegistro('auditorias', $datos);
    
    if ($resultado) {
        echo "✅ insertarRegistro exitoso - ID: $resultado<br>";
        
        // Verificar que se insertó correctamente
        $stmt = $pdo->prepare("SELECT * FROM auditorias WHERE id = ?");
        $stmt->execute([$resultado]);
        $auditoria = $stmt->fetch();
        
        echo "<h3>📋 Datos insertados:</h3>";
        foreach ($auditoria as $key => $value) {
            echo "- $key: $value<br>";
        }
        
    } else {
        echo "❌ insertarRegistro falló<br>";
        
        // Intentar inserción manual para comparar
        echo "<h3>🔍 Probando inserción manual...</h3>";
        
        $sql = "INSERT INTO auditorias (titulo, descripcion, cliente_id, usuario_id, estado, fecha_inicio, porcentaje_completado) 
                VALUES (:titulo, :descripcion, :cliente_id, :usuario_id, :estado, :fecha_inicio, :porcentaje_completado)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($datos);
        
        $id_manual = $pdo->lastInsertId();
        echo "✅ Inserción manual exitosa - ID: $id_manual<br>";
    }
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Archivo: " . $e->getFile() . "</p>";
    echo "<p>Línea: " . $e->getLine() . "</p>";
}
?>