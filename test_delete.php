<?php
/**
 * TEST: FUNCIONALIDAD DE ELIMINACIÓN
 * ==================================
 */

require_once 'includes/init.php';

echo "<h1>🗑️ Test Funcionalidad de Eliminación</h1>\n";

try {
    $pdo = obtenerConexion();

    // Verificar auditorías disponibles
    $sql = "SELECT id, titulo, estado FROM auditorias ORDER BY id DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $auditorias = $stmt->fetchAll();

    echo "<h3>📋 Auditorías Disponibles para Testing:</h3>\n";

    foreach ($auditorias as $auditoria) {
        echo "<p>";
        echo "ID: {$auditoria['id']} - {$auditoria['titulo']} ({$auditoria['estado']}) ";
        echo "<a href='index.php?modulo=auditorias&accion=eliminar&id={$auditoria['id']}' style='color: red;'>";
        echo "[🗑️ Eliminar]</a>";
        echo "</p>\n";
    }

    echo "<hr>";
    echo "<h3>🔗 URLs de Prueba Directas:</h3>\n";

    if (!empty($auditorias)) {
        $primeraId = $auditorias[0]['id'];
        echo "<p><strong>Eliminar auditoría #{$primeraId}:</strong><br>";
        echo "<a href='index.php?modulo=auditorias&accion=eliminar&id={$primeraId}' target='_blank'>";
        echo "http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id={$primeraId}</a></p>\n";
    }

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    a { text-decoration: none; }
    a:hover { text-decoration: underline; }
</style>