<?php
/**
 * TEST DIRECTO: DEBUG ELIMINACIÓN
 * ===============================
 */

require_once 'includes/init.php';

// Función de debug que escribe a archivo
function debug_log($message) {
    $log_file = __DIR__ . '/debug_delete.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
    echo "<p style='color: blue;'>DEBUG: $message</p>";
}

echo "<h1>🔍 Test Directo de Eliminación con Debug</h1>\n";

debug_log("=== Iniciando test de eliminación ===");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    debug_log("POST detectado");
    debug_log("POST data: " . print_r($_POST, true));
    debug_log("GET data: " . print_r($_GET, true));

    if (isset($_POST['confirmar']) && $_POST['confirmar'] === '1') {
        debug_log("Confirmación detectada");

        $auditoria_id = (int)($_POST['auditoria_id'] ?? 0);
        debug_log("ID de auditoría: $auditoria_id");

        if ($auditoria_id > 0) {
            try {
                debug_log("Intentando conexión a base de datos");
                $pdo = obtenerConexion();
                debug_log("Conexión exitosa");

                // Verificar que existe la auditoría
                $sql = "SELECT id, titulo FROM auditorias WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$auditoria_id]);
                $auditoria = $stmt->fetch();

                if ($auditoria) {
                    debug_log("Auditoría encontrada: " . $auditoria['titulo']);

                    // Iniciar transacción
                    $pdo->beginTransaction();
                    debug_log("Transacción iniciada");

                    // Eliminar paso a paso
                    $deleted_counts = [];

                    // 1. Datos de formularios
                    $sql = "DELETE FROM paso_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$auditoria_id]);
                    $deleted_counts['paso_datos'] = $stmt->rowCount();
                    debug_log("Eliminados datos formularios: " . $deleted_counts['paso_datos']);

                    // 2. Pasos de auditoría
                    $sql = "DELETE FROM auditoria_pasos WHERE auditoria_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$auditoria_id]);
                    $deleted_counts['auditoria_pasos'] = $stmt->rowCount();
                    debug_log("Eliminados pasos: " . $deleted_counts['auditoria_pasos']);

                    // 3. Auditoría principal
                    $sql = "DELETE FROM auditorias WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $resultado = $stmt->execute([$auditoria_id]);
                    $deleted_counts['auditorias'] = $stmt->rowCount();
                    debug_log("Eliminada auditoría: " . ($resultado ? 'SÍ' : 'NO') . " (filas: " . $deleted_counts['auditorias'] . ")");

                    if ($resultado && $deleted_counts['auditorias'] > 0) {
                        $pdo->commit();
                        debug_log("=== ELIMINACIÓN EXITOSA ===");

                        echo "<div style='background: #d4edda; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
                        echo "<h2>✅ Eliminación Exitosa</h2>";
                        echo "<p><strong>Auditoría eliminada:</strong> " . htmlspecialchars($auditoria['titulo']) . "</p>";
                        echo "<p><strong>Registros eliminados:</strong></p>";
                        echo "<ul>";
                        foreach ($deleted_counts as $table => $count) {
                            echo "<li>$table: $count</li>";
                        }
                        echo "</ul>";
                        echo "<p><a href='index.php?modulo=auditorias&accion=listar' class='btn btn-primary'>Volver a Lista de Auditorías</a></p>";
                        echo "</div>";

                    } else {
                        $pdo->rollback();
                        debug_log("ERROR: No se pudo eliminar la auditoría");
                        echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px;'>";
                        echo "<h3>❌ Error: No se pudo eliminar la auditoría</h3>";
                        echo "</div>";
                    }

                } else {
                    debug_log("ERROR: Auditoría no encontrada");
                    echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px;'>";
                    echo "<h3>❌ Error: Auditoría no encontrada</h3>";
                    echo "</div>";
                }

            } catch (Exception $e) {
                debug_log("EXCEPCIÓN: " . $e->getMessage());
                debug_log("Stack trace: " . $e->getTraceAsString());
                echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px;'>";
                echo "<h3>❌ Error de Sistema</h3>";
                echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
                echo "</div>";

                if (isset($pdo)) {
                    $pdo->rollback();
                    debug_log("Rollback ejecutado");
                }
            }

        } else {
            debug_log("ERROR: ID inválido");
            echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px;'>";
            echo "<h3>❌ Error: ID de auditoría inválido</h3>";
            echo "</div>";
        }

    } else {
        debug_log("ERROR: No se recibió confirmación válida");
        echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px;'>";
        echo "<h3>❌ Error: Confirmación no válida</h3>";
        echo "</div>";
    }

} else {
    debug_log("Mostrando formulario de test");

    // Verificar auditorías disponibles
    try {
        $pdo = obtenerConexion();
        $sql = "SELECT id, titulo, estado FROM auditorias ORDER BY id DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        $auditorias = $stmt->fetchAll();

        echo "<h2>📋 Auditorías Disponibles para Testing:</h2>";
        foreach ($auditorias as $auditoria) {
            echo "<p>ID: {$auditoria['id']} - {$auditoria['titulo']} ({$auditoria['estado']})</p>";
        }

        if (!empty($auditorias)) {
            $test_id = $auditorias[0]['id'];
            echo "<hr>";
            echo "<h2>🧪 Formulario de Test</h2>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='auditoria_id' value='$test_id'>";
            echo "<p><input type='checkbox' id='confirmar' required> <label for='confirmar'>Confirmar eliminación de auditoría ID $test_id</label></p>";
            echo "<button type='submit' name='confirmar' value='1' style='background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>🗑️ ELIMINAR</button>";
            echo "</form>";
        }

    } catch (Exception $e) {
        debug_log("ERROR al obtener auditorías: " . $e->getMessage());
    }
}

echo "<hr>";
echo "<h3>📄 Debug Log:</h3>";
$log_file = __DIR__ . '/debug_delete.log';
if (file_exists($log_file)) {
    echo "<pre style='background: #f8f9fa; padding: 10px; border-radius: 5px; max-height: 300px; overflow-y: auto;'>";
    echo htmlspecialchars(file_get_contents($log_file));
    echo "</pre>";
    echo "<p><a href='?clear_log=1'>🗑️ Limpiar Log</a></p>";

    if (isset($_GET['clear_log'])) {
        unlink($log_file);
        echo "<p style='color: green;'>✅ Log limpiado</p>";
    }
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; }
    .btn-primary { background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
</style>