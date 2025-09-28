<?php
/**
 * EJECUTAR ELIMINACIÓN DIRECTA - TEST
 * ==================================
 */

require_once 'includes/init.php';

echo "<h1>🔍 Ejecutando Eliminación Directa - ID 24</h1>\n";

$auditoria_id = 24;

try {
    $pdo = obtenerConexion();

    // Verificar que existe la auditoría antes de eliminar
    $sql = "SELECT id, titulo FROM auditorias WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$auditoria_id]);
    $auditoria = $stmt->fetch();

    if (!$auditoria) {
        echo "<p>❌ La auditoría ID $auditoria_id no existe</p>";
        exit;
    }

    echo "<p>✅ Auditoría encontrada: {$auditoria['titulo']}</p>\n";

    // Verificar registros dependientes ANTES de eliminar
    echo "<h2>📊 Registros Dependientes (ANTES):</h2>\n";

    $tables_to_check = [
        'auditoria_pasos' => "SELECT COUNT(*) FROM auditoria_pasos WHERE auditoria_id = ?",
        'paso_datos' => "SELECT COUNT(*) FROM paso_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)",
        'csv_datos' => "SELECT COUNT(*) FROM csv_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)",
        'archivos' => "SELECT COUNT(*) FROM archivos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)"
    ];

    $before_counts = [];
    foreach ($tables_to_check as $table => $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute([$auditoria_id]);
        $count = $stmt->fetchColumn();
        $before_counts[$table] = $count;
        echo "<p>- $table: $count registros</p>\n";
    }

    // Ahora ejecutar la eliminación paso a paso
    echo "<h2>🗑️ Ejecutando Eliminación:</h2>\n";

    $pdo->beginTransaction();
    echo "<p>✅ Transacción iniciada</p>\n";

    $deleted_counts = [];

    // 1. Eliminar datos de formularios
    $sql = "DELETE FROM paso_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
    $stmt = $pdo->prepare($sql);
    $resultado1 = $stmt->execute([$auditoria_id]);
    $deleted_counts['paso_datos'] = $stmt->rowCount();
    echo "<p>1. paso_datos: " . ($resultado1 ? "✅" : "❌") . " (eliminados: {$deleted_counts['paso_datos']})</p>\n";

    // 2. Eliminar datos CSV
    $sql = "DELETE FROM csv_datos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
    $stmt = $pdo->prepare($sql);
    $resultado2 = $stmt->execute([$auditoria_id]);
    $deleted_counts['csv_datos'] = $stmt->rowCount();
    echo "<p>2. csv_datos: " . ($resultado2 ? "✅" : "❌") . " (eliminados: {$deleted_counts['csv_datos']})</p>\n";

    // 3. Eliminar archivos
    $sql = "DELETE FROM archivos WHERE auditoria_paso_id IN (SELECT id FROM auditoria_pasos WHERE auditoria_id = ?)";
    $stmt = $pdo->prepare($sql);
    $resultado3 = $stmt->execute([$auditoria_id]);
    $deleted_counts['archivos'] = $stmt->rowCount();
    echo "<p>3. archivos: " . ($resultado3 ? "✅" : "❌") . " (eliminados: {$deleted_counts['archivos']})</p>\n";

    // 4. Eliminar comentarios (si existe la tabla)
    try {
        $sql = "DELETE FROM comentarios WHERE auditoria_id = ?";
        $stmt = $pdo->prepare($sql);
        $resultado4 = $stmt->execute([$auditoria_id]);
        $deleted_counts['comentarios'] = $stmt->rowCount();
        echo "<p>4. comentarios: " . ($resultado4 ? "✅" : "❌") . " (eliminados: {$deleted_counts['comentarios']})</p>\n";
    } catch (Exception $e) {
        echo "<p>4. comentarios: ⚠️ Tabla no existe - " . $e->getMessage() . "</p>\n";
    }

    // 5. Eliminar historial (si existe la tabla)
    try {
        $sql = "DELETE FROM historial_cambios WHERE auditoria_id = ?";
        $stmt = $pdo->prepare($sql);
        $resultado5 = $stmt->execute([$auditoria_id]);
        $deleted_counts['historial_cambios'] = $stmt->rowCount();
        echo "<p>5. historial_cambios: " . ($resultado5 ? "✅" : "❌") . " (eliminados: {$deleted_counts['historial_cambios']})</p>\n";
    } catch (Exception $e) {
        echo "<p>5. historial_cambios: ⚠️ Tabla no existe - " . $e->getMessage() . "</p>\n";
    }

    // 6. Eliminar pasos de auditoría
    $sql = "DELETE FROM auditoria_pasos WHERE auditoria_id = ?";
    $stmt = $pdo->prepare($sql);
    $resultado6 = $stmt->execute([$auditoria_id]);
    $deleted_counts['auditoria_pasos'] = $stmt->rowCount();
    echo "<p>6. auditoria_pasos: " . ($resultado6 ? "✅" : "❌") . " (eliminados: {$deleted_counts['auditoria_pasos']})</p>\n";

    // 7. Finalmente, eliminar la auditoría principal
    $sql = "DELETE FROM auditorias WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $resultado_final = $stmt->execute([$auditoria_id]);
    $deleted_counts['auditorias'] = $stmt->rowCount();
    echo "<p>7. auditorias: " . ($resultado_final ? "✅" : "❌") . " (eliminados: {$deleted_counts['auditorias']})</p>\n";

    echo "<h2>📋 Resumen de Eliminación:</h2>\n";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Tabla</th><th>Antes</th><th>Eliminados</th><th>Estado</th></tr>";

    foreach ($before_counts as $table => $before) {
        $deleted = $deleted_counts[$table] ?? 0;
        $status = $deleted > 0 ? "✅" : ($before > 0 ? "❌" : "⚠️");
        echo "<tr><td>$table</td><td>$before</td><td>$deleted</td><td>$status</td></tr>";
    }
    echo "</table>";

    if ($resultado_final && $deleted_counts['auditorias'] > 0) {
        $pdo->commit();
        echo "<h2>🎉 ELIMINACIÓN EXITOSA</h2>\n";
        echo "<p>✅ La auditoría ID $auditoria_id ha sido eliminada completamente</p>\n";

        // Verificar que realmente se eliminó
        $sql = "SELECT COUNT(*) FROM auditorias WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$auditoria_id]);
        $still_exists = $stmt->fetchColumn();

        if ($still_exists == 0) {
            echo "<p>✅ Verificación: La auditoría ya NO existe en la base de datos</p>\n";
        } else {
            echo "<p>❌ ERROR: La auditoría AÚN EXISTE en la base de datos</p>\n";
        }

    } else {
        $pdo->rollback();
        echo "<h2>❌ ELIMINACIÓN FALLIDA</h2>\n";
        echo "<p>❌ No se pudo eliminar la auditoría principal</p>\n";
        echo "<p>Rollback ejecutado - todos los cambios revertidos</p>\n";
    }

} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->rollback();
    }
    echo "<h2>❌ ERROR DE SISTEMA</h2>\n";
    echo "<p>Error: " . $e->getMessage() . "</p>\n";
    echo "<p>Archivo: " . $e->getFile() . " (línea " . $e->getLine() . ")</p>\n";
    echo "<pre>" . $e->getTraceAsString() . "</pre>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    table { margin: 10px 0; }
    th, td { padding: 8px; text-align: left; }
    th { background: #f8f9fa; }
</style>