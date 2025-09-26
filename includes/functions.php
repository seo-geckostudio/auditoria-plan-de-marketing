<?php
/**
 * FUNCIONES GENERALES REUTILIZABLES
 * ==================================
 * 
 * Archivo con funciones comunes utilizadas en todo el sistema
 * de gestión de auditorías SEO
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

require_once __DIR__ . '/../config/database.php';

// =====================================================
// FUNCIONES DE BASE DE DATOS
// =====================================================

/**
 * Ejecuta una consulta preparada y retorna los resultados
 * 
 * @param string $sql Consulta SQL
 * @param array $params Parámetros para la consulta
 * @return array|false Resultados o false en caso de error
 */
function ejecutarConsulta($sql, $params = []) {
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        registrarError("Error en consulta: " . $e->getMessage());
        return false;
    }
}

/**
 * Ejecuta una consulta que retorna un solo registro
 * 
 * @param string $sql Consulta SQL
 * @param array $params Parámetros para la consulta
 * @return array|false Registro o false si no existe
 */
function obtenerRegistro($sql, $params = []) {
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        registrarError("Error obteniendo registro: " . $e->getMessage());
        return false;
    }
}

/**
 * Inserta un registro y retorna el ID generado
 * 
 * @param string $tabla Nombre de la tabla
 * @param array $datos Datos a insertar (campo => valor)
 * @return int|false ID del registro insertado o false en caso de error
 */
function insertarRegistro($tabla, $datos) {
    try {
        $pdo = obtenerConexion();
        
        $campos = array_keys($datos);
        $valores = array_values($datos);
        $placeholders = str_repeat('?,', count($campos) - 1) . '?';
        
        $sql = "INSERT INTO {$tabla} (" . implode(',', $campos) . ") VALUES ({$placeholders})";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($valores);
        
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        registrarError("Error insertando en {$tabla}: " . $e->getMessage());
        return false;
    }
}

/**
 * Actualiza un registro por ID
 * 
 * @param string $tabla Nombre de la tabla
 * @param int $id ID del registro
 * @param array $datos Datos a actualizar (campo => valor)
 * @return bool True si se actualizó correctamente
 */
function actualizarRegistro($tabla, $id, $datos) {
    try {
        $pdo = obtenerConexion();
        
        $campos = array_keys($datos);
        $valores = array_values($datos);
        $set = implode(' = ?, ', $campos) . ' = ?';
        
        $sql = "UPDATE {$tabla} SET {$set} WHERE id = ?";
        $valores[] = $id;
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($valores);
    } catch (PDOException $e) {
        registrarError("Error actualizando {$tabla}: " . $e->getMessage());
        return false;
    }
}

// =====================================================
// FUNCIONES DE AUDITORÍAS
// =====================================================

/**
 * Obtiene todas las auditorías con información resumida
 * 
 * @param array $filtros Filtros opcionales (estado, cliente_id, usuario_id)
 * @return array Lista de auditorías
 */
function obtenerAuditorias($filtros = []) {
    $sql = "SELECT 
        a.id,
        a.titulo as nombre,
        a.titulo as nombre_auditoria,
        a.descripcion,
        a.estado,
        a.porcentaje_completado,
        a.fecha_inicio,
        a.fecha_fin,
        a.fecha_creacion,
        a.fecha_actualizacion,
        a.cliente_id,
        a.usuario_id,
        c.nombre_empresa as cliente_nombre,
        u.nombre as consultor_nombre,
        0 as total_pasos,
        0 as pasos_completados,
        0 as pasos_pendientes
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE 1=1";
    $params = [];
    
    if (!empty($filtros['estado'])) {
        $sql .= " AND estado = ?";
        $params[] = $filtros['estado'];
    }
    
    if (!empty($filtros['cliente_id'])) {
        $sql .= " AND cliente_id = ?";
        $params[] = $filtros['cliente_id'];
    }
    
    if (!empty($filtros['usuario_id'])) {
        $sql .= " AND usuario_id = ?";
        $params[] = $filtros['usuario_id'];
    }
    
    $sql .= " ORDER BY a.fecha_creacion DESC";
    
    return ejecutarConsulta($sql, $params) ?: [];
}

