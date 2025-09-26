<?php
/**
 * MÓDULO DE PASOS
 * ===============
 * 
 * Módulo para la gestión de pasos de auditoría SEO
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/forms.php';

// =====================================================
// CONTROLADOR PRINCIPAL
// =====================================================

/**
 * Controlador principal del módulo de pasos
 */
function manejarPasos() {
    $accion = $_GET['accion'] ?? 'listar';
    
    switch ($accion) {
        case 'listar':
            mostrarListaPasos();
            break;
        case 'ver':
            mostrarDetallePaso();
            break;
        case 'actualizar':
            procesarActualizacionPaso();
            break;
        case 'plantillas':
            mostrarPlantillasPasos();
            break;
        case 'importar':
            mostrarImportarPasos();
            break;
        default:
            mostrarListaPasos();
    }
}

// =====================================================
// VISTAS DE PASOS
// =====================================================

/**
 * Muestra la lista de pasos de una auditoría específica
 */
function mostrarListaPasos() {
    $auditoriaId = (int)($_GET['auditoria_id'] ?? 0);
    
    if (!$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Verificar que la auditoría existe
    $auditoria = obtenerAuditoria($auditoriaId);
    if (!$auditoria) {
        header('Location: ?modulo=auditorias&accion=listar&error=no_encontrada');
        exit;
    }
    
    // Obtener pasos organizados por fase
    $fases = obtenerPasosPorFase($auditoriaId);
    
    // Obtener estadísticas de progreso
    $estadisticas = obtenerEstadisticasPasos($auditoriaId);
    
    include __DIR__ . '/../views/pasos/lista.php';
}

/**
 * Muestra el detalle de un paso específico
 */
function mostrarDetallePaso() {
    $pasoId = (int)($_GET['id'] ?? 0);
    $auditoriaId = (int)($_GET['auditoria_id'] ?? 0);
    
    if (!$pasoId || !$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Obtener datos del paso
    $paso = obtenerDetallePaso($pasoId, $auditoriaId);
    if (!$paso) {
        header('Location: ?modulo=pasos&accion=listar&auditoria_id=' . $auditoriaId);
        exit;
    }
    
    // Obtener archivos del paso
    $archivos = obtenerArchivosPaso($pasoId);
    
    // Obtener comentarios del paso
    $comentarios = obtenerComentariosPaso($pasoId);
    
    // Obtener historial del paso
    $historial = obtenerHistorialPaso($pasoId);
    
    include __DIR__ . '/../views/pasos/detalle.php';
}

/**
 * Procesa la actualización de un paso via AJAX
 */
function procesarActualizacionPaso() {
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit;
    }
    
    $resultado = procesarFormulario();
    echo json_encode($resultado);
    exit;
}

/**
 * Muestra la gestión de plantillas de pasos
 */
function mostrarPlantillasPasos() {
    // Obtener todas las plantillas organizadas por fase
    $plantillas = obtenerPlantillasPasos();
    
    // Procesar formulario si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultado = procesarPlantillaPaso();
        if ($resultado['success']) {
            header('Location: ?modulo=pasos&accion=plantillas&success=1');
            exit;
        } else {
            $error = $resultado['message'];
            $errores = $resultado['errores'] ?? [];
        }
    }
    
    include __DIR__ . '/../views/pasos/plantillas.php';
}

/**
 * Muestra la interfaz para importar pasos desde archivos
 */
function mostrarImportarPasos() {
    // Procesar importación si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultado = procesarImportacionPasos();
        if ($resultado['success']) {
            header('Location: ?modulo=pasos&accion=plantillas&imported=1');
            exit;
        } else {
            $error = $resultado['message'];
        }
    }
    
    // Obtener estadísticas de plantillas actuales
    $estadisticas = obtenerEstadisticasPlantillas();
    
    include __DIR__ . '/../views/pasos/importar.php';
}

