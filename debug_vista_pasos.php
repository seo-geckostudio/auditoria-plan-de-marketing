<?php
/**
 * Debug específico para ver qué datos llegan a la vista de auditorías
 */

require_once __DIR__ . '/includes/init.php';

echo "<h2>Debug Vista de Pasos - Auditoría ID: 1</h2>";

// Obtener auditoría como lo haría la vista real
$auditoriaId = 1;

// Simular la lógica de modules/auditorias.php
require_once __DIR__ . '/modules/auditorias.php';

echo "<h3>1. Verificando función obtenerAuditoriaPorId</h3>";
if (function_exists('obtenerAuditoriaPorId')) {
    $auditoria = obtenerAuditoriaPorId($auditoriaId);
    echo "Auditoría obtenida: " . ($auditoria ? "SÍ" : "NO") . "<br>";
    if ($auditoria) {
        echo "Título: " . htmlspecialchars($auditoria['titulo'] ?? 'Sin título') . "<br>";
    }
} else {
    echo "ERROR: Función obtenerAuditoriaPorId no existe<br>";
}

echo "<h3>2. Verificando función obtenerPasosPorFase</h3>";
if (function_exists('obtenerPasosPorFase')) {
    echo "Función obtenerPasosPorFase existe: SÍ<br>";

    try {
        $fases = obtenerPasosPorFase($auditoriaId);
        echo "Resultado obtenido: " . (is_array($fases) ? "Array con " . count($fases) . " elementos" : "No es array") . "<br>";

        if (is_array($fases) && !empty($fases)) {
            foreach ($fases as $numeroFase => $fase) {
                echo "<h4>Fase $numeroFase: " . htmlspecialchars($fase['nombre'] ?? 'Sin nombre') . "</h4>";
                echo "Número de pasos: " . count($fase['pasos'] ?? []) . "<br>";

                if (!empty($fase['pasos'])) {
                    $primerPaso = $fase['pasos'][0];
                    echo "<h5>Primer paso de la fase:</h5>";
                    echo "Nombre: " . htmlspecialchars($primerPaso['nombre'] ?? 'Sin nombre') . "<br>";
                    echo "Estado: " . htmlspecialchars($primerPaso['estado'] ?? 'Sin estado') . "<br>";
                    echo "Descripción original: " . htmlspecialchars(substr($primerPaso['descripcion'] ?? 'Sin descripción', 0, 100)) . "...<br>";
                    echo "Descripción dinámica: " . htmlspecialchars($primerPaso['descripcion_dinamica'] ?? 'SIN DESCRIPCIÓN DINÁMICA') . "<br>";
                    echo "Campo descripcion_dinamica existe: " . (isset($primerPaso['descripcion_dinamica']) ? "SÍ" : "NO") . "<br>";

                    echo "<h6>Todos los campos del primer paso:</h6>";
                    echo "<pre>" . print_r(array_keys($primerPaso), true) . "</pre>";
                }

                if ($numeroFase == 0) break; // Solo mostrar la primera fase para no saturar
            }
        } else {
            echo "No se obtuvieron fases o está vacío<br>";
        }

    } catch (Exception $e) {
        echo "ERROR al ejecutar obtenerPasosPorFase: " . $e->getMessage() . "<br>";
    }
} else {
    echo "ERROR: Función obtenerPasosPorFase no existe<br>";
}

echo "<h3>3. Verificando funciones auxiliares</h3>";
echo "generarDescripcionPaso existe: " . (function_exists('generarDescripcionPaso') ? "SÍ" : "NO") . "<br>";
echo "obtenerDependenciasPaso existe: " . (function_exists('obtenerDependenciasPaso') ? "SÍ" : "NO") . "<br>";

echo "<h3>4. Test directo de la función</h3>";
try {
    $sql = "SELECT pt.codigo_paso, pt.nombre as paso_nombre, pt.orden_en_fase, pt.es_critico, ap.estado, f.numero_fase FROM pasos_plantilla pt LEFT JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id AND ap.auditoria_id = ? LEFT JOIN fases f ON pt.fase_id = f.id WHERE pt.activo = 1 AND f.numero_fase = 0 ORDER BY pt.orden_en_fase LIMIT 3";

    $pdo = obtenerConexion();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$auditoriaId]);
    $pasosDirect = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Pasos obtenidos directamente: " . count($pasosDirect) . "<br>";

    foreach ($pasosDirect as $paso) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 5px;'>";
        echo "Nombre: " . htmlspecialchars($paso['paso_nombre']) . "<br>";
        echo "Código: " . htmlspecialchars($paso['codigo_paso']) . "<br>";
        echo "Estado: " . htmlspecialchars($paso['estado'] ?? 'pendiente') . "<br>";
        echo "Es crítico: " . ($paso['es_critico'] ? 'SÍ' : 'NO') . "<br>";

        if (function_exists('generarDescripcionPaso')) {
            $descripcionTest = generarDescripcionPaso($paso, $pasosDirect);
            echo "Descripción generada: <strong>" . htmlspecialchars($descripcionTest) . "</strong><br>";
        }
        echo "</div>";
    }

} catch (Exception $e) {
    echo "ERROR en test directo: " . $e->getMessage() . "<br>";
}

?>