/**
 * Obtiene una auditoría específica por ID
 * 
 * @param int $id ID de la auditoría
 * @return array|false Datos de la auditoría o false si no existe
 */
function obtenerAuditoria($id) {
    $sql = "SELECT 
        a.*,
        c.nombre_empresa as cliente_nombre,
        u.nombre as consultor_nombre
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.id = ?";
    
    return obtenerRegistro($sql, [$id]);
}

/**
 * Crea una nueva auditoría
 * 
 * @param array $datos Datos de la auditoría
 * @return int|false ID de la auditoría creada o false en caso de error
 */
function crearAuditoria($datos) {
    // Agregar fecha de actualización
    $datos['fecha_actualizacion'] = date('Y-m-d H:i:s');
    
    return insertarRegistro('auditorias', $datos);
}

// =====================================================
// FUNCIONES DE CLIENTES
// =====================================================

/**
 * Obtiene todos los clientes
 * 
 * @param array $filtros Filtros opcionales
 * @return array Lista de clientes
 */
function obtenerClientes($filtros = []) {
    $sql = "SELECT * FROM clientes WHERE 1=1";
    $params = [];
    
    if (!empty($filtros['activo'])) {
        $sql .= " AND activo = ?";
        $params[] = $filtros['activo'];
    }
    
    if (!empty($filtros['busqueda'])) {
        $sql .= " AND (nombre_empresa LIKE ? OR contacto_nombre LIKE ?)";
        $busqueda = '%' . $filtros['busqueda'] . '%';
        $params[] = $busqueda;
        $params[] = $busqueda;
    }
    
    $sql .= " ORDER BY nombre_empresa";
    
    return ejecutarConsulta($sql, $params) ?: [];
}

/**
 * Obtiene un cliente específico por ID
 * 
 * @param int $id ID del cliente
 * @return array|false Datos del cliente o false si no existe
 */
function obtenerCliente($id) {
    return obtenerRegistro("SELECT * FROM clientes WHERE id = ?", [$id]);
}

// =====================================================
// FUNCIONES DE FASES Y PASOS
// =====================================================

/**
 * Obtiene todas las fases disponibles
 * 
 * @return array Lista de fases
 */
function obtenerFases() {
    return ejecutarConsulta("SELECT * FROM fases WHERE activa = 1 ORDER BY orden_visualizacion") ?: [];
}

/**
 * Obtiene los pasos plantilla de una fase específica
 * 
 * @param int $faseId ID de la fase
 * @return array Lista de pasos plantilla
 */
function obtenerPasosPlantilla($faseId) {
    $sql = "SELECT * FROM pasos_plantilla WHERE fase_id = ? AND activo = 1 ORDER BY orden_en_fase";
    return ejecutarConsulta($sql, [$faseId]) ?: [];
}

/**
 * Crea los pasos de auditoría basados en las fases seleccionadas
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param array $fasesSeleccionadas IDs de las fases seleccionadas
 * @return bool True si se crearon correctamente
 */
function crearPasosAuditoria($auditoriaId, $fasesSeleccionadas) {
    try {
        foreach ($fasesSeleccionadas as $faseId) {
            $pasosPlantilla = obtenerPasosPlantilla($faseId);
            
            foreach ($pasosPlantilla as $paso) {
                $datosPaso = [
                    'auditoria_id' => $auditoriaId,
                    'paso_plantilla_id' => $paso['id'],
                    'estado' => 'pendiente',
                    'orden_personalizado' => $paso['orden_en_fase']
                ];
                
                insertarRegistro('auditoria_pasos', $datosPaso);
            }
        }
        
        return true;
    } catch (Exception $e) {
        registrarError("Error creando pasos de auditoría: " . $e->getMessage());
        return false;
    }
}

// =====================================================
// FUNCIONES DE UTILIDAD
// =====================================================

/**
 * Sanitiza una cadena de texto
 * 
 * @param string $texto Texto a sanitizar
 * @return string Texto sanitizado
 */
