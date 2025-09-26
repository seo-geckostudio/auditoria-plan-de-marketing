<?php
require_once 'config/database.php';

echo "<h1>Creando tabla historial_cambios</h1>";

try {
    $pdo = obtenerConexion();
    
    // Verificar si la tabla ya existe
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='historial_cambios'");
    $tabla = $stmt->fetch();
    
    if ($tabla) {
        echo "✅ La tabla historial_cambios ya existe<br>";
    } else {
        // Crear la tabla
        $sql = "CREATE TABLE historial_cambios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            auditoria_id INTEGER NOT NULL,
            usuario_id INTEGER NOT NULL,
            tipo_cambio TEXT NOT NULL CHECK (tipo_cambio IN ('creacion', 'estado_auditoria', 'estado_paso', 'archivo_subido', 'comentario', 'asignacion')),
            descripcion TEXT NOT NULL,
            datos_anteriores TEXT NULL,
            datos_nuevos TEXT NULL,
            fecha_cambio TEXT DEFAULT (datetime('now')),
            FOREIGN KEY (auditoria_id) REFERENCES auditorias(id) ON DELETE CASCADE,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
        )";
        
        $pdo->exec($sql);
        echo "✅ Tabla historial_cambios creada exitosamente<br>";
    }
    
    // Verificar la estructura de la tabla
    $stmt = $pdo->query("PRAGMA table_info(historial_cambios)");
    $columnas = $stmt->fetchAll();
    
    echo "<h2>Estructura de la tabla historial_cambios:</h2>";
    echo "<ul>";
    foreach ($columnas as $col) {
        echo "<li>{$col['name']} ({$col['type']})</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?>