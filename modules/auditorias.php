<?php
/**
 * MÓDULO DE AUDITORÍAS
 * ====================
 * 
 * Módulo principal para la gestión de auditorías SEO
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
 * Controlador principal del módulo de auditorías
 */
function manejarAuditorias() {
    $accion = $_GET['accion'] ?? 'listar';
    
    switch ($accion) {
        case 'listar':
            mostrarListaAuditorias();
            break;
        case 'ver':
            mostrarDetalleAuditoria();
            break;
        case 'crear':
            mostrarFormularioCrear();
            break;
        case 'editar':
            mostrarFormularioEditar();
            break;
        case 'dashboard':
            mostrarDashboard();
            break;
        case 'seleccionar_metodo':
            mostrarSelectorMetodo();
            break;
        case 'formulario':
            mostrarFormularioPaso();
            break;
        case 'upload':
            mostrarUploadArchivo();
            break;
        case 'importar_csv':
            mostrarImportarCSV();
            break;
        case 'eliminar':
            procesarEliminarAuditoria();
            break;
        case 'procesar_eliminar':
            confirmarEliminarAuditoria();
            break;
        default:
            mostrarListaAuditorias();
    }
}

// =====================================================
// VISTAS DE AUDITORÍAS
// =====================================================

/**
 * Muestra la lista de auditorías con filtros
 */
function mostrarListaAuditorias() {
    // Obtener filtros
    $filtros = [
        'estado' => $_GET['estado'] ?? '',
        'cliente_id' => $_GET['cliente_id'] ?? '',
        'usuario_id' => $_GET['usuario_id'] ?? ''
    ];
    
    // Obtener auditorías
    $auditorias = obtenerAuditorias($filtros);
    
    // Obtener datos para filtros
    $clientes = obtenerOpcionesClientes();
    $usuarios = obtenerOpcionesUsuarios();
    
    include __DIR__ . '/../views/auditorias/lista.php';
}

/**
 * Muestra el detalle completo de una auditoría
 */
function mostrarDetalleAuditoria() {
    $auditoriaId = (int)($_GET['id'] ?? 0);

    // La validación de ID y existencia ahora se hace en index.php
    // Solo obtener los datos necesarios para la vista

    // Obtener datos de la auditoría (función temporal)
    $auditoria = obtenerRegistro("SELECT * FROM auditorias WHERE id = ?", [$auditoriaId]);
    
    // Obtener pasos organizados por fase
    $fases = obtenerPasosPorFase($auditoriaId);
    
    // Obtener archivos de la auditoría (función temporal)
    $archivos = ejecutarConsulta("SELECT * FROM archivos WHERE auditoria_id = ?", [$auditoriaId]) ?: [];

    // Obtener comentarios (función temporal)
    $comentarios = [];

    // Obtener historial de cambios (función temporal)
    $historial = [];
    
    include __DIR__ . '/../views/auditorias/detalle.php';
}

/**
 * Muestra el formulario para crear una nueva auditoría
 */
function mostrarFormularioCrear() {
    // El procesamiento POST ahora se hace en index.php antes del HTML
    // Solo mostrar errores si existen en la sesión
    $error = $_SESSION['form_error'] ?? null;
    $errores = $_SESSION['form_errores'] ?? [];
    
    // Limpiar errores de la sesión después de mostrarlos
    unset($_SESSION['form_error'], $_SESSION['form_errores']);
    
    // Obtener datos para el formulario
    $clientes = obtenerOpcionesClientes();
    $usuarios = obtenerOpcionesUsuarios();
    $fases = obtenerOpcionesFases();
    
    include __DIR__ . '/../views/auditorias/crear.php';
}

/**
 * Muestra el formulario para editar una auditoría
 */
function mostrarFormularioEditar() {
    $auditoriaId = (int)($_GET['id'] ?? 0);
    
    if (!$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Obtener datos de la auditoría
    $auditoria = obtenerAuditoria($auditoriaId);
    if (!$auditoria) {
        header('Location: ?modulo=auditorias&accion=listar&error=no_encontrada');
        exit;
    }
    
    // Procesar formulario si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultado = procesarFormulario();
        if ($resultado['success']) {
            header('Location: ?modulo=auditorias&accion=ver&id=' . $auditoriaId);
            exit;
        } else {
            $error = $resultado['message'];
            $errores = $resultado['errores'] ?? [];
        }
    }
    
    // Obtener datos para el formulario
    $clientes = obtenerOpcionesClientes();
    $usuarios = obtenerOpcionesUsuarios();
    
    include __DIR__ . '/../views/auditorias/editar.php';
}

