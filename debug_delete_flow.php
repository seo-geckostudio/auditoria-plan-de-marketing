<?php
/**
 * DEBUG: FLUJO COMPLETO DE ELIMINACIÓN
 * ===================================
 */

require_once 'includes/init.php';

echo "<h1>🔍 Archivos Involucrados en la Eliminación</h1>\n";

echo "<h2>📁 Archivos del Sistema de Eliminación:</h2>\n";

$files_involved = [
    'index.php' => [
        'role' => 'Router principal',
        'lines' => '47-75 (procesamiento POST)',
        'function' => 'Maneja routing general, NO procesa eliminación directamente'
    ],
    'modules/auditorias.php' => [
        'role' => 'Lógica de eliminación',
        'lines' => '22-62 (manejarAuditorias), 481-504 (procesarEliminarAuditoria), 509-584 (confirmarEliminarAuditoria)',
        'function' => 'Contiene TODA la lógica de eliminación'
    ],
    'views/auditorias/confirmar_eliminar.php' => [
        'role' => 'Vista de confirmación',
        'lines' => '183-202 (formulario)',
        'function' => 'Formulario que envía POST con confirmar=1'
    ],
    'includes/init.php' => [
        'role' => 'Inicialización',
        'lines' => 'Todo el archivo',
        'function' => 'Configuración de sesiones y funciones básicas'
    ]
];

foreach ($files_involved as $file => $info) {
    echo "<div style='border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px;'>";
    echo "<h3>📄 $file</h3>";
    echo "<p><strong>Rol:</strong> {$info['role']}</p>";
    echo "<p><strong>Líneas relevantes:</strong> {$info['lines']}</p>";
    echo "<p><strong>Función:</strong> {$info['function']}</p>";
    echo "</div>";
}

echo "<h2>🔄 Flujo de Eliminación (Paso a Paso):</h2>\n";

echo "<ol>";
echo "<li><strong>GET</strong> <code>?modulo=auditorias&accion=eliminar&id=23</code>";
echo "<ul><li><code>index.php</code> → <code>manejarAuditorias()</code> → <code>procesarEliminarAuditoria()</code></li>";
echo "<li>Muestra vista: <code>views/auditorias/confirmar_eliminar.php</code></li></ul></li>";

echo "<li><strong>POST</strong> (cuando user confirma)";
echo "<ul><li><code>procesarEliminarAuditoria()</code> detecta POST + confirmar</li>";
echo "<li>Llama a <code>confirmarEliminarAuditoria()</code></li>";
echo "<li>Ejecuta eliminación en cascada</li>";
echo "<li>Redirect a lista con mensaje</li></ul></li>";
echo "</ol>";

echo "<h2>🎯 El Archivo CLAVE para la Eliminación:</h2>\n";
echo "<div style='background: #fff3cd; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>📄 modules/auditorias.php</h3>";
echo "<p><strong>Esta es donde TODA la lógica de eliminación sucede:</strong></p>";
echo "<ul>";
echo "<li><strong>Línea 497-500:</strong> Detecta POST con confirmación</li>";
echo "<li><strong>Línea 509-584:</strong> Función <code>confirmarEliminarAuditoria()</code> que ejecuta el DELETE</li>";
echo "<li><strong>Línea 518-568:</strong> Eliminación en cascada real</li>";
echo "<li><strong>Línea 564:</strong> Redirect final</li>";
echo "</ul>";
echo "</div>";

// Vamos a crear un test específico para auditoría 23
echo "<h2>🧪 Test Directo para Auditoría ID 23:</h2>\n";

try {
    $pdo = obtenerConexion();

    // Verificar que existe
    $sql = "SELECT id, titulo FROM auditorias WHERE id = 23";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $auditoria = $stmt->fetch();

    if ($auditoria) {
        echo "<p>✅ Auditoría ID 23 encontrada: <strong>{$auditoria['titulo']}</strong></p>";

        echo "<h3>🔗 Enlaces de Test:</h3>";
        echo "<p><a href='http://localhost:8000/index.php?modulo=auditorias&accion=eliminar&id=23' target='_blank' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🗑️ ELIMINAR ID 23</a></p>";

        // Contar registros dependientes
        $sql = "SELECT COUNT(*) FROM auditoria_pasos WHERE auditoria_id = 23";
        $pasos = $pdo->prepare($sql);
        $pasos->execute();
        $count_pasos = $pasos->fetchColumn();

        echo "<p><strong>Registros dependientes:</strong> $count_pasos pasos</p>";

    } else {
        echo "<p>❌ Auditoría ID 23 no encontrada</p>";
    }

} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<h2>📝 Código de Eliminación Exacto:</h2>\n";
echo "<p>La eliminación se ejecuta en <code>modules/auditorias.php</code>, función <code>confirmarEliminarAuditoria()</code>:</p>";
echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
echo htmlspecialchars('
// Línea 557-568 en modules/auditorias.php:
$sql = "DELETE FROM auditorias WHERE id = ?";
$stmt = $pdo->prepare($sql);
$resultado = $stmt->execute([$auditoria_id]);

if ($resultado && $stmt->rowCount() > 0) {
    $pdo->commit();
    mostrarNotificacionSegura(\'Auditoría eliminada correctamente\', \'success\');
    header(\'Location: ?modulo=auditorias&accion=listar&success=eliminado\');
    exit;
} else {
    throw new Exception(\'No se pudo eliminar la auditoría\');
}
');
echo "</pre>";

?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    h2 { color: #3498db; }
    h3 { color: #e74c3c; }
    code { background: #f8f9fa; padding: 2px 4px; border-radius: 3px; }
</style>