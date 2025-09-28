<?php
/**
 * API: GUARDAR DATOS DE FORMULARIO DINÁMICO
 * ==========================================
 *
 * Endpoint para guardar los datos introducidos en formularios dinámicos
 * Maneja validación, guardado y cálculo de progreso
 */

// Configurar headers para respuesta JSON
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Verificar método HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido. Use POST.'
    ]);
    exit;
}

// Inicializar sistema
define('SISTEMA_INICIADO', true);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../modules/formularios.php';

try {
    // Obtener y validar parámetros
    $auditoria_id = (int)($_POST['auditoria_id'] ?? 0);
    $paso_id = (int)($_POST['paso_id'] ?? 0);
    $campos_datos = $_POST['campos'] ?? [];

    // Validar parámetros obligatorios
    if (!$auditoria_id || !$paso_id) {
        throw new Exception('Parámetros auditoria_id y paso_id son obligatorios');
    }

    if (empty($campos_datos) || !is_array($campos_datos)) {
        throw new Exception('No se recibieron datos de campos válidos');
    }

    // Verificar que el paso existe y pertenece a la auditoría
    $sql_verificar = "
        SELECT
            ap.id,
            ap.paso_plantilla_id,
            ap.estado,
            pp.nombre as paso_nombre,
            a.nombre_auditoria
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        JOIN auditorias a ON ap.auditoria_id = a.id
        WHERE ap.id = ? AND ap.auditoria_id = ?
    ";

    $paso_info = obtenerRegistro($sql_verificar, [$paso_id, $auditoria_id]);

    if (!$paso_info) {
        throw new Exception('El paso especificado no existe o no pertenece a esta auditoría');
    }

    // Obtener configuración de campos para validación
    $campos_config = obtenerCamposPaso($paso_info['paso_plantilla_id']);

    if (empty($campos_config)) {
        throw new Exception('No se encontró configuración de campos para este paso');
    }

    // Crear un índice de campos por ID para fácil acceso
    $campos_por_id = [];
    foreach ($campos_config as $campo) {
        $campos_por_id[$campo['id']] = $campo;
    }

    // Validar que los campos recibidos existen en la configuración
    foreach ($campos_datos as $campo_id => $valor) {
        if (!isset($campos_por_id[$campo_id])) {
            throw new Exception("Campo ID {$campo_id} no es válido para este paso");
        }
    }

    // Realizar validaciones de campos
    $errores_validacion = validarFormulario($campos_datos, $campos_config);

    if (!empty($errores_validacion)) {
        echo json_encode([
            'success' => false,
            'message' => 'Errores de validación encontrados',
            'errores' => $errores_validacion
        ]);
        exit;
    }

    // Obtener ID de usuario (en producción sería desde sesión)
    $usuario_id = $_SESSION['usuario_id'] ?? 1;

    // Guardar datos en la base de datos
    $guardado_exitoso = guardarDatosFormulario($paso_id, $campos_datos, $usuario_id);

    if (!$guardado_exitoso) {
        throw new Exception('Error interno al guardar los datos');
    }

    // Calcular nuevo porcentaje de completitud
    $porcentaje_completado = calcularCompletitudFormulario($paso_id);

    // Obtener información actualizada del paso
    $sql_estado = "
        SELECT estado, porcentaje_completado, fecha_actualizacion
        FROM auditoria_pasos
        WHERE id = ?
    ";
    $estado_actual = obtenerRegistro($sql_estado, [$paso_id]);

    // Determinar si se completó el paso
    $paso_completado = $porcentaje_completado >= 100;

    // Preparar estadísticas adicionales
    $stats = [
        'campos_completados' => count(array_filter($campos_datos, function($valor) {
            return !empty(trim($valor));
        })),
        'campos_totales' => count($campos_config),
        'campos_obligatorios' => count(array_filter($campos_config, function($c) {
            return $c['obligatorio'];
        })),
        'cambios_realizados' => count($campos_datos)
    ];

    // Registrar evento en log (opcional)
    $evento = [
        'tipo' => 'formulario_guardado',
        'usuario_id' => $usuario_id,
        'auditoria_id' => $auditoria_id,
        'paso_id' => $paso_id,
        'paso_nombre' => $paso_info['paso_nombre'],
        'campos_modificados' => count($campos_datos),
        'porcentaje_anterior' => $paso_info['porcentaje_completado'] ?? 0,
        'porcentaje_nuevo' => $porcentaje_completado,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // TODO: Guardar en tabla de logs si existe
    // insertarLog($evento);

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => $paso_completado
            ? 'Paso completado correctamente'
            : 'Datos guardados correctamente',
        'data' => [
            'paso_id' => $paso_id,
            'paso_nombre' => $paso_info['paso_nombre'],
            'estado_anterior' => $paso_info['estado'],
            'estado_actual' => $estado_actual['estado'],
            'porcentaje_completado' => round($porcentaje_completado, 2),
            'paso_completado' => $paso_completado,
            'fecha_actualizacion' => $estado_actual['fecha_actualizacion'],
            'estadisticas' => $stats
        ]
    ]);

} catch (PDOException $e) {
    // Error de base de datos
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos',
        'error_code' => 'DB_ERROR',
        'details' => $e->getMessage()
    ]);

} catch (Exception $e) {
    // Otros errores
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 'VALIDATION_ERROR'
    ]);

} catch (Error $e) {
    // Errores fatales de PHP
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor',
        'error_code' => 'SYSTEM_ERROR',
        'details' => $e->getMessage()
    ]);
}
?>