/**
 * Muestra el dashboard con estadísticas generales
 */
function mostrarDashboard() {
    // Obtener estadísticas
    $stats = obtenerEstadisticas();
    
    // Auditorías recientes
    $auditoriasRecientes = obtenerAuditorias(['limit' => 5]);
    
    // Pasos pendientes críticos
    $pasosCriticos = obtenerPasosCriticosPendientes();
    
    // Actividad reciente
    $actividadReciente = obtenerActividadReciente();
    
    include __DIR__ . '/../views/auditorias/dashboard.php';
}

// =====================================================
// FUNCIONES AUXILIARES ESPECÍFICAS
// =====================================================

/**
 * Obtiene los archivos de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Lista de archivos
 */
function obtenerArchivosAuditoria($auditoriaId) {
    $sql = "
        SELECT 
            a.*,
            ap.id as auditoria_paso_id,
            pt.codigo_paso,
            pt.nombre as paso_nombre,
            u.nombre as subido_por
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        JOIN usuarios u ON a.subido_por_usuario_id = u.id
        WHERE ap.auditoria_id = ?
        ORDER BY a.fecha_subida DESC
    ";
    
    return ejecutarConsulta($sql, [$auditoriaId]);
}

/**
 * Obtiene los comentarios de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Lista de comentarios
 */
function obtenerComentariosAuditoria($auditoriaId) {
    $sql = "
        SELECT 
            c.*,
            u.nombre as usuario_nombre,
            pt.codigo_paso,
            pt.nombre as paso_nombre
        FROM comentarios c
        JOIN usuarios u ON c.usuario_id = u.id
        LEFT JOIN auditoria_pasos ap ON c.auditoria_paso_id = ap.id
        LEFT JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        WHERE c.auditoria_id = ?
        ORDER BY c.fecha_comentario DESC
    ";
    
    return ejecutarConsulta($sql, [$auditoriaId]);
}

/**
 * Obtiene el historial de cambios de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param int $limite Límite de registros
 * @return array Lista de cambios
 */
function obtenerHistorialAuditoria($auditoriaId, $limite = 20) {
    $sql = "
        SELECT 
            h.*,
            u.nombre as usuario_nombre
        FROM historial_cambios h
        JOIN usuarios u ON h.usuario_id = u.id
        WHERE h.auditoria_id = ?
        ORDER BY h.fecha_cambio DESC
        LIMIT ?
    ";
    
    return ejecutarConsulta($sql, [$auditoriaId, $limite]);
}





/**
 * Calcula estadísticas específicas de auditorías
 * 
 * @return array Estadísticas calculadas
 */
function obtenerEstadisticasAuditorias() {
    $stats = [];
    
    // Auditorías por estado
    $sql = "
        SELECT 
            estado,
            COUNT(*) as total,
            AVG(porcentaje_completado) as promedio_completado
        FROM auditorias 
        GROUP BY estado
    ";
    $stats['por_estado'] = ejecutarConsulta($sql);
    
    // Progreso promedio por fase
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            COUNT(ap.id) as total_pasos,
            SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados,
            ROUND(
                (SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) * 100.0) / COUNT(ap.id), 
                2
            ) as porcentaje_completado
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
        LEFT JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id
        WHERE pt.activo = 1
        GROUP BY f.id, f.numero_fase, f.nombre
        ORDER BY f.numero_fase
    ";
    $stats['por_fase'] = ejecutarConsulta($sql);
    
    // Tiempo promedio por fase (auditorías completadas)
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            AVG(DATEDIFF(ap.fecha_completado, ap.fecha_inicio)) as dias_promedio
        FROM fases f
        JOIN pasos_plantilla pt ON f.id = pt.fase_id
        JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id
        WHERE ap.estado = 'completado' 
        AND ap.fecha_inicio IS NOT NULL 
        AND ap.fecha_completado IS NOT NULL
        GROUP BY f.id, f.numero_fase, f.nombre
        ORDER BY f.numero_fase
    ";
    $stats['tiempo_por_fase'] = ejecutarConsulta($sql);
    
    return $stats;
}