function sanitizar($texto) {
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

/**
 * Genera un token CSRF
 * 
 * @return string Token CSRF
 */
function generarTokenCSRF() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    
    return $token;
}

/**
 * Verifica un token CSRF
 * 
 * @param string $token Token a verificar
 * @return bool True si es válido
 */
function verificarTokenCSRF($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Registra un error en el log
 * 
 * @param string $mensaje Mensaje de error
 */
function registrarError($mensaje) {
    $fecha = date('Y-m-d H:i:s');
    $logFile = __DIR__ . '/../logs/errores_' . date('Y-m') . '.log';
    
    // Crear directorio de logs si no existe
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $entrada = "[{$fecha}] {$mensaje}" . PHP_EOL;
    file_put_contents($logFile, $entrada, FILE_APPEND | LOCK_EX);
}

/**
 * Registra un cambio en el historial
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param int $usuarioId ID del usuario
 * @param string $tipoCambio Tipo de cambio
 * @param string $descripcion Descripción del cambio
 * @param mixed $datosAnteriores Datos anteriores (opcional)
 * @param mixed $datosNuevos Datos nuevos (opcional)
 */
function registrarCambio($auditoriaId, $usuarioId, $tipoCambio, $descripcion, $datosAnteriores = null, $datosNuevos = null) {
    $datos = [
        'auditoria_id' => $auditoriaId,
        'usuario_id' => $usuarioId,
        'tipo_cambio' => $tipoCambio,
        'descripcion' => $descripcion,
        'datos_anteriores' => $datosAnteriores ? json_encode($datosAnteriores) : null,
        'datos_nuevos' => $datosNuevos ? json_encode($datosNuevos) : null
    ];
    
    insertarRegistro('historial_cambios', $datos);
}

/**
 * Formatea una fecha para mostrar
 * 
 * @param string $fecha Fecha en formato Y-m-d H:i:s
 * @param string $formato Formato de salida
 * @return string Fecha formateada
 */
function formatearFecha($fecha, $formato = 'd/m/Y H:i') {
    if (!$fecha) return '-';
    
    try {
        $dt = new DateTime($fecha);
        return $dt->format($formato);
    } catch (Exception $e) {
        return $fecha;
    }
}

/**
 * Calcula el porcentaje de completado de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return float Porcentaje de completado
 */
function calcularPorcentajeCompletado($auditoriaId) {
    $sql = "SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN estado = 'completado' THEN 1 ELSE 0 END) as completados
    FROM auditoria_pasos 
    WHERE auditoria_id = ?";
    
    $resultado = obtenerRegistro($sql, [$auditoriaId]);
    
    if (!$resultado || $resultado['total'] == 0) {
        return 0.0;
    }
    
    return round(($resultado['completados'] / $resultado['total']) * 100, 2);
}

/**
 * Actualiza el porcentaje de completado de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return bool True si se actualizó correctamente
 */
function actualizarPorcentajeCompletado($auditoriaId) {
    $porcentaje = calcularPorcentajeCompletado($auditoriaId);
    
    return actualizarRegistro('auditorias', $auditoriaId, [
        'porcentaje_completado' => $porcentaje,
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ]);
}

/**
 * Obtiene estadísticas generales del sistema
 * 
 * @return array Estadísticas
 */
function obtenerEstadisticas() {
    $stats = [];
    
    // Total de auditorías por estado
    $sql = "SELECT estado, COUNT(*) as total FROM auditorias GROUP BY estado";
    $resultados = ejecutarConsulta($sql);
    
    $stats['auditorias_por_estado'] = [];
    foreach ($resultados as $resultado) {
        $stats['auditorias_por_estado'][$resultado['estado']] = $resultado['total'];
    }
    
    // Total de clientes
    $stats['total_clientes'] = obtenerRegistro("SELECT COUNT(*) as total FROM clientes")['total'] ?? 0;
    
    // Total de usuarios
    $stats['total_usuarios'] = obtenerRegistro("SELECT COUNT(*) as total FROM usuarios")['total'] ?? 0;
    
    return $stats;
}

?>