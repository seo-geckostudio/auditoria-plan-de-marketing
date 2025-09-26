<?php
/**
 * MÓDULO DE ARCHIVOS
 * ==================
 * 
 * Módulo para la gestión de archivos en auditorías SEO
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
 * Controlador principal del módulo de archivos
 */
function manejarArchivos() {
    $accion = $_GET['accion'] ?? 'listar';
    
    switch ($accion) {
        case 'listar':
            mostrarListaArchivos();
            break;
        case 'subir':
            procesarSubidaArchivo();
            break;
        case 'descargar':
            descargarArchivo();
            break;
        case 'eliminar':
            eliminarArchivo();
            break;
        case 'ver':
            verArchivo();
            break;
        case 'galeria':
            mostrarGaleriaArchivos();
            break;
        default:
            mostrarListaArchivos();
    }
}

// =====================================================
// VISTAS DE ARCHIVOS
// =====================================================

/**
 * Muestra la lista de archivos de una auditoría
 */
function mostrarListaArchivos() {
    $auditoriaId = (int)($_GET['auditoria_id'] ?? 0);
    $pasoId = (int)($_GET['paso_id'] ?? 0);
    
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
    
    // Obtener archivos
    if ($pasoId) {
        $archivos = obtenerArchivosPaso($pasoId);
        $paso = obtenerDetallePaso($pasoId, $auditoriaId);
    } else {
        $archivos = obtenerArchivosAuditoria($auditoriaId);
        $paso = null;
    }
    
    // Obtener estadísticas de archivos
    $estadisticas = obtenerEstadisticasArchivos($auditoriaId);
    
    include __DIR__ . '/../views/archivos/lista.php';
}

/**
 * Procesa la subida de archivos via AJAX
 */
