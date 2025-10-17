<?php
/**
 * API: Generador Dinámico de Entregables CSV
 *
 * Este endpoint genera CSVs on-demand desde los datos de la auditoría.
 * Los CSVs se cachean para evitar regeneración innecesaria.
 *
 * PARÁMETROS:
 * - auditoria_id: ID de la auditoría (requerido)
 * - tipo: Tipo de entregable (urls_huerfanas, paginas_sin_h1, etc)
 * - categoria: Categoría (arquitectura, keywords, on_page, etc)
 * - force: Si true, regenera aunque exista (opcional)
 *
 * RESPUESTA:
 * {
 *   "success": true,
 *   "file_url": "/entregables/auditoria_1/arquitectura/urls_huerfanas.csv",
 *   "file_name": "urls_huerfanas.csv",
 *   "count": 127,
 *   "message": "CSV generado exitosamente",
 *   "cached": false
 * }
 */

require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/EntregablesGenerator.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

try {
    // Validar parámetros
    $auditoriaId = filter_input(INPUT_GET, 'auditoria_id', FILTER_VALIDATE_INT);
    $tipo = $_GET['tipo'] ?? '';
    $categoria = $_GET['categoria'] ?? 'arquitectura';
    $force = filter_input(INPUT_GET, 'force', FILTER_VALIDATE_BOOLEAN);

    if (!$auditoriaId) {
        throw new Exception('auditoria_id es requerido');
    }

    if (empty($tipo)) {
        throw new Exception('tipo es requerido');
    }

    // Verificar que la auditoría existe
    $auditoria = obtenerAuditoria($auditoriaId);
    if (!$auditoria) {
        throw new Exception('Auditoría no encontrada');
    }

    // Inicializar generador
    $generator = new EntregablesGenerator($auditoriaId);

    // Verificar si el CSV ya existe y no es forzado
    $cacheFile = __DIR__ . '/../entregables/auditoria_' . $auditoriaId . '/' . $categoria . '/' . $tipo . '.csv';
    $cached = false;

    if (file_exists($cacheFile) && !$force) {
        // Verificar si el caché es reciente (menos de 24 horas)
        $cacheAge = time() - filemtime($cacheFile);
        if ($cacheAge < 86400) {
            echo json_encode([
                'success' => true,
                'file_url' => '/entregables/auditoria_' . $auditoriaId . '/' . $categoria . '/' . $tipo . '.csv',
                'file_name' => $tipo . '.csv',
                'count' => count(file($cacheFile)) - 1, // -1 para el header
                'message' => 'CSV cargado desde caché',
                'cached' => true,
                'cache_age_hours' => round($cacheAge / 3600, 1)
            ]);
            exit;
        }
    }

    // Cargar datos de Screaming Frog para esta auditoría
    $datosScreamingFrog = cargarDatosScreamingFrog($auditoriaId);

    if (empty($datosScreamingFrog)) {
        throw new Exception('No hay datos de Screaming Frog disponibles para esta auditoría');
    }

    // Generar CSV según el tipo
    $resultado = null;

    switch ($tipo) {
        case 'urls_huerfanas':
        case 'urls_huerfanas_corregir':
            $resultado = $generator->generarURLsHuerfanas($datosScreamingFrog);
            break;

        case 'urls_profundas':
        case 'urls_profundas_reducir':
            $resultado = $generator->generarURLsProfundas($datosScreamingFrog);
            break;

        case 'paginas_sin_h1':
            $resultado = $generator->generarPaginasSinH1($datosScreamingFrog);
            break;

        case 'imagenes_sin_alt':
            $resultado = $generator->generarImagenesSinAlt($datosScreamingFrog);
            break;

        case 'todos_arquitectura':
            $resultados = $generator->generarTodosArquitectura($datosScreamingFrog);
            echo json_encode([
                'success' => true,
                'resultados' => $resultados,
                'message' => 'Todos los CSVs de arquitectura generados'
            ]);
            exit;

        case 'todos_onpage':
            $resultados = $generator->generarTodosOnPage($datosScreamingFrog);
            echo json_encode([
                'success' => true,
                'resultados' => $resultados,
                'message' => 'Todos los CSVs de on-page generados'
            ]);
            exit;

        default:
            throw new Exception('Tipo de entregable no soportado: ' . $tipo);
    }

    // Retornar resultado
    if ($resultado && $resultado['success']) {
        echo json_encode(array_merge($resultado, ['cached' => false]));
    } else {
        throw new Exception($resultado['message'] ?? 'Error al generar CSV');
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

/**
 * Carga datos de Screaming Frog desde JSON o base de datos
 *
 * @param int $auditoriaId
 * @return array
 */
function cargarDatosScreamingFrog($auditoriaId) {
    // Intentar cargar desde archivo JSON
    $jsonFile = __DIR__ . '/../data/screamingfrog/auditoria_' . $auditoriaId . '.json';

    if (file_exists($jsonFile)) {
        $json = file_get_contents($jsonFile);
        return json_decode($json, true) ?? [];
    }

    // Alternativamente, cargar desde base de datos
    // (si tienes una tabla que almacena los datos de SF)
    $sql = "SELECT datos_json FROM datos_screaming_frog WHERE auditoria_id = ?";
    $result = ejecutarConsulta($sql, [$auditoriaId]);

    if ($result && !empty($result[0]['datos_json'])) {
        return json_decode($result[0]['datos_json'], true) ?? [];
    }

    // Si no hay datos, retornar estructura vacía
    return [
        'internal' => [],
        'images' => []
    ];
}