// =====================================================
// FUNCIONES ESPECÍFICAS DE PASOS
// =====================================================

/**
 * Obtiene el detalle completo de un paso
 * 
 * @param int $pasoId ID del paso
 * @param int $auditoriaId ID de la auditoría
 * @return array|false Datos del paso
 */
function obtenerDetallePaso($pasoId, $auditoriaId) {
    $sql = "
        SELECT 
            ap.*,
            pt.codigo_paso,
            pt.nombre as paso_nombre,
            pt.descripcion,
            pt.instrucciones,
            pt.es_critico,
            pt.tiempo_estimado_horas,
            f.numero_fase,
            f.nombre as fase_nombre,
            a.titulo as auditoria_nombre,
            c.nombre as cliente_nombre
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        JOIN fases f ON pt.fase_id = f.id
        JOIN auditorias a ON ap.auditoria_id = a.id
        JOIN clientes c ON a.cliente_id = c.id
        WHERE ap.id = ? AND ap.auditoria_id = ?
    ";
    
    return obtenerRegistro($sql, [$pasoId, $auditoriaId]);
}

/**
 * Obtiene los archivos asociados a un paso
 * 
 * @param int $pasoId ID del paso
 * @return array Lista de archivos
 */
function obtenerArchivosPaso($pasoId) {
    $sql = "
        SELECT 
            a.*,
            u.nombre as subido_por
        FROM archivos a
        JOIN usuarios u ON a.subido_por_usuario_id = u.id
        WHERE a.auditoria_paso_id = ?
        ORDER BY a.fecha_subida DESC
    ";
    
    return ejecutarConsulta($sql, [$pasoId]);
}

/**
 * Obtiene los comentarios de un paso específico
 * 
 * @param int $pasoId ID del paso
 * @return array Lista de comentarios
 */
function obtenerComentariosPaso($pasoId) {
    $sql = "
        SELECT 
            c.*,
            u.nombre as usuario_nombre
        FROM comentarios c
        JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.auditoria_paso_id = ?
        ORDER BY c.fecha_comentario DESC
    ";
    
    return ejecutarConsulta($sql, [$pasoId]);
}

/**
 * Obtiene el historial de cambios de un paso
 * 
 * @param int $pasoId ID del paso
 * @return array Lista de cambios
 */
function obtenerHistorialPaso($pasoId) {
    $sql = "
        SELECT 
            h.*,
            u.nombre as usuario_nombre
        FROM historial_cambios h
        JOIN usuarios u ON h.usuario_id = u.id
        JOIN auditoria_pasos ap ON h.auditoria_id = ap.auditoria_id
        WHERE h.descripcion LIKE CONCAT('%paso ', ?, '%')
        OR h.descripcion LIKE '%archivo%'
        ORDER BY h.fecha_cambio DESC
        LIMIT 20
    ";
    
    return ejecutarConsulta($sql, [$pasoId]);
}

/**
 * Obtiene estadísticas de pasos para una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Estadísticas calculadas
 */
function obtenerEstadisticasPasos($auditoriaId) {
    $stats = [];
    
    // Estadísticas generales
    $sql = "
        SELECT 
            COUNT(*) as total_pasos,
            SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as completados,
            SUM(CASE WHEN ap.estado = 'en_progreso' THEN 1 ELSE 0 END) as en_progreso,
            SUM(CASE WHEN ap.estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes,
            SUM(CASE WHEN pt.es_critico = 1 THEN 1 ELSE 0 END) as criticos,
            SUM(CASE WHEN pt.es_critico = 1 AND ap.estado = 'completado' THEN 1 ELSE 0 END) as criticos_completados
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        WHERE ap.auditoria_id = ?
    ";
    $stats['general'] = obtenerRegistro($sql, [$auditoriaId]);
    
    // Estadísticas por fase
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            COUNT(ap.id) as total_pasos,
            SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as completados,
            ROUND(
                (SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) * 100.0) / COUNT(ap.id), 
                2
            ) as porcentaje_completado
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
        LEFT JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id AND ap.auditoria_id = ?
        WHERE pt.activo = 1
        GROUP BY f.id, f.numero_fase, f.nombre
        ORDER BY f.numero_fase
    ";
    $stats['por_fase'] = ejecutarConsulta($sql, [$auditoriaId]);
    
    return $stats;
}

