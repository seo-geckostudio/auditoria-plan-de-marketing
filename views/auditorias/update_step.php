<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$step_id = $input['step_id'] ?? null;
$estado = $input['estado'] ?? null;
$tiempo_real_horas = $input['tiempo_real_horas'] ?? null;
$notas = $input['notas'] ?? null;
$datos_completados = $input['datos_completados'] ?? null;

if (!$step_id) {
    echo json_encode(['success' => false, 'message' => 'ID de paso requerido']);
    exit;
}

try {
    $pdo = obtenerConexion();
    
    // Construir la consulta dinámicamente
    $updates = [];
    $params = [];
    
    if ($estado !== null) {
        $updates[] = "estado = ?";
        $params[] = $estado;
        
        // Si se marca como completado, establecer fecha de completado
        if ($estado === 'completado') {
            $updates[] = "fecha_completado = ?";
            $params[] = date('Y-m-d H:i:s');
        }
        
        // Si se inicia, establecer fecha de inicio
        if ($estado === 'en_progreso') {
            $updates[] = "fecha_inicio = COALESCE(fecha_inicio, ?)";
            $params[] = date('Y-m-d H:i:s');
        }
    }
    
    if ($tiempo_real_horas !== null) {
        $updates[] = "tiempo_real_horas = ?";
        $params[] = floatval($tiempo_real_horas);
    }
    
    if ($notas !== null) {
        $updates[] = "notas = ?";
        $params[] = $notas;
    }
    
    if ($datos_completados !== null) {
        // Validar que sea JSON válido
        if ($datos_completados && json_decode($datos_completados) === null) {
            echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos']);
            exit;
        }
        $updates[] = "datos_completados = ?";
        $params[] = $datos_completados;
    }
    
    if (empty($updates)) {
        echo json_encode(['success' => false, 'message' => 'No hay datos para actualizar']);
        exit;
    }
    
    // Agregar fecha de actualización
    $updates[] = "fecha_actualizacion = ?";
    $params[] = date('Y-m-d H:i:s');
    
    // Agregar el ID del paso al final
    $params[] = $step_id;
    
    $sql = "UPDATE auditoria_pasos SET " . implode(', ', $updates) . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute($params);
    
    if ($result) {
        // Obtener información actualizada del paso
        $stmt = $pdo->prepare("
            SELECT ap.*, pp.nombre as paso_nombre, f.nombre as fase_nombre
            FROM auditoria_pasos ap
            JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
            JOIN fases f ON pp.fase_id = f.id
            WHERE ap.id = ?
        ");
        $stmt->execute([$step_id]);
        $paso_actualizado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Actualizar el porcentaje de la auditoría
        if ($paso_actualizado) {
            actualizarPorcentajeAuditoria($pdo, $paso_actualizado['auditoria_id']);
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Paso actualizado correctamente',
            'data' => $paso_actualizado
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el paso']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}

function actualizarPorcentajeAuditoria($pdo, $auditoria_id) {
    // Calcular el porcentaje de completado de la auditoría
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_pasos,
            SUM(CASE WHEN estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados
        FROM auditoria_pasos 
        WHERE auditoria_id = ?
    ");
    $stmt->execute([$auditoria_id]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $porcentaje = 0;
    if ($stats['total_pasos'] > 0) {
        $porcentaje = round(($stats['pasos_completados'] / $stats['total_pasos']) * 100, 1);
    }
    
    // Actualizar el porcentaje en la tabla auditorías
    $stmt = $pdo->prepare("
        UPDATE auditorias 
        SET porcentaje_completado = ?, fecha_actualizacion = ?
        WHERE id = ?
    ");
    $stmt->execute([$porcentaje, date('Y-m-d H:i:s'), $auditoria_id]);
    
    // Si está 100% completado, marcar la auditoría como completada
    if ($porcentaje >= 100) {
        $stmt = $pdo->prepare("
            UPDATE auditorias 
            SET estado = 'completada', fecha_fin = COALESCE(fecha_fin, ?)
            WHERE id = ? AND estado != 'completada'
        ");
        $stmt->execute([date('Y-m-d H:i:s'), $auditoria_id]);
    }
}
?>