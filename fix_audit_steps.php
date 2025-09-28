<?php
/**
 * SCRIPT: GENERAR PASOS PARA AUDITORÍAS EXISTENTES
 * ================================================
 *
 * Genera automáticamente los pasos faltantes para auditorías que no los tienen
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "🔧 Generando pasos faltantes para auditorías existentes...\n\n";

try {
    $pdo->beginTransaction();

    // Obtener auditorías que no tienen pasos
    $sql = "
        SELECT a.id, a.titulo
        FROM auditorias a
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        WHERE ap.id IS NULL
        GROUP BY a.id
    ";

    $stmt = $pdo->query($sql);
    $auditorias_sin_pasos = $stmt->fetchAll();

    echo "📋 Encontradas " . count($auditorias_sin_pasos) . " auditorías sin pasos\n\n";

    // Obtener todas las plantillas de pasos disponibles
    $sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE activo = 1 ORDER BY fase_id, orden_en_fase";
    $stmt = $pdo->query($sql);
    $plantillas = $stmt->fetchAll();

    echo "📝 Plantillas disponibles: " . count($plantillas) . "\n\n";

    // Para cada auditoría sin pasos, generar los pasos
    foreach ($auditorias_sin_pasos as $auditoria) {
        echo "⚙️ Procesando auditoría ID {$auditoria['id']}: {$auditoria['titulo']}\n";

        $pasos_creados = 0;

        foreach ($plantillas as $plantilla) {
            $sql = "
                INSERT INTO auditoria_pasos (auditoria_id, paso_plantilla_id, estado, orden_personalizado, notas)
                VALUES (?, ?, 'pendiente', ?, '')
            ";

            $stmt = $pdo->prepare($sql);
            $resultado = $stmt->execute([
                $auditoria['id'],
                $plantilla['id'],
                $plantilla['id'] // usar ID como orden temporal
            ]);

            if ($resultado) {
                $pasos_creados++;
                echo "  ✓ Creado paso: {$plantilla['codigo_paso']} - {$plantilla['nombre']}\n";
            }
        }

        echo "  📊 Total pasos creados: $pasos_creados\n\n";
    }

    $pdo->commit();

    echo "✅ Proceso completado exitosamente!\n\n";

    // Verificar resultados
    echo "🔍 VERIFICACIÓN FINAL:\n";
    $sql = "
        SELECT a.id, a.titulo, COUNT(ap.id) as total_pasos
        FROM auditorias a
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        GROUP BY a.id
        ORDER BY a.id
        LIMIT 5
    ";

    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo "Auditoría ID {$row['id']}: {$row['total_pasos']} pasos\n";
    }

    echo "\n🎯 URLS DE PRUEBA:\n";
    echo "📝 Formulario paso 1: http://localhost:8000/index.php?modulo=auditorias&accion=formulario&auditoria_id=1&paso_id=1\n";
    echo "🎛️ Selector método: http://localhost:8000/index.php?modulo=auditorias&accion=seleccionar_metodo&auditoria_id=1&paso_id=1\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>