/**
 * Obtiene todas las plantillas de pasos organizadas por fase
 * 
 * @return array Plantillas organizadas
 */
function obtenerPlantillasPasos() {
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            pt.*
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
        WHERE pt.activo = 1
        ORDER BY f.numero_fase, pt.orden_en_fase
    ";
    
    $plantillas = ejecutarConsulta($sql);
    
    // Organizar por fases
    $fases = [];
    foreach ($plantillas as $plantilla) {
        $numeroFase = $plantilla['numero_fase'];
        if (!isset($fases[$numeroFase])) {
            $fases[$numeroFase] = [
                'numero_fase' => $numeroFase,
                'nombre' => $plantilla['fase_nombre'],
                'pasos' => []
            ];
        }
        if ($plantilla['id']) {
            $fases[$numeroFase]['pasos'][] = $plantilla;
        }
    }
    
    return $fases;
}

/**
 * Procesa el formulario de plantilla de paso
 * 
 * @return array Resultado del procesamiento
 */
function procesarPlantillaPaso() {
    $accion = sanitizar($_POST['accion_plantilla'] ?? '');
    
    switch ($accion) {
        case 'crear':
            return crearPlantillaPaso();
        case 'actualizar':
            return actualizarPlantillaPaso();
        case 'eliminar':
            return eliminarPlantillaPaso();
        default:
            return ['success' => false, 'message' => 'Acción no válida'];
    }
}

/**
 * Crea una nueva plantilla de paso
 * 
 * @return array Resultado del procesamiento
 */