/**
 * Exporta datos de una auditoría a CSV
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return bool True si se exportó correctamente
 */
function exportarAuditoriaCSV($auditoriaId) {
    $auditoria = obtenerAuditoria($auditoriaId);
    if (!$auditoria) {
        return false;
    }
    
    $fases = obtenerPasosPorFase($auditoriaId);
    
    // Configurar headers para descarga
    $filename = "auditoria_{$auditoriaId}_" . date('Y-m-d') . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    // Crear archivo CSV
    $output = fopen('php://output', 'w');
    
    // BOM para UTF-8
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Encabezados
    fputcsv($output, [
        'Fase',
        'Código Paso',
        'Nombre Paso',
        'Estado',
        'Es Crítico',
        'Fecha Inicio',
        'Fecha Completado',
        'Notas',
        'Archivos'
    ]);
    
    // Datos
    foreach ($fases as $fase) {
        foreach ($fase['pasos'] as $paso) {
            fputcsv($output, [
                $fase['nombre'],
                $paso['codigo_paso'],
                $paso['paso_nombre'],
                obtenerNombreEstado($paso['estado'], 'paso'),
                $paso['es_critico'] ? 'Sí' : 'No',
                formatearFecha($paso['fecha_inicio'], true),
                formatearFecha($paso['fecha_completado'], true),
                $paso['notas'],
                $paso['total_archivos']
            ]);
        }
    }
    
    fclose($output);
    return true;
}

/**
 * Duplica una auditoría existente
 * 
 * @param int $auditoriaId ID de la auditoría a duplicar
 * @param array $nuevosDatos Nuevos datos para la auditoría duplicada
 * @return int|false ID de la nueva auditoría o false en caso de error
 */
function duplicarAuditoria($auditoriaId, $nuevosDatos) {
    $auditoriaOriginal = obtenerAuditoria($auditoriaId);
    if (!$auditoriaOriginal) {
        return false;
    }
    
    // Preparar datos para la nueva auditoría
    $datosNuevaAuditoria = [
        'cliente_id' => $nuevosDatos['cliente_id'] ?? $auditoriaOriginal['cliente_id'],
        'usuario_id' => $nuevosDatos['usuario_id'] ?? $auditoriaOriginal['usuario_id'],
        'titulo' => $nuevosDatos['titulo'] ?? $auditoriaOriginal['titulo'] . ' (Copia)',
        'descripcion' => $auditoriaOriginal['descripcion'],
        'fecha_inicio' => $nuevosDatos['fecha_inicio'] ?? date('Y-m-d'),
        'fecha_fin_estimada' => $nuevosDatos['fecha_fin_estimada'] ?? null,
        'estado' => 'planificada',
        'prioridad' => $auditoriaOriginal['prioridad'] ?? 'media',
        'porcentaje_completado' => 0.00,
        'configuracion_json' => $auditoriaOriginal['configuracion_json']
    ];
    
    // Crear nueva auditoría
    $nuevaAuditoriaId = crearAuditoria($datosNuevaAuditoria);
    
    if ($nuevaAuditoriaId) {
        // Copiar pasos
        $sql = "
            INSERT INTO auditoria_pasos (auditoria_id, paso_plantilla_id, estado, notas)
            SELECT ?, paso_plantilla_id, 'pendiente', ''
            FROM auditoria_pasos
            WHERE auditoria_id = ?
        ";
        
        try {
            $pdo = obtenerConexion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nuevaAuditoriaId, $auditoriaId]);
            
            return $nuevaAuditoriaId;
        } catch (PDOException $e) {
            registrarError("Error duplicando auditoría: " . $e->getMessage());
            return false;
        }
    }
    
    return false;
}

// =====================================================
// NUEVAS FUNCIONES PARA FORMULARIOS DINÁMICOS
// =====================================================

