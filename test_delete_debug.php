<?php
/**
 * DEBUG: PROCESO DE ELIMINACIÓN
 * ============================
 */

require_once 'includes/init.php';

echo "<h1>🔍 Debug Eliminación de Auditoría</h1>\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>📥 REQUEST POST RECIBIDO</h2>\n";
    echo "<pre>";
    echo "POST data:\n";
    print_r($_POST);
    echo "\nGET data:\n";
    print_r($_GET);
    echo "</pre>";

    $auditoria_id = (int)($_POST['auditoria_id'] ?? $_GET['id'] ?? 0);
    echo "<p><strong>ID extraído:</strong> $auditoria_id</p>\n";

    if (isset($_POST['confirmar'])) {
        echo "<p>✅ Confirmación detectada</p>\n";

        try {
            $pdo = obtenerConexion();

            // Verificar que la auditoría existe
            $sql = "SELECT id, titulo FROM auditorias WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$auditoria_id]);
            $auditoria = $stmt->fetch();

            if ($auditoria) {
                echo "<p>✅ Auditoría encontrada: {$auditoria['titulo']}</p>\n";

                // Simular eliminación paso a paso
                echo "<h3>🗑️ Proceso de Eliminación:</h3>\n";

                // 1. Contar registros dependientes
                $sql = "SELECT COUNT(*) FROM auditoria_pasos WHERE auditoria_id = ?";
                $count = $pdo->prepare($sql);
                $count->execute([$auditoria_id]);
                echo "<p>- Pasos encontrados: " . $count->fetchColumn() . "</p>\n";

                $sql = "SELECT COUNT(*) FROM paso_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
                $count = $pdo->prepare($sql);
                $count->execute([$auditoria_id]);
                echo "<p>- Datos de formularios: " . $count->fetchColumn() . "</p>\n";

                // Proceder con eliminación real
                $pdo->beginTransaction();

                echo "<p>🚀 <strong>EJECUTANDO ELIMINACIÓN REAL...</strong></p>\n";

                // 1. Eliminar datos de formularios
                $sql = "DELETE FROM paso_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
                $stmt = $pdo->prepare($sql);
                $resultado1 = $stmt->execute([$auditoria_id]);
                echo "<p>- Datos formularios eliminados: " . ($resultado1 ? "✅" : "❌") . " (filas: " . $stmt->rowCount() . ")</p>\n";

                // 2. Eliminar datos CSV
                $sql = "DELETE FROM csv_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
                $stmt = $pdo->prepare($sql);
                $resultado2 = $stmt->execute([$auditoria_id]);
                echo "<p>- Datos CSV eliminados: " . ($resultado2 ? "✅" : "❌") . " (filas: " . $stmt->rowCount() . ")</p>\n";

                // 3. Eliminar archivos
                $sql = "DELETE FROM archivos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
                $stmt = $pdo->prepare($sql);
                $resultado3 = $stmt->execute([$auditoria_id]);
                echo "<p>- Archivos eliminados: " . ($resultado3 ? "✅" : "❌") . " (filas: " . $stmt->rowCount() . ")</p>\n";

                // 4. Eliminar pasos
                $sql = "DELETE FROM auditoria_pasos WHERE auditoria_id = ?";
                $stmt = $pdo->prepare($sql);
                $resultado4 = $stmt->execute([$auditoria_id]);
                echo "<p>- Pasos eliminados: " . ($resultado4 ? "✅" : "❌") . " (filas: " . $stmt->rowCount() . ")</p>\n";

                // 5. Eliminar auditoría
                $sql = "DELETE FROM auditorias WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $resultado5 = $stmt->execute([$auditoria_id]);
                echo "<p>- Auditoría eliminada: " . ($resultado5 ? "✅" : "❌") . " (filas: " . $stmt->rowCount() . ")</p>\n";

                if ($resultado5 && $stmt->rowCount() > 0) {
                    $pdo->commit();
                    echo "<h3>🎉 ELIMINACIÓN COMPLETADA EXITOSAMENTE</h3>\n";
                    echo "<p><a href='index.php?modulo=auditorias&accion=listar' class='btn btn-success'>Volver a Lista de Auditorías</a></p>\n";
                } else {
                    $pdo->rollback();
                    echo "<h3>❌ ERROR: No se pudo eliminar la auditoría</h3>\n";
                }

            } else {
                echo "<p>❌ Auditoría no encontrada</p>\n";
            }

        } catch (Exception $e) {
            echo "<p>❌ Error: " . $e->getMessage() . "</p>\n";
        }

    } else {
        echo "<p>❌ No se recibió confirmación</p>\n";
    }

} else {
    echo "<h2>📝 Formulario de Test</h2>\n";
    echo "<p>Usa este formulario para testear la eliminación de la auditoría ID 24:</p>\n";

    echo '<form method="POST">';
    echo '<input type="hidden" name="auditoria_id" value="24">';
    echo '<p><input type="checkbox" id="test-confirm" required> <label for="test-confirm">Confirmar eliminación</label></p>';
    echo '<button type="submit" name="confirmar" value="1">🗑️ Eliminar Auditoría #24</button>';
    echo '</form>';
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
    pre { background: #f0f0f0; padding: 10px; border-radius: 5px; }
    .btn { padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    .btn-success { background: #28a745; }
</style>