function crearPlantillaPaso() {
    // Validar datos
    $errores = validarDatosPlantillaPaso($_POST);
    if (!empty($errores)) {
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    
    // Obtener siguiente orden en la fase
    $siguienteOrden = obtenerSiguienteOrdenFase($_POST['fase_id']);
    
    $datos = [
        'fase_id' => (int)$_POST['fase_id'],
        'codigo_paso' => sanitizar($_POST['codigo_paso']),
        'nombre' => sanitizar($_POST['nombre']),
        'descripcion' => sanitizar($_POST['descripcion']),
        'instrucciones' => sanitizar($_POST['instrucciones']),
        'orden_en_fase' => $siguienteOrden,
        'es_critico' => isset($_POST['es_critico']) ? 1 : 0,
        'tiempo_estimado_horas' => (float)($_POST['tiempo_estimado_horas'] ?? 0),
        'activo' => 1
    ];
    
    $plantillaId = insertarRegistro('pasos_plantilla', $datos);
    
    if ($plantillaId) {
        return ['success' => true, 'message' => 'Plantilla de paso creada exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al crear la plantilla de paso'];
    }
}

/**
 * Actualiza una plantilla de paso existente
 * 
 * @return array Resultado del procesamiento
 */
function actualizarPlantillaPaso() {
    $plantillaId = (int)$_POST['plantilla_id'];
    
    if (!$plantillaId) {
        return ['success' => false, 'message' => 'ID de plantilla requerido'];
    }
    
    // Validar datos
    $errores = validarDatosPlantillaPaso($_POST, $plantillaId);
    if (!empty($errores)) {
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    
    $datos = [
        'nombre' => sanitizar($_POST['nombre']),
        'descripcion' => sanitizar($_POST['descripcion']),
        'instrucciones' => sanitizar($_POST['instrucciones']),
        'es_critico' => isset($_POST['es_critico']) ? 1 : 0,
        'tiempo_estimado_horas' => (float)($_POST['tiempo_estimado_horas'] ?? 0)
    ];
    
    $resultado = actualizarRegistro('pasos_plantilla', $plantillaId, $datos);
    
    if ($resultado) {
        return ['success' => true, 'message' => 'Plantilla de paso actualizada exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al actualizar la plantilla de paso'];
    }
}

/**
 * Elimina (desactiva) una plantilla de paso
 * 
 * @return array Resultado del procesamiento
 */
function eliminarPlantillaPaso() {
    $plantillaId = (int)$_POST['plantilla_id'];
    
    if (!$plantillaId) {
        return ['success' => false, 'message' => 'ID de plantilla requerido'];
    }
    
    // Verificar si la plantilla está en uso
    $sql = "SELECT COUNT(*) as total FROM auditoria_pasos WHERE paso_plantilla_id = ?";
    $resultado = obtenerRegistro($sql, [$plantillaId]);
    
    if ($resultado['total'] > 0) {
        // No eliminar, solo desactivar
        $datos = ['activo' => 0];
        $resultado = actualizarRegistro('pasos_plantilla', $plantillaId, $datos);
        
        if ($resultado) {
            return ['success' => true, 'message' => 'Plantilla desactivada (está en uso en auditorías existentes)'];
        } else {
            return ['success' => false, 'message' => 'Error al desactivar la plantilla'];
        }
    } else {
        // Eliminar completamente
        try {
            $pdo = obtenerConexion();
            $stmt = $pdo->prepare("DELETE FROM pasos_plantilla WHERE id = ?");
            $resultado = $stmt->execute([$plantillaId]);
            
            if ($resultado) {
                return ['success' => true, 'message' => 'Plantilla eliminada exitosamente'];
            } else {
                return ['success' => false, 'message' => 'Error al eliminar la plantilla'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error al eliminar la plantilla: ' . $e->getMessage()];
        }
    }
}

/**
 * Procesa la importación de pasos desde archivos
 * 
 * @return array Resultado del procesamiento
 */
function procesarImportacionPasos() {
    $rutaFases = sanitizar($_POST['ruta_fases'] ?? '');
    $limpiarExistentes = isset($_POST['limpiar_existentes']);
    
    if (!$rutaFases) {
        return ['success' => false, 'message' => 'Ruta de fases requerida'];
    }
    
    if (!is_dir($rutaFases)) {
        return ['success' => false, 'message' => 'La ruta especificada no existe o no es un directorio'];
    }
    
    try {
        // Ejecutar script de importación
        $comando = "php " . __DIR__ . "/../import_pasos.php";
        if ($limpiarExistentes) {
            $comando .= " --clean";
        }
        $comando .= " --stats";
        
        // Cambiar directorio de trabajo
        $directorioAnterior = getcwd();
        chdir($rutaFases);
        
        // Ejecutar comando
        $output = [];
        $returnCode = 0;
        exec($comando . " 2>&1", $output, $returnCode);
        
        // Restaurar directorio
        chdir($directorioAnterior);
        
        if ($returnCode === 0) {
            $mensaje = "Importación completada exitosamente:\n" . implode("\n", $output);
            return ['success' => true, 'message' => $mensaje];
        } else {
            $mensaje = "Error en la importación:\n" . implode("\n", $output);
            return ['success' => false, 'message' => $mensaje];
        }
        
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Error ejecutando la importación: ' . $e->getMessage()];
    }
}

/**
 * Obtiene estadísticas de las plantillas actuales
 * 
 * @return array Estadísticas
 */
function obtenerEstadisticasPlantillas() {
    $stats = [];
    
    // Total por fase
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            COUNT(pt.id) as total_pasos,
            SUM(CASE WHEN pt.es_critico = 1 THEN 1 ELSE 0 END) as pasos_criticos,
            AVG(pt.tiempo_estimado_horas) as tiempo_promedio
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id AND pt.activo = 1
        GROUP BY f.id, f.numero_fase, f.nombre
        ORDER BY f.numero_fase
    ";
    $stats['por_fase'] = ejecutarConsulta($sql);
    
    // Estadísticas generales
    $sql = "
        SELECT 
            COUNT(*) as total_plantillas,
            SUM(CASE WHEN es_critico = 1 THEN 1 ELSE 0 END) as criticas,
            SUM(tiempo_estimado_horas) as tiempo_total_estimado,
            AVG(tiempo_estimado_horas) as tiempo_promedio
        FROM pasos_plantilla 
        WHERE activo = 1
    ";
    $stats['general'] = obtenerRegistro($sql);
    
    return $stats;
}

/**
 * Obtiene el siguiente número de orden para una fase
 * 
 * @param int $faseId ID de la fase
 * @return int Siguiente número de orden
 */
function obtenerSiguienteOrdenFase($faseId) {
    $sql = "SELECT COALESCE(MAX(orden_en_fase), 0) + 1 as siguiente_orden 
            FROM pasos_plantilla 
            WHERE fase_id = ? AND activo = 1";
    $resultado = obtenerRegistro($sql, [$faseId]);
    return $resultado['siguiente_orden'] ?? 1;
}

/**
 * Valida los datos de una plantilla de paso
 * 
 * @param array $datos Datos a validar
 * @param int $plantillaId ID de plantilla (para actualizaciones)
 * @return array Errores encontrados
 */
function validarDatosPlantillaPaso($datos, $plantillaId = null) {
    $errores = [];
    
    // Fase requerida (solo para nuevas plantillas)
    if (!$plantillaId && empty($datos['fase_id'])) {
        $errores['fase_id'] = 'La fase es requerida';
    }
    
    // Código de paso requerido (solo para nuevas plantillas)
    if (!$plantillaId && empty($datos['codigo_paso'])) {
        $errores['codigo_paso'] = 'El código de paso es requerido';
    } elseif (!$plantillaId) {
        // Verificar que el código no exista en la misma fase
        $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = ? AND fase_id = ? AND activo = 1";
        $params = [$datos['codigo_paso'], $datos['fase_id']];
        if ($plantillaId) {
            $sql .= " AND id != ?";
            $params[] = $plantillaId;
        }
        $existente = obtenerRegistro($sql, $params);
        if ($existente) {
            $errores['codigo_paso'] = 'Ya existe un paso con este código en la fase';
        }
    }
    
    // Nombre requerido
    if (empty($datos['nombre'])) {
        $errores['nombre'] = 'El nombre es requerido';
    } elseif (strlen($datos['nombre']) > 255) {
        $errores['nombre'] = 'El nombre no puede exceder 255 caracteres';
    }
    
    // Tiempo estimado
    if (!empty($datos['tiempo_estimado_horas']) && 
        (!is_numeric($datos['tiempo_estimado_horas']) || $datos['tiempo_estimado_horas'] < 0)) {
        $errores['tiempo_estimado_horas'] = 'El tiempo estimado debe ser un número positivo';
    }
    
    return $errores;
}

/**
 * Reordena los pasos de una fase
 * 
 * @param int $faseId ID de la fase
 * @param array $nuevoOrden Array con IDs de pasos en el nuevo orden
 * @return bool True si se reordenó correctamente
 */
function reordenarPasosFase($faseId, $nuevoOrden) {
    try {
        $pdo = obtenerConexion();
        $pdo->beginTransaction();
        
        foreach ($nuevoOrden as $orden => $pasoId) {
            $sql = "UPDATE pasos_plantilla SET orden_en_fase = ? WHERE id = ? AND fase_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$orden + 1, $pasoId, $faseId]);
        }
        
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollback();
        registrarError("Error reordenando pasos: " . $e->getMessage());
        return false;
    }
}

?>