function procesarSubidaArchivo() {
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
 * Descarga un archivo específico
 */
function descargarArchivo() {
    $archivoId = (int)($_GET['id'] ?? 0);
    
    if (!$archivoId) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Obtener información del archivo
    $archivo = obtenerInformacionArchivo($archivoId);
    if (!$archivo) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Verificar que el archivo existe físicamente
    if (!file_exists($archivo['ruta_archivo'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Registrar descarga
    registrarDescargaArchivo($archivoId, $_SESSION['usuario_id'] ?? 1);
    
    // Configurar headers para descarga
    header('Content-Type: ' . $archivo['tipo_mime']);
    header('Content-Disposition: attachment; filename="' . $archivo['nombre_original'] . '"');
    header('Content-Length: ' . $archivo['tamaño_bytes']);
    header('Cache-Control: no-cache, must-revalidate');
    
    // Enviar archivo
    readfile($archivo['ruta_archivo']);
    exit;
}

/**
 * Elimina un archivo (lógicamente)
 */
function eliminarArchivo() {
    $archivoId = (int)($_GET['id'] ?? 0);
    $auditoriaId = (int)($_GET['auditoria_id'] ?? 0);
    
    if (!$archivoId || !$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Verificar permisos y obtener información del archivo
    $archivo = obtenerInformacionArchivo($archivoId);
    if (!$archivo || $archivo['auditoria_id'] != $auditoriaId) {
        header('Location: ?modulo=archivos&accion=listar&auditoria_id=' . $auditoriaId . '&error=no_encontrado');
        exit;
    }
    
    // Procesar eliminación si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && verificarTokenCSRF($_POST['csrf_token'] ?? '')) {
        $resultado = eliminarArchivoLogicamente($archivoId, $_SESSION['usuario_id'] ?? 1);
        
        if ($resultado) {
            header('Location: ?modulo=archivos&accion=listar&auditoria_id=' . $auditoriaId . '&success=eliminado');
        } else {
            header('Location: ?modulo=archivos&accion=listar&auditoria_id=' . $auditoriaId . '&error=no_eliminado');
        }
        exit;
    }
    
    include __DIR__ . '/../views/archivos/eliminar.php';
}

/**
 * Muestra un archivo (si es imagen o PDF)
 */
function verArchivo() {
    $archivoId = (int)($_GET['id'] ?? 0);
    
    if (!$archivoId) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Obtener información del archivo
    $archivo = obtenerInformacionArchivo($archivoId);
    if (!$archivo) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Verificar que el archivo existe físicamente
    if (!file_exists($archivo['ruta_archivo'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    
    // Verificar que es un tipo de archivo visualizable
    $tiposVisualizables = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];
    if (!in_array($archivo['tipo_mime'], $tiposVisualizables)) {
        // Redirigir a descarga
        header('Location: ?modulo=archivos&accion=descargar&id=' . $archivoId);
        exit;
    }
    
    // Registrar visualización
    registrarVisualizacionArchivo($archivoId, $_SESSION['usuario_id'] ?? 1);
    
    // Configurar headers para visualización
    header('Content-Type: ' . $archivo['tipo_mime']);
    header('Content-Length: ' . $archivo['tamaño_bytes']);
    header('Cache-Control: public, max-age=3600');
    
    // Enviar archivo
    readfile($archivo['ruta_archivo']);
    exit;
}

/**
 * Muestra una galería de archivos de imagen
 */
function mostrarGaleriaArchivos() {
    $auditoriaId = (int)($_GET['auditoria_id'] ?? 0);
    
    if (!$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Obtener solo archivos de imagen
    $imagenes = obtenerImagenesAuditoria($auditoriaId);
    
    // Obtener información de la auditoría
    $auditoria = obtenerAuditoria($auditoriaId);
    
    include __DIR__ . '/../views/archivos/galeria.php';
}

// =====================================================
// FUNCIONES ESPECÍFICAS DE ARCHIVOS
// =====================================================

/**
 * Obtiene información completa de un archivo
 * 
 * @param int $archivoId ID del archivo
 * @return array|false Información del archivo
 */
function obtenerInformacionArchivo($archivoId) {
    $sql = "
        SELECT 
            a.*,
            ap.auditoria_id,
            pt.codigo_paso,
            pt.nombre as paso_nombre,
            au.nombre as auditoria_nombre,
            c.nombre as cliente_nombre,
            u.nombre as subido_por
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        JOIN auditorias au ON ap.auditoria_id = au.id
        JOIN clientes c ON au.cliente_id = c.id
        JOIN usuarios u ON a.subido_por_usuario_id = u.id
        WHERE a.id = ? AND a.eliminado = 0
    ";
    
    return obtenerRegistro($sql, [$archivoId]);
}

/**
 * Obtiene estadísticas de archivos para una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Estadísticas
 */
function obtenerEstadisticasArchivos($auditoriaId) {
    $stats = [];
    
    // Estadísticas generales
    $sql = "
        SELECT 
            COUNT(*) as total_archivos,
            SUM(tamaño_bytes) as tamaño_total,
            AVG(tamaño_bytes) as tamaño_promedio,
            COUNT(DISTINCT a.auditoria_paso_id) as pasos_con_archivos
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        WHERE ap.auditoria_id = ? AND a.eliminado = 0
    ";
    $stats['general'] = obtenerRegistro($sql, [$auditoriaId]);
    
    // Por tipo de archivo
    $sql = "
        SELECT 
            CASE 
                WHEN tipo_mime LIKE 'image/%' THEN 'Imágenes'
                WHEN tipo_mime LIKE 'application/pdf' THEN 'PDF'
                WHEN tipo_mime LIKE 'application/vnd.ms-excel%' OR tipo_mime LIKE 'application/vnd.openxmlformats-officedocument.spreadsheetml%' THEN 'Excel'
                WHEN tipo_mime LIKE 'application/msword%' OR tipo_mime LIKE 'application/vnd.openxmlformats-officedocument.wordprocessingml%' THEN 'Word'
                WHEN tipo_mime LIKE 'text/%' THEN 'Texto'
                ELSE 'Otros'
            END as tipo_categoria,
            COUNT(*) as cantidad,
            SUM(tamaño_bytes) as tamaño_total
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        WHERE ap.auditoria_id = ? AND a.eliminado = 0
        GROUP BY tipo_categoria
        ORDER BY cantidad DESC
    ";
    $stats['por_tipo'] = ejecutarConsulta($sql, [$auditoriaId]);
    
    // Por fase
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            COUNT(a.id) as total_archivos,
            SUM(a.tamaño_bytes) as tamaño_total
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
        LEFT JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id AND ap.auditoria_id = ?
        LEFT JOIN archivos a ON ap.id = a.auditoria_paso_id AND a.eliminado = 0
        GROUP BY f.id, f.numero_fase, f.nombre
        HAVING total_archivos > 0
        ORDER BY f.numero_fase
    ";
    $stats['por_fase'] = ejecutarConsulta($sql, [$auditoriaId]);
    
    return $stats;
}

/**
 * Obtiene solo las imágenes de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Lista de imágenes
 */
function obtenerImagenesAuditoria($auditoriaId) {
    $sql = "
        SELECT 
            a.*,
            pt.codigo_paso,
            pt.nombre as paso_nombre,
            f.numero_fase,
            f.nombre as fase_nombre
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        JOIN fases f ON pt.fase_id = f.id
        WHERE ap.auditoria_id = ? 
        AND a.eliminado = 0
        AND a.tipo_mime LIKE 'image/%'
        ORDER BY f.numero_fase, pt.orden_en_fase, a.fecha_subida DESC
    ";
    
    return ejecutarConsulta($sql, [$auditoriaId]);
}

/**
 * Elimina un archivo lógicamente (marca como eliminado)
 * 
 * @param int $archivoId ID del archivo
 * @param int $usuarioId ID del usuario que elimina
 * @return bool True si se eliminó correctamente
 */
function eliminarArchivoLogicamente($archivoId, $usuarioId) {
    // Obtener información del archivo antes de eliminarlo
    $archivo = obtenerInformacionArchivo($archivoId);
    if (!$archivo) {
        return false;
    }
    
    // Marcar como eliminado
    $datos = [
        'eliminado' => 1,
        'fecha_eliminado' => date('Y-m-d H:i:s'),
        'eliminado_por_usuario_id' => $usuarioId
    ];
    
    $resultado = actualizarRegistro('archivos', $archivoId, $datos);
    
    if ($resultado) {
        // Registrar en historial
        registrarCambio($archivo['auditoria_id'], $usuarioId, 'archivo_eliminado', 
                       "Archivo eliminado: {$archivo['nombre_original']}");
        return true;
    }
    
    return false;
}

/**
 * Registra una descarga de archivo
 * 
 * @param int $archivoId ID del archivo
 * @param int $usuarioId ID del usuario
 */
function registrarDescargaArchivo($archivoId, $usuarioId) {
    $sql = "UPDATE archivos SET descargas = descargas + 1, ultima_descarga = NOW() WHERE id = ?";
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$archivoId]);
    } catch (PDOException $e) {
        registrarError("Error registrando descarga: " . $e->getMessage());
    }
}

/**
 * Registra una visualización de archivo
 * 
 * @param int $archivoId ID del archivo
 * @param int $usuarioId ID del usuario
 */
function registrarVisualizacionArchivo($archivoId, $usuarioId) {
    $sql = "UPDATE archivos SET visualizaciones = visualizaciones + 1, ultima_visualizacion = NOW() WHERE id = ?";
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$archivoId]);
    } catch (PDOException $e) {
        registrarError("Error registrando visualización: " . $e->getMessage());
    }
}

/**
 * Genera una miniatura para una imagen
 * 
 * @param string $rutaOriginal Ruta del archivo original
 * @param string $rutaMiniatura Ruta donde guardar la miniatura
 * @param int $ancho Ancho máximo de la miniatura
 * @param int $alto Alto máximo de la miniatura
 * @return bool True si se generó correctamente
 */
function generarMiniatura($rutaOriginal, $rutaMiniatura, $ancho = 200, $alto = 200) {
    if (!extension_loaded('gd')) {
        return false;
    }
    
    // Obtener información de la imagen
    $info = getimagesize($rutaOriginal);
    if (!$info) {
        return false;
    }
    
    $tipoMime = $info['mime'];
    $anchoOriginal = $info[0];
    $altoOriginal = $info[1];
    
    // Crear imagen desde el archivo original
    switch ($tipoMime) {
        case 'image/jpeg':
            $imagenOriginal = imagecreatefromjpeg($rutaOriginal);
            break;
        case 'image/png':
            $imagenOriginal = imagecreatefrompng($rutaOriginal);
            break;
        case 'image/gif':
            $imagenOriginal = imagecreatefromgif($rutaOriginal);
            break;
        default:
            return false;
    }
    
    if (!$imagenOriginal) {
        return false;
    }
    
    // Calcular nuevas dimensiones manteniendo proporción
    $ratio = min($ancho / $anchoOriginal, $alto / $altoOriginal);
    $nuevoAncho = (int)($anchoOriginal * $ratio);
    $nuevoAlto = (int)($altoOriginal * $ratio);
    
    // Crear nueva imagen
    $miniatura = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    
    // Preservar transparencia para PNG y GIF
    if ($tipoMime === 'image/png' || $tipoMime === 'image/gif') {
        imagealphablending($miniatura, false);
        imagesavealpha($miniatura, true);
        $transparente = imagecolorallocatealpha($miniatura, 255, 255, 255, 127);
        imagefill($miniatura, 0, 0, $transparente);
    }
    
    // Redimensionar
    imagecopyresampled($miniatura, $imagenOriginal, 0, 0, 0, 0, 
                      $nuevoAncho, $nuevoAlto, $anchoOriginal, $altoOriginal);
    
    // Guardar miniatura
    $resultado = false;
    switch ($tipoMime) {
        case 'image/jpeg':
            $resultado = imagejpeg($miniatura, $rutaMiniatura, 85);
            break;
        case 'image/png':
            $resultado = imagepng($miniatura, $rutaMiniatura, 8);
            break;
        case 'image/gif':
            $resultado = imagegif($miniatura, $rutaMiniatura);
            break;
    }
    
    // Limpiar memoria
    imagedestroy($imagenOriginal);
    imagedestroy($miniatura);
    
    return $resultado;
}

/**
 * Limpia archivos huérfanos (eliminados lógicamente hace más de X días)
 * 
 * @param int $diasAntiguedad Días de antigüedad para considerar limpieza
 * @return array Resultado de la limpieza
 */
function limpiarArchivosHuerfanos($diasAntiguedad = 30) {
    $sql = "
        SELECT id, ruta_archivo, nombre_original
        FROM archivos 
        WHERE eliminado = 1 
        AND fecha_eliminado < DATE_SUB(NOW(), INTERVAL ? DAY)
    ";
    
    $archivosAEliminar = ejecutarConsulta($sql, [$diasAntiguedad]);
    $eliminados = 0;
    $errores = [];
    
    foreach ($archivosAEliminar as $archivo) {
        // Eliminar archivo físico
        if (file_exists($archivo['ruta_archivo'])) {
            if (unlink($archivo['ruta_archivo'])) {
                // Eliminar registro de la base de datos
                try {
                    $pdo = obtenerConexion();
                    $stmt = $pdo->prepare("DELETE FROM archivos WHERE id = ?");
                    $stmt->execute([$archivo['id']]);
                    $eliminados++;
                } catch (PDOException $e) {
                    $errores[] = "Error eliminando registro {$archivo['id']}: " . $e->getMessage();
                }
            } else {
                $errores[] = "No se pudo eliminar el archivo físico: {$archivo['ruta_archivo']}";
            }
        } else {
            // El archivo físico no existe, eliminar solo el registro
            try {
                $pdo = obtenerConexion();
                $stmt = $pdo->prepare("DELETE FROM archivos WHERE id = ?");
                $stmt->execute([$archivo['id']]);
                $eliminados++;
            } catch (PDOException $e) {
                $errores[] = "Error eliminando registro huérfano {$archivo['id']}: " . $e->getMessage();
            }
        }
    }
    
    return [
        'total_candidatos' => count($archivosAEliminar),
        'eliminados' => $eliminados,
        'errores' => $errores
    ];
}

/**
 * Obtiene el uso de espacio en disco por auditoría
 * 
 * @return array Estadísticas de uso de espacio
 */
function obtenerUsoEspacioDisco() {
    $sql = "
        SELECT 
            a.id as auditoria_id,
            a.titulo as auditoria_nombre,
            c.nombre as cliente_nombre,
            COUNT(ar.id) as total_archivos,
            SUM(ar.tamaño_bytes) as espacio_usado,
            MAX(ar.fecha_subida) as ultimo_archivo
        FROM auditorias a
        JOIN clientes c ON a.cliente_id = c.id
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        LEFT JOIN archivos ar ON ap.id = ar.auditoria_paso_id AND ar.eliminado = 0
        GROUP BY a.id, a.titulo, c.nombre
        HAVING total_archivos > 0
        ORDER BY espacio_usado DESC
    ";
    
    return ejecutarConsulta($sql);
}

/**
 * Valida un archivo antes de la subida
 * 
 * @param array $archivo Datos del archivo ($_FILES)
 * @return array Resultado de la validación
 */
function validarArchivoDetallado($archivo) {
    $errores = [];
    
    // Verificar errores de subida
    switch ($archivo['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $errores[] = 'El archivo es demasiado grande';
            break;
        case UPLOAD_ERR_PARTIAL:
            $errores[] = 'El archivo se subió parcialmente';
            break;
        case UPLOAD_ERR_NO_FILE:
            $errores[] = 'No se seleccionó ningún archivo';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $errores[] = 'Falta directorio temporal';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $errores[] = 'Error escribiendo el archivo';
            break;
        default:
            $errores[] = 'Error desconocido en la subida';
    }
    
    if (!empty($errores)) {
        return ['valido' => false, 'errores' => $errores];
    }
    
    // Verificar tamaño
    if ($archivo['size'] > MAX_FILE_SIZE) {
        $errores[] = 'El archivo excede el tamaño máximo permitido (' . formatearTamaño(MAX_FILE_SIZE) . ')';
    }
    
    // Verificar extensión
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        $errores[] = 'Tipo de archivo no permitido. Extensiones permitidas: ' . implode(', ', ALLOWED_EXTENSIONS);
    }
    
    // Verificar tipo MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tipoMime = finfo_file($finfo, $archivo['tmp_name']);
    finfo_close($finfo);
    
    $tiposPermitidos = [
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'gif' => ['image/gif'],
        'pdf' => ['application/pdf'],
        'doc' => ['application/msword'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'xls' => ['application/vnd.ms-excel'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        'txt' => ['text/plain'],
        'csv' => ['text/csv', 'text/plain']
    ];
    
    if (isset($tiposPermitidos[$extension]) && !in_array($tipoMime, $tiposPermitidos[$extension])) {
        $errores[] = 'El contenido del archivo no coincide con su extensión';
    }
    
    return [
        'valido' => empty($errores),
        'errores' => $errores,
        'tipo_mime' => $tipoMime,
        'extension' => $extension
    ];
}

/**
 * Formatea un tamaño en bytes a formato legible
 * 
 * @param int $bytes Tamaño en bytes
 * @return string Tamaño formateado
 */
function formatearTamaño($bytes) {
    $unidades = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($unidades) - 1);
    
    $bytes /= (1 << (10 * $pow));
    
    return round($bytes, 2) . ' ' . $unidades[$pow];
}

?>