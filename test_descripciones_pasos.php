<?php
/**
 * Test de descripciones dinámicas de pasos
 */

require_once __DIR__ . '/includes/init.php';

echo "<h2>Test de Descripciones Dinámicas de Pasos</h2>";

echo "<h3>1. Probando función generarDescripcionPaso</h3>";

// Datos de prueba para un paso
$pasoTest = [
    'codigo_paso' => '00.01',
    'nombre' => 'ANÁLISIS DE MERCADO COMPLETO',
    'paso_nombre' => 'ANÁLISIS DE MERCADO COMPLETO',
    'estado' => 'pendiente',
    'es_critico' => 1,
    'numero_fase' => 0,
    'orden_en_fase' => 1,
    'descripcion' => 'Información del Proyecto - Cliente: [Nombre del cliente] - Sitio web: [URL principal]'
];

echo "<h4>Paso de prueba:</h4>";
echo "<pre>" . print_r($pasoTest, true) . "</pre>";

// Test con paso completado
$pasoCompletado = $pasoTest;
$pasoCompletado['estado'] = 'completado';

echo "<h4>Descripción para paso completado:</h4>";
$descripcionCompletado = generarDescripcionPaso($pasoCompletado);
echo "Resultado: '" . $descripcionCompletado . "'<br>";

// Test con paso pendiente sin dependencias
echo "<h4>Descripción para paso pendiente (primer paso):</h4>";
$descripcionPendiente = generarDescripcionPaso($pasoTest);
echo "Resultado: '" . $descripcionPendiente . "'<br>";

// Test con paso en progreso
$pasoEnProgreso = $pasoTest;
$pasoEnProgreso['estado'] = 'en_progreso';

echo "<h4>Descripción para paso en progreso:</h4>";
$descripcionEnProgreso = generarDescripcionPaso($pasoEnProgreso);
echo "Resultado: '" . $descripcionEnProgreso . "'<br>";

// Test con dependencias
$pasoSegundo = [
    'codigo_paso' => '00.02',
    'nombre' => 'ANÁLISIS DE COMPETENCIA 360°',
    'paso_nombre' => 'ANÁLISIS DE COMPETENCIA 360°',
    'estado' => 'pendiente',
    'es_critico' => 0,
    'numero_fase' => 0,
    'orden_en_fase' => 2,
    'descripcion' => 'Análisis de competencia'
];

$todosLosPasos = [$pasoTest, $pasoSegundo];

echo "<h4>Descripción para segundo paso (con dependencia del primer paso pendiente):</h4>";
$descripcionConDependencia = generarDescripcionPaso($pasoSegundo, $todosLosPasos);
echo "Resultado: '" . $descripcionConDependencia . "'<br>";

// Test con dependencia completada
$pasoTestCompletado = $pasoTest;
$pasoTestCompletado['estado'] = 'completado';
$todosLosPasosConCompleto = [$pasoTestCompletado, $pasoSegundo];

echo "<h4>Descripción para segundo paso (con dependencia del primer paso completado):</h4>";
$descripcionDependenciaCompleta = generarDescripcionPaso($pasoSegundo, $todosLosPasosConCompleto);
echo "Resultado: '" . $descripcionDependenciaCompleta . "'<br>";

echo "<h3>2. Probando función obtenerPasosPorFase</h3>";

// Test con auditoría real
$auditoriaId = 1;
echo "<h4>Obteniendo pasos para auditoría ID: $auditoriaId</h4>";

$fases = obtenerPasosPorFase($auditoriaId);

echo "<h4>Fases obtenidas: " . count($fases) . "</h4>";

foreach ($fases as $numeroFase => $fase) {
    echo "<h5>Fase $numeroFase: " . htmlspecialchars($fase['nombre']) . "</h5>";
    echo "Número de pasos: " . count($fase['pasos']) . "<br>";

    foreach ($fase['pasos'] as $index => $paso) {
        $nombre = $paso['nombre'] ?? $paso['paso_nombre'] ?? 'Sin nombre';
        $estado = $paso['estado'] ?? 'pendiente';
        $descripcionDinamica = $paso['descripcion_dinamica'] ?? 'Sin descripción dinámica';

        echo "<div style='margin-left: 20px; margin-bottom: 10px; border-left: 3px solid #007bff; padding-left: 10px;'>";
        echo "<strong>" . htmlspecialchars($nombre) . "</strong><br>";
        echo "Estado: " . htmlspecialchars($estado) . "<br>";
        echo "Descripción dinámica: <em>" . htmlspecialchars($descripcionDinamica) . "</em><br>";
        echo "</div>";

        if ($index >= 2) {
            echo "<div style='margin-left: 20px; color: #666;'>... y " . (count($fase['pasos']) - 3) . " pasos más</div>";
            break;
        }
    }
}

echo "<h3>3. Verificando funciones auxiliares</h3>";

echo "Función generarDescripcionPaso existe: " . (function_exists('generarDescripcionPaso') ? 'SÍ' : 'NO') . "<br>";
echo "Función obtenerDependenciasPaso existe: " . (function_exists('obtenerDependenciasPaso') ? 'SÍ' : 'NO') . "<br>";
echo "Función obtenerPasosPorFase existe: " . (function_exists('obtenerPasosPorFase') ? 'SÍ' : 'NO') . "<br>";

echo "<h3>Test completado</h3>";
?>