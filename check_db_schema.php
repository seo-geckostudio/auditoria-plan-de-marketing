<?php
/**
 * VERIFICAR ESQUEMA DE BASE DE DATOS
 * =================================
 */

require_once 'includes/init.php';

echo "<h1>🔍 Verificación de Esquema de Base de Datos</h1>\n";

try {
    $pdo = obtenerConexion();

    // Obtener todas las tablas
    $sql = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
    $stmt = $pdo->query($sql);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<h2>📋 Tablas en la Base de Datos:</h2>\n";
    foreach ($tables as $table) {
        echo "<h3>📄 Tabla: $table</h3>\n";

        // Obtener esquema de cada tabla
        $sql = "PRAGMA table_info($table)";
        $stmt = $pdo->query($sql);
        $columns = $stmt->fetchAll();

        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0; width: 100%;'>";
        echo "<tr style='background: #f8f9fa;'><th>Columna</th><th>Tipo</th><th>Not Null</th><th>Default</th><th>PK</th></tr>";

        foreach ($columns as $column) {
            echo "<tr>";
            echo "<td>{$column['name']}</td>";
            echo "<td>{$column['type']}</td>";
            echo "<td>" . ($column['notnull'] ? 'Sí' : 'No') . "</td>";
            echo "<td>" . ($column['dflt_value'] ?? 'NULL') . "</td>";
            echo "<td>" . ($column['pk'] ? 'Sí' : 'No') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<hr>";
    echo "<h2>❌ Problema Identificado:</h2>\n";
    echo "<p>El error ocurre en la línea que intenta eliminar de la tabla 'comentarios':</p>";
    echo "<pre style='background: #f8d7da; padding: 10px; border-radius: 5px;'>DELETE FROM comentarios WHERE auditoria_id = ?</pre>";

    // Verificar si existe la tabla comentarios
    if (in_array('comentarios', $tables)) {
        echo "<p>✅ La tabla 'comentarios' SÍ existe.</p>";
        echo "<p>❌ Pero probablemente no tiene la columna 'auditoria_id'.</p>";
    } else {
        echo "<p>❌ La tabla 'comentarios' NO existe en la base de datos.</p>";
    }

    // Verificar historial_cambios también
    if (in_array('historial_cambios', $tables)) {
        echo "<p>✅ La tabla 'historial_cambios' SÍ existe.</p>";
    } else {
        echo "<p>❌ La tabla 'historial_cambios' NO existe en la base de datos.</p>";
    }

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    table { font-size: 14px; }
    th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    th { background: #f8f9fa; }
</style>