<?php
// Verificar la estructura real de la tabla auditorias
require_once 'config/database.php';

try {
    $pdo = obtenerConexion();
    echo "<h1>Verificación de Tabla Auditorias</h1>";
    
    // Verificar si la tabla existe
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='auditorias'");
    $exists = $stmt->fetch();
    
    if ($exists) {
        echo "<h2>✅ Tabla 'auditorias' existe</h2>";
        
        // Obtener estructura de la tabla
        $stmt = $pdo->query("PRAGMA table_info(auditorias)");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Columnas de la tabla:</h3>";
        echo "<ul>";
        foreach ($columns as $column) {
            echo "<li><strong>" . $column['name'] . "</strong> (" . $column['type'] . ")";
            if ($column['notnull']) echo " NOT NULL";
            if ($column['dflt_value']) echo " DEFAULT " . $column['dflt_value'];
            echo "</li>";
        }
        echo "</ul>";
        
        // Verificar si hay datos
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM auditorias");
        $count = $stmt->fetch();
        echo "<p>Registros en la tabla: " . $count['count'] . "</p>";
        
    } else {
        echo "<h2>❌ Tabla 'auditorias' NO existe</h2>";
        
        // Mostrar todas las tablas que existen
        $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Tablas existentes:</h3>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . $table['name'] . "</li>";
        }
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>