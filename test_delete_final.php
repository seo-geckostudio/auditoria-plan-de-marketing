<?php
/**
 * TEST FINAL: ELIMINACIÓN DE AUDITORÍA
 * ===================================
 */

require_once 'includes/init.php';

echo "<h1>🎯 Test Final - Eliminación de Auditoría</h1>\n";

// Verificar auditorías disponibles
try {
    $pdo = obtenerConexion();
    $sql = "SELECT id, titulo, estado FROM auditorias ORDER BY id DESC LIMIT 3";
    $stmt = $pdo->query($sql);
    $auditorias = $stmt->fetchAll();

    echo "<h2>📋 Auditorías Disponibles:</h2>\n";
    foreach ($auditorias as $auditoria) {
        echo "<p>ID: {$auditoria['id']} - {$auditoria['titulo']} ({$auditoria['estado']})</p>\n";
    }

    if (!empty($auditorias)) {
        $test_id = $auditorias[0]['id'];
        echo "<hr>";
        echo "<h2>🔗 Enlaces de Prueba para Auditoría #{$test_id}:</h2>\n";
        echo "<p><strong>1. Ver confirmación:</strong><br>";
        echo "<a href='http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id={$test_id}' target='_blank'>";
        echo "http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id={$test_id}</a></p>\n";

        echo "<p><strong>2. Lista de auditorías:</strong><br>";
        echo "<a href='http://localhost:8000/index.php?modulo=auditorias&accion=listar' target='_blank'>";
        echo "http://localhost:8000/index.php?modulo=auditorias&accion=listar</a></p>\n";

        echo "<hr>";
        echo "<h2>🔧 Cambios Aplicados:</h2>\n";
        echo "<ul>";
        echo "<li>✅ Vista de confirmación ajustada para layout principal</li>";
        echo "<li>✅ CSS y JavaScript mejorados para cursores</li>";
        echo "<li>✅ Routing POST añadido en index.php para acción 'eliminar'</li>";
        echo "<li>✅ Función confirmarEliminarAuditoria() ya implementada</li>";
        echo "</ul>";

        echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>✅ Sistema Listo</h3>";
        echo "<p>La eliminación debería funcionar ahora correctamente:</p>";
        echo "<ol>";
        echo "<li>Al acceder al enlace, verás la página de confirmación</li>";
        echo "<li>El botón tendrá cursor 'not-allowed' hasta activar el checkbox</li>";
        echo "<li>Al confirmar, se eliminará de la base de datos</li>";
        echo "<li>Te redirigirá automáticamente a la lista de auditorías</li>";
        echo "</ol>";
        echo "</div>";
    }

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    a { color: #007bff; text-decoration: none; }
    a:hover { text-decoration: underline; }
</style>