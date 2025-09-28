<?php
/**
 * TEST: ELIMINACIÓN CORREGIDA
 * ==========================
 */

require_once 'includes/init.php';

echo "<h1>✅ Test Eliminación - Versión Corregida</h1>\n";

try {
    $pdo = obtenerConexion();
    $sql = "SELECT id, titulo, estado FROM auditorias ORDER BY id DESC LIMIT 3";
    $stmt = $pdo->query($sql);
    $auditorias = $stmt->fetchAll();

    echo "<h2>📋 Estado Actual:</h2>\n";
    echo "<p><strong>Total de auditorías:</strong> " . count($auditorias) . "</p>\n";

    foreach ($auditorias as $auditoria) {
        echo "<p>ID: {$auditoria['id']} - {$auditoria['titulo']} ({$auditoria['estado']})</p>\n";
    }

    if (!empty($auditorias)) {
        $test_id = $auditorias[0]['id'];

        echo "<hr>";
        echo "<h2>🔧 Cambios Aplicados:</h2>\n";
        echo "<ul>";
        echo "<li>❌ <strong>Eliminado:</strong> Doble manejo POST en index.php (conflicto resuelto)</li>";
        echo "<li>✅ <strong>Mantenido:</strong> Lógica original en procesarEliminarAuditoria()</li>";
        echo "<li>✅ <strong>Corregida:</strong> Vista de confirmación como fragment</li>";
        echo "<li>✅ <strong>Mejorados:</strong> Cursores y feedback visual</li>";
        echo "</ul>";

        echo "<h2>🎯 Flujo Corregido:</h2>\n";
        echo "<ol>";
        echo "<li><strong>GET eliminar</strong> → manejarAuditorias() → procesarEliminarAuditoria() → Muestra confirmación</li>";
        echo "<li><strong>POST eliminar</strong> → manejarAuditorias() → procesarEliminarAuditoria() → confirmarEliminarAuditoria() → Eliminación + Redirect</li>";
        echo "</ol>";

        echo "<hr>";
        echo "<h2>🔗 URL de Prueba Final:</h2>\n";
        echo "<div style='background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
        echo "<p><strong>Eliminar Auditoría #{$test_id}:</strong></p>";
        echo "<a href='http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id={$test_id}' ";
        echo "target='_blank' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>";
        echo "🗑️ ELIMINAR AUDITORÍA #{$test_id}</a>";
        echo "</div>";

        echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>✅ Comportamiento Esperado:</h3>";
        echo "<ol>";
        echo "<li>Se abre la página de confirmación</li>";
        echo "<li>Botón 'Eliminar' tiene cursor not-allowed hasta activar checkbox</li>";
        echo "<li>Al confirmar: elimina de base de datos</li>";
        echo "<li>Redirige a lista de auditorías con mensaje de éxito</li>";
        echo "<li>La auditoría ya no aparece en la lista</li>";
        echo "</ol>";
        echo "</div>";

        echo "<hr>";
        echo "<h2>📊 Verificación Post-Eliminación:</h2>\n";
        echo "<p>Después de eliminar, <a href='test_delete_fixed.php'>recarga esta página</a> para verificar que la auditoría desapareció.</p>";
    }

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    a { color: #007bff; }
    a:hover { text-decoration: underline; }
</style>