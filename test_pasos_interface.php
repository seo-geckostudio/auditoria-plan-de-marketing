<?php
/**
 * TEST: INTERFAZ DE PASOS CORREGIDA
 * ================================
 */

require_once 'includes/init.php';

echo "<h1>🧪 Test Interfaz de Pasos - Versión Corregida</h1>\n";

try {
    $pdo = obtenerConexion();

    // Buscar una auditoría disponible para testing
    $sql = "SELECT id, titulo FROM auditorias ORDER BY id DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $auditorias = $stmt->fetchAll();

    if (empty($auditorias)) {
        echo "<div style='color: red;'>❌ No hay auditorías disponibles para testing</div>";
        exit;
    }

    echo "<h2>📋 Auditorías Disponibles para Testing:</h2>\n";
    foreach ($auditorias as $auditoria) {
        echo "<p>ID: {$auditoria['id']} - {$auditoria['titulo']}</p>\n";
    }

    $test_auditoria_id = $auditorias[0]['id'];
    echo "<hr>";
    echo "<h2>🎯 Testing con Auditoría ID: $test_auditoria_id</h2>\n";

    // Probar la función obtenerPasosPorFase
    echo "<h3>📊 Resultado de obtenerPasosPorFase($test_auditoria_id):</h3>\n";

    $fases = obtenerPasosPorFase($test_auditoria_id);

    if (empty($fases)) {
        echo "<p style='color: orange;'>⚠️ No se encontraron fases/pasos para esta auditoría</p>";
    } else {
        echo "<p style='color: green;'>✅ Se encontraron " . count($fases) . " fases</p>";

        foreach ($fases as $fase) {
            echo "<div style='border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px;'>";
            echo "<h4>📁 Fase {$fase['numero_fase']}: {$fase['nombre']}</h4>";

            if (empty($fase['pasos'])) {
                echo "<p style='color: orange;'>⚠️ No hay pasos en esta fase</p>";
            } else {
                echo "<p style='color: green;'>✅ " . count($fase['pasos']) . " pasos encontrados</p>";

                echo "<table border='1' style='border-collapse: collapse; width: 100%; margin: 10px 0;'>";
                echo "<tr style='background: #f8f9fa;'>";
                echo "<th>ID</th><th>Código</th><th>Nombre</th><th>Estado</th><th>Campos Mapeados</th>";
                echo "</tr>";

                foreach ($fase['pasos'] as $paso) {
                    $nombre_mostrar = $paso['nombre'] ?? 'SIN NOMBRE';
                    $id_mostrar = $paso['id'] ?? 'SIN ID';
                    $codigo_mostrar = $paso['codigo_paso'] ?? 'SIN CÓDIGO';
                    $estado_mostrar = $paso['estado'] ?? 'SIN ESTADO';

                    // Verificar campos críticos
                    $campos_ok = [];
                    if (isset($paso['nombre'])) $campos_ok[] = 'nombre ✅';
                    else $campos_ok[] = 'nombre ❌';

                    if (isset($paso['id'])) $campos_ok[] = 'id ✅';
                    else $campos_ok[] = 'id ❌';

                    if (isset($paso['paso_nombre'])) $campos_ok[] = 'paso_nombre ✅';
                    else $campos_ok[] = 'paso_nombre ❌';

                    if (isset($paso['auditoria_paso_id'])) $campos_ok[] = 'auditoria_paso_id ✅';
                    else $campos_ok[] = 'auditoria_paso_id ❌';

                    $color = ($paso['nombre'] && $paso['id']) ? '#d4edda' : '#f8d7da';

                    echo "<tr style='background: $color;'>";
                    echo "<td>$id_mostrar</td>";
                    echo "<td>$codigo_mostrar</td>";
                    echo "<td><strong>$nombre_mostrar</strong></td>";
                    echo "<td>$estado_mostrar</td>";
                    echo "<td>" . implode(', ', $campos_ok) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo "</div>";
        }
    }

    echo "<hr>";
    echo "<h2>🔗 Enlaces de Testing:</h2>\n";

    echo "<div style='background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h3>URLs para Probar:</h3>";
    echo "<p><a href='http://localhost:8000/index.php?modulo=auditorias&accion=ver&id=$test_auditoria_id' target='_blank' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>👁️ VER AUDITORÍA #$test_auditoria_id</a></p>";
    echo "<p><em>En esta página deberías ver:</em></p>";
    echo "<ul>";
    echo "<li>✅ Nombres de pasos correctos (no 'Paso sin nombre')</li>";
    echo "<li>✅ Botón de editar funcional (no error 'editarPaso is not defined')</li>";
    echo "<li>✅ IDs de pasos correctos</li>";
    echo "</ul>";
    echo "</div>";

    echo "<h2>🔧 Cambios Aplicados:</h2>\n";
    echo "<ul>";
    echo "<li>✅ <strong>obtenerPasosPorFase():</strong> Añadidos alias para compatibilidad</li>";
    echo "<li>✅ <strong>detalle.php:</strong> Añadida función JavaScript editarPaso()</li>";
    echo "<li>✅ <strong>Mapeo de campos:</strong> Ahora \$paso['nombre'] está disponible</li>";
    echo "<li>✅ <strong>IDs corregidos:</strong> Ahora \$paso['id'] apunta al ID correcto</li>";
    echo "</ul>";

} catch (Exception $e) {
    echo "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>\n";
}
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
    h1 { color: #2c3e50; }
    h2 { color: #3498db; }
    table { font-size: 14px; }
    th, td { padding: 8px; text-align: left; }
    a { text-decoration: none; }
    a:hover { opacity: 0.8; }
</style>