/**
 * Muestra el selector de método de entrada para un paso
 */
function mostrarSelectorMetodo() {
    include __DIR__ . '/../views/auditorias/seleccionar_metodo.php';
}

/**
 * Muestra el formulario dinámico para un paso específico
 */
function mostrarFormularioPaso() {
    include __DIR__ . '/../views/auditorias/formulario_paso.php';
}

/**
 * Muestra la interfaz de upload de archivos (usar la existente)
 */
function mostrarUploadArchivo() {
    // Redirigir a la funcionalidad existente de upload
    include __DIR__ . '/../views/auditorias/upload_file.php';
}

/**
 * Muestra la interfaz de importación CSV (próximamente)
 */
function mostrarImportarCSV() {
    // TODO: Implementar en próxima iteración
    echo '<div class="alert alert-info">Funcionalidad de importar CSV - próximamente</div>';
    echo '<a href="javascript:history.back()" class="btn btn-secondary">Volver</a>';
}

/**
 * Procesa la solicitud de eliminar una auditoría
 */
function procesarEliminarAuditoria() {
    // Debug logging para procesarEliminarAuditoria
    $log_file = __DIR__ . '/../delete_debug.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "\n[$timestamp] ==> procesarEliminarAuditoria() INICIADA\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] REQUEST_METHOD: " . ($_SERVER['REQUEST_METHOD'] ?? 'undefined') . "\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] GET data: " . print_r($_GET, true) . "\n", FILE_APPEND);

    $auditoria_id = (int)($_GET['id'] ?? 0);
    file_put_contents($log_file, "[$timestamp] Auditoria ID extraído de GET: $auditoria_id\n", FILE_APPEND);

    if (!$auditoria_id) {
        file_put_contents($log_file, "[$timestamp] ERROR: ID inválido en procesarEliminarAuditoria\n", FILE_APPEND);
        header('Location: ?modulo=auditorias&accion=listar&error=id_invalido');
        exit;
    }

    // Verificar que la auditoría existe
    $auditoria = obtenerAuditoria($auditoria_id);
    if (!$auditoria) {
        file_put_contents($log_file, "[$timestamp] ERROR: Auditoría no encontrada en procesarEliminarAuditoria\n", FILE_APPEND);
        header('Location: ?modulo=auditorias&accion=listar&error=no_encontrada');
        exit;
    }

    file_put_contents($log_file, "[$timestamp] Auditoría encontrada: " . $auditoria['titulo'] . "\n", FILE_APPEND);

    // Si es confirmación POST, proceder con eliminación
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
        file_put_contents($log_file, "[$timestamp] ✅ POST detectado con confirmar, llamando a confirmarEliminarAuditoria()\n", FILE_APPEND);
        confirmarEliminarAuditoria();
        file_put_contents($log_file, "[$timestamp] ⚠️ REGRESÓ de confirmarEliminarAuditoria() - esto NO debería pasar\n", FILE_APPEND);
        return;
    } else {
        $has_post = $_SERVER['REQUEST_METHOD'] === 'POST';
        $has_confirmar = isset($_POST['confirmar']);
        file_put_contents($log_file, "[$timestamp] ❌ POST NO detectado - METHOD=" . ($_SERVER['REQUEST_METHOD'] ?? 'undefined') . ", confirmar=$has_confirmar\n", FILE_APPEND);
    }

    // Mostrar página de confirmación
    file_put_contents($log_file, "[$timestamp] Mostrando página de confirmación\n", FILE_APPEND);
    include __DIR__ . '/../views/auditorias/confirmar_eliminar.php';
}

/**
 * Confirma y ejecuta la eliminación de la auditoría
 */
