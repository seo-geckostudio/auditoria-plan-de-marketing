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
    
    // Obtener datos de la auditoría
    $auditoria = obtenerAuditoria($auditoriaId);
    
    // Obtener pasos organizados por fase
    $fases = obtenerPasosPorFase($auditoriaId);
    
    // Obtener archivos de la auditoría
    $archivos = obtenerArchivosAuditoria($auditoriaId);
    
    // Obtener comentarios
    $comentarios = obtenerComentariosAuditoria($auditoriaId);
    
    // Obtener historial de cambios
    $historial = obtenerHistorialAuditoria($auditoriaId);
    
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

?>