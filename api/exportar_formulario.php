<?php
/**
 * API: EXPORTAR DATOS DE FORMULARIO
 * ==================================
 *
 * Endpoint para exportar datos de formularios en diferentes formatos
 */

// Inicializar sistema
define('SISTEMA_INICIADO', true);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../modules/formularios.php';

// Verificar método HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

try {
    // Obtener parámetros
    $paso_id = (int)($_GET['paso_id'] ?? 0);
    $formato = $_GET['formato'] ?? 'json';

    if (!$paso_id) {
        throw new Exception('Parámetro paso_id es obligatorio');
    }

    // Verificar que el paso existe
    $sql_paso = "
        SELECT
            ap.*,
            pp.nombre as paso_nombre,
            pp.codigo_paso,
            a.nombre_auditoria,
            c.nombre_empresa
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        JOIN auditorias a ON ap.auditoria_id = a.id
        JOIN clientes c ON a.cliente_id = c.id
        WHERE ap.id = ?
    ";

    $paso_info = obtenerRegistro($sql_paso, [$paso_id]);

    if (!$paso_info) {
        throw new Exception('Paso no encontrado');
    }

    // Exportar según formato solicitado
    switch ($formato) {
        case 'json':
            header('Content-Type: application/json; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $paso_info['codigo_paso'] . '_' . date('Y-m-d') . '.json"');

            $datos_json = exportarDatosFormulario($paso_id, 'json');
            echo $datos_json;
            break;

        case 'excel':
            // Para Excel necesitaríamos una librería como PhpSpreadsheet
            // Por ahora devolvemos CSV que Excel puede abrir
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $paso_info['codigo_paso'] . '_' . date('Y-m-d') . '.csv"');

            $datos = exportarDatosFormulario($paso_id, 'array');

            // Escribir cabeceras CSV
            echo "Campo,Etiqueta,Valor,Tipo\n";

            // Escribir datos
            foreach ($datos as $fila) {
                echo '"' . str_replace('"', '""', $fila['nombre_campo']) . '",';
                echo '"' . str_replace('"', '""', $fila['etiqueta']) . '",';
                echo '"' . str_replace('"', '""', $fila['valor']) . '",';
                echo '"' . str_replace('"', '""', $fila['tipo_campo']) . '"' . "\n";
            }
            break;

        default:
            throw new Exception('Formato no soportado: ' . $formato);
    }

} catch (Exception $e) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>