function confirmarEliminarAuditoria() {
    $auditoria_id = (int)($_POST['auditoria_id'] ?? $_GET['id'] ?? 0);

    // Debug logging detallado
    $log_file = __DIR__ . '/../delete_debug.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] ==> confirmarEliminarAuditoria() INICIADA\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] GET data: " . print_r($_GET, true) . "\n", FILE_APPEND);
    file_put_contents($log_file, "[$timestamp] Auditoria ID extraído: $auditoria_id\n", FILE_APPEND);

    if (!$auditoria_id) {
        file_put_contents($log_file, "[$timestamp] ERROR: ID inválido, redirigiendo\n", FILE_APPEND);
        header('Location: ?modulo=auditorias&accion=listar&error=id_invalido');
        exit;
    }

    try {
        file_put_contents($log_file, "[$timestamp] Conectando a base de datos...\n", FILE_APPEND);
        $pdo = obtenerConexion();
        file_put_contents($log_file, "[$timestamp] Conexión exitosa, iniciando transacción...\n", FILE_APPEND);
        $pdo->beginTransaction();

        // Eliminar en orden: datos dependientes primero

        // 1. Eliminar datos de formularios (compatible con SQLite)
        $sql = "DELETE FROM paso_datos
                WHERE auditoria_paso_id IN (
                    SELECT id FROM auditoria_pasos WHERE auditoria_id = ?
                )";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 2. Eliminar datos CSV (compatible con SQLite)
        $sql = "DELETE FROM csv_datos
                WHERE auditoria_paso_id IN (
                    SELECT id FROM auditoria_pasos WHERE auditoria_id = ?
                )";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 3. Eliminar archivos (compatible con SQLite)
        $sql = "DELETE FROM archivos
                WHERE auditoria_paso_id IN (
                    SELECT id FROM auditoria_pasos WHERE auditoria_id = ?
                )";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 4. Eliminar comentarios (compatible con SQLite)
        $sql = "DELETE FROM comentarios
                WHERE auditoria_paso_id IN (
                    SELECT id FROM auditoria_pasos WHERE auditoria_id = ?
                )";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 5. Eliminar historial
        $sql = "DELETE FROM historial_cambios WHERE auditoria_id = ?";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 6. Eliminar pasos de auditoría
        $sql = "DELETE FROM auditoria_pasos WHERE auditoria_id = ?";
        $pdo->prepare($sql)->execute([$auditoria_id]);

        // 7. Finalmente, eliminar la auditoría
        $sql = "DELETE FROM auditorias WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([$auditoria_id]);

        if ($resultado && $stmt->rowCount() > 0) {
            file_put_contents($log_file, "[$timestamp] ✅ ELIMINACIÓN EXITOSA - rowCount: " . $stmt->rowCount() . "\n", FILE_APPEND);
            $pdo->commit();
            file_put_contents($log_file, "[$timestamp] ✅ COMMIT realizado\n", FILE_APPEND);
            mostrarNotificacionSegura('Auditoría eliminada correctamente', 'success');
            file_put_contents($log_file, "[$timestamp] ✅ Notificación añadida, redirigiendo...\n", FILE_APPEND);
            header('Location: ?modulo=auditorias&accion=listar&success=eliminado');
            file_put_contents($log_file, "[$timestamp] ✅ REDIRECT enviado, saliendo...\n", FILE_APPEND);
            exit;
        } else {
            file_put_contents($log_file, "[$timestamp] ❌ FALLO: resultado=$resultado, rowCount=" . $stmt->rowCount() . "\n", FILE_APPEND);
            throw new Exception('No se pudo eliminar la auditoría');
        }

    } catch (Exception $e) {
        file_put_contents($log_file, "[$timestamp] ❌ EXCEPCIÓN: " . $e->getMessage() . "\n", FILE_APPEND);
        file_put_contents($log_file, "[$timestamp] ❌ Archivo: " . $e->getFile() . " línea " . $e->getLine() . "\n", FILE_APPEND);

        if (isset($pdo)) {
            $pdo->rollback();
            file_put_contents($log_file, "[$timestamp] ❌ ROLLBACK ejecutado\n", FILE_APPEND);
        }

        // Intentar registrar error si la función existe
        if (function_exists('registrarError')) {
            registrarError("Error eliminando auditoría: " . $e->getMessage());
        }

        mostrarNotificacionSegura('Error al eliminar la auditoría: ' . $e->getMessage(), 'error');
        file_put_contents($log_file, "[$timestamp] ❌ Redirigiendo con error...\n", FILE_APPEND);
        header('Location: ?modulo=auditorias&accion=listar&error=eliminacion_fallida');
        exit;
    }
}

?>