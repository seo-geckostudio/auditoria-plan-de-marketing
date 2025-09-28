<?php
/**
 * VISOR DE LOGS DE ELIMINACIÓN
 * ============================
 */

require_once 'includes/init.php';

$log_file = __DIR__ . '/delete_debug.log';

echo "<h1>📋 Visor de Logs de Eliminación</h1>\n";

// Limpiar logs si se solicita
if (isset($_GET['clear'])) {
    if (file_exists($log_file)) {
        unlink($log_file);
        echo "<p style='color: green;'>✅ Log limpiado</p>";
    }
}

echo "<div style='background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h2>🎯 Instrucciones:</h2>";
echo "<ol>";
echo "<li>Haz clic en <strong>'ELIMINAR ID 23'</strong> abajo</li>";
echo "<li>Completa el proceso de eliminación en la web</li>";
echo "<li>Vuelve aquí y <strong>recarga esta página</strong> para ver los logs</li>";
echo "<li>Los logs te mostrarán exactamente dónde se produce el problema</li>";
echo "</ol>";
echo "</div>";

// Mostrar auditoría 23 si existe
try {
    $pdo = obtenerConexion();
    $sql = "SELECT id, titulo FROM auditorias WHERE id = 23";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $auditoria = $stmt->fetch();

    if ($auditoria) {
        echo "<div style='background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>🎯 Auditoría de Prueba:</h3>";
        echo "<p><strong>ID:</strong> {$auditoria['id']}</p>";
        echo "<p><strong>Título:</strong> {$auditoria['titulo']}</p>";
        echo "<p><a href='http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id=23' target='_blank' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🗑️ ELIMINAR ID 23</a></p>";
        echo "</div>";
    } else {
        echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>✅ Auditoría ID 23 ya fue eliminada</h3>";
        echo "<p>Busquemos otra auditoría para probar...</p>";

        // Buscar otra auditoría disponible
        $sql = "SELECT id, titulo FROM auditorias ORDER BY id DESC LIMIT 3";
        $stmt = $pdo->query($sql);
        $auditorias = $stmt->fetchAll();

        if (!empty($auditorias)) {
            $test_id = $auditorias[0]['id'];
            echo "<p><strong>Usar auditoría ID $test_id:</strong> {$auditorias[0]['titulo']}</p>";
            echo "<p><a href='http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id=$test_id' target='_blank' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🗑️ ELIMINAR ID $test_id</a></p>";
        }
        echo "</div>";
    }

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error al verificar auditorías: " . $e->getMessage() . "</div>";
}

echo "<hr>";

// Mostrar logs
if (file_exists($log_file)) {
    $logs = file_get_contents($log_file);
    if (!empty($logs)) {
        echo "<h2>📄 Logs de Eliminación:</h2>";
        echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 500px; overflow-y: auto; font-family: monospace;'>";
        echo htmlspecialchars($logs);
        echo "</pre>";

        echo "<p><a href='?clear=1' style='background: #6c757d; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px;'>🗑️ Limpiar Logs</a></p>";
    } else {
        echo "<p>📝 Log está vacío. Ejecuta una eliminación para ver los logs.</p>";
    }
} else {
    echo "<p>📝 No hay archivo de log. Se creará automáticamente cuando ejecutes una eliminación.</p>";
}

echo "<hr>";
echo "<h2>🔄 Opciones:</h2>";
echo "<ul>";
echo "<li><a href='view_delete_logs.php'>🔄 Recargar esta página</a></li>";
echo "<li><a href='index.php?modulo=auditorias&accion=listar'>📋 Ver lista de auditorías</a></li>";
echo "<li><a href='?clear=1'>🗑️ Limpiar logs</a></li>";
echo "</ul>";

?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    h2 { color: #3498db; }
    a { text-decoration: none; }
    a:hover { opacity: 0.8; }
</style>