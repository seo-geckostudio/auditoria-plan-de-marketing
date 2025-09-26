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
    
    $resultado = ejecutarConsulta($sql, $params);
    return is_array($resultado) ? $resultado : [];
}

/**
 * Obtiene una auditoría específica con todos sus detalles
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array|false Datos de la auditoría
 */
function obtenerAuditoria($auditoriaId) {
    $sql = "SELECT 
        a.*,
        c.nombre_empresa as cliente,
        u.nombre as consultor
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.id = ?";
    return obtenerRegistro($sql, [$auditoriaId]);
}

/**
 * Crea una nueva auditoría
 * 
 * @param array $datos Datos de la auditoría
 * @return int|false ID de la auditoría creada
 */
function crearAuditoria($datos) {
    $auditoriaId = insertarRegistro('auditorias', $datos);
    
    if ($auditoriaId) {
        // Registrar en historial
        registrarCambio($auditoriaId, $datos['usuario_id'], 'creacion', 'Auditoría creada');
    }
    
    return $auditoriaId;
}

/**
 * Calcula y actualiza el porcentaje de completado de una auditoría
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return float Porcentaje calculado
 */
function calcularPorcentajeAuditoria($auditoriaId) {
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare("CALL CalcularPorcentajeAuditoria(?)");
        $stmt->execute([$auditoriaId]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['nuevo_porcentaje'] ?? 0;
    } catch (PDOException $e) {
        registrarError("Error calculando porcentaje: " . $e->getMessage());
        return 0;
    }
}

// =====================================================
// FUNCIONES DE PASOS
// =====================================================

/**
 * Obtiene los pasos de una auditoría organizados por fase
 * 
 * @param int $auditoriaId ID de la auditoría
 * @return array Pasos organizados por fase
 */
function obtenerPasosPorFase($auditoriaId) {
    $sql = "
        SELECT 
            f.numero_fase,
            f.nombre as fase_nombre,
            ap.id as auditoria_paso_id,
            pt.codigo_paso,
            pt.nombre as paso_nombre,
            pt.descripcion,
            pt.es_critico,
            ap.estado,
            ap.fecha_inicio,
            ap.fecha_completado,
            ap.notas,
            COUNT(a.id) as total_archivos
        FROM fases f
        LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
        LEFT JOIN auditoria_pasos ap ON pt.id = ap.paso_plantilla_id AND ap.auditoria_id = ?
        LEFT JOIN archivos a ON ap.id = a.auditoria_paso_id
        WHERE pt.activo = 1
        GROUP BY f.numero_fase, pt.id, ap.id
        ORDER BY f.numero_fase, pt.orden_en_fase
    ";
    
    $pasos = ejecutarConsulta($sql, [$auditoriaId]);
    
    // Verificar que $pasos sea un array válido
    if (!is_array($pasos)) {
        return [];
    }
    
    // Organizar por fases
    $fases = [];
    foreach ($pasos as $paso) {
        $numeroFase = $paso['numero_fase'];
        if (!isset($fases[$numeroFase])) {
            $fases[$numeroFase] = [
                'numero_fase' => $numeroFase,
                'nombre' => $paso['fase_nombre'],
                'pasos' => []
            ];
        }
        $fases[$numeroFase]['pasos'][] = $paso;
    }
    
    return $fases;
}

/**
 * Actualiza el estado de un paso
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param int $pasoId ID del paso
 * @param string $nuevoEstado Nuevo estado del paso
 * @param int $usuarioId ID del usuario que hace el cambio
 * @return bool True si se actualizó correctamente
 */
function actualizarEstadoPaso($auditoriaId, $pasoId, $nuevoEstado, $usuarioId) {
    $datos = ['estado' => $nuevoEstado];
    
    if ($nuevoEstado === 'completado') {
        $datos['fecha_completado'] = date('Y-m-d H:i:s');
    } elseif ($nuevoEstado === 'en_progreso') {
        $datos['fecha_inicio'] = date('Y-m-d H:i:s');
    }
    
    $resultado = actualizarRegistro('auditoria_pasos', $pasoId, $datos);
    
    if ($resultado) {
        // El trigger se encarga de actualizar el porcentaje y registrar el cambio
        return true;
    }
    
    return false;
}

// =====================================================
// FUNCIONES DE ARCHIVOS
// =====================================================

/**
 * Sube un archivo asociado a un paso
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param int $pasoId ID del paso
 * @param array $archivo Datos del archivo ($_FILES)
 * @param int $usuarioId ID del usuario que sube el archivo
 * @return bool True si se subió correctamente
 */
function subirArchivo($auditoriaId, $pasoId, $archivo, $usuarioId) {
    // Validar archivo
    if (!validarArchivo($archivo)) {
        return false;
    }
    
    // Generar nombre único
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombreUnico = uniqid() . '_' . time() . '.' . $extension;
    $rutaDestino = UPLOAD_PATH . $auditoriaId . '/' . $nombreUnico;
    
    // Crear directorio si no existe
    $directorioAuditoria = UPLOAD_PATH . $auditoriaId;
    if (!is_dir($directorioAuditoria)) {
        mkdir($directorioAuditoria, 0755, true);
    }
    
    // Mover archivo
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        // Guardar en base de datos
        $datosArchivo = [
            'auditoria_paso_id' => $pasoId,
            'nombre_original' => $archivo['name'],
            'nombre_archivo' => $nombreUnico,
            'ruta_archivo' => $rutaDestino,
            'tipo_mime' => $archivo['type'],
            'tamaño_bytes' => $archivo['size'],
            'subido_por_usuario_id' => $usuarioId
        ];
        
        $archivoId = insertarRegistro('archivos', $datosArchivo);
        
        if ($archivoId) {
            registrarCambio($auditoriaId, $usuarioId, 'archivo_subido', 
                          "Archivo subido: {$archivo['name']}");
            return true;
        }
    }
    
    return false;
}

/**
 * Valida un archivo subido
 * 
 * @param array $archivo Datos del archivo
 * @return bool True si es válido
 */
function validarArchivo($archivo) {
    // Verificar errores de subida
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    // Verificar tamaño
    if ($archivo['size'] > MAX_FILE_SIZE) {
        return false;
    }
    
    // Verificar extensión
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        return false;
    }
    
    return true;
}

// =====================================================
// FUNCIONES DE UTILIDAD
// =====================================================

/**
 * Registra un cambio en el historial
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param int $usuarioId ID del usuario
 * @param string $tipoCambio Tipo de cambio
 * @param string $descripcion Descripción del cambio
 * @param array $datosAnteriores Datos anteriores (opcional)
 * @param array $datosNuevos Datos nuevos (opcional)
 */
function registrarCambio($auditoriaId, $usuarioId, $tipoCambio, $descripcion, 
                        $datosAnteriores = null, $datosNuevos = null) {
    $datos = [
        'auditoria_id' => $auditoriaId,
        'usuario_id' => $usuarioId,
        'tipo_cambio' => $tipoCambio,
        'descripcion' => $descripcion
    ];
    
    if ($datosAnteriores) {
        $datos['datos_anteriores'] = json_encode($datosAnteriores);
    }
    
    if ($datosNuevos) {
        $datos['datos_nuevos'] = json_encode($datosNuevos);
    }
    
    insertarRegistro('historial_cambios', $datos);
}

/**
 * Registra un error en el log
 * 
 * @param string $mensaje Mensaje de error
 */
function registrarError($mensaje) {
    $fecha = date('Y-m-d H:i:s');
    $logFile = LOGS_PATH . 'errores_' . date('Y-m') . '.log';
    $entrada = "[{$fecha}] {$mensaje}" . PHP_EOL;
    file_put_contents($logFile, $entrada, FILE_APPEND | LOCK_EX);
}

/**
 * Formatea una fecha para mostrar
 * 
 * @param string $fecha Fecha en formato Y-m-d H:i:s
 * @param bool $incluirHora Si incluir la hora
 * @return string Fecha formateada
 */
function formatearFecha($fecha, $incluirHora = false) {
    if (!$fecha) return '-';
    
    $timestamp = strtotime($fecha);
    if ($incluirHora) {
        return date('d/m/Y H:i', $timestamp);
    } else {
        return date('d/m/Y', $timestamp);
    }
}

/**
 * Obtiene el nombre del estado con formato amigable
 * 
 * @param string $estado Estado del sistema
 * @param string $tipo Tipo de estado ('auditoria' o 'paso')
 * @return string Nombre formateado del estado
 */
function obtenerNombreEstado($estado, $tipo = 'auditoria') {
    $estados = $tipo === 'auditoria' ? ESTADOS_AUDITORIA : ESTADOS_PASO;
    return $estados[$estado] ?? $estado;
}

/**
 * Obtiene la clase CSS para un estado
 * 
 * @param string $estado Estado del sistema
 * @return string Clase CSS
 */
function obtenerClaseEstado($estado) {
    $clases = [
        'pendiente' => 'badge-secondary',
        'en_progreso' => 'badge-warning',
        'completado' => 'badge-success',
        'pausada' => 'badge-info',
        'cancelada' => 'badge-danger',
        'omitido' => 'badge-light',
        'bloqueado' => 'badge-dark'
    ];
    
    return $clases[$estado] ?? 'badge-secondary';
}

/**
 * Genera un token CSRF para formularios
 * 
 * @return string Token CSRF
 */
function generarTokenCSRF() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Solo generar un nuevo token si no existe uno
    if (!isset($_SESSION['csrf_token'])) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
    }
    
    return $_SESSION['csrf_token'];
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
 * Sanitiza datos de entrada
 * 
 * @param mixed $data Datos a sanitizar
 * @return mixed Datos sanitizados
 */
function sanitizar($data) {
    if (is_array($data)) {
        return array_map('sanitizar', $data);
    }
    
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Obtiene estadísticas generales del sistema
 * 
 * @return array Estadísticas
 */
function obtenerEstadisticasSistema() {
    $stats = [];
    
    try {
        $pdo = obtenerConexion();
        
        // Total de auditorías
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM auditorias");
        $stats['total_auditorias'] = $stmt->fetchColumn();
        
        // Auditorías completadas
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM auditorias WHERE estado = 'completado'");
        $stats['auditorias_completadas'] = $stmt->fetchColumn();
        
        // Progreso promedio
        $stmt = $pdo->query("SELECT AVG(progreso) as promedio FROM auditorias WHERE progreso IS NOT NULL");
        $progresoPromedio = $stmt->fetchColumn();
        $stats['progreso_promedio'] = $progresoPromedio ? round($progresoPromedio, 1) : 0;
        
        // Pasos críticos pendientes
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM pasos WHERE criticidad = 'alta' AND estado = 'pendiente'");
        $stats['pasos_criticos_pendientes'] = $stmt->fetchColumn();
        
        // Auditorías por estado
        $stmt = $pdo->query("SELECT estado, COUNT(*) as total FROM auditorias GROUP BY estado");
        $auditoriasPorEstado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stats['auditorias_por_estado'] = $auditoriasPorEstado;
        
        // Pasos completados hoy
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM pasos WHERE estado = 'completado' AND DATE(fecha_completado) = DATE('now')");
        $stats['pasos_completados_hoy'] = $stmt->fetchColumn();
        
        // Total de clientes
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM clientes");
        $stats['total_clientes'] = $stmt->fetchColumn();
        
        // Total de usuarios
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
        $stats['total_usuarios'] = $stmt->fetchColumn();
        
        return $stats;
        
    } catch (Exception $e) {
        registrarError("Error obteniendo estadísticas del sistema: " . $e->getMessage());
        return [
            'total_auditorias' => 0,
            'auditorias_completadas' => 0,
            'progreso_promedio' => 0,
            'pasos_criticos_pendientes' => 0,
            'auditorias_por_estado' => [],
            'pasos_completados_hoy' => 0,
            'total_clientes' => 0,
            'total_usuarios' => 0
        ];
    }
}

/**
 * Obtiene auditorías recientes
 * 
 * @param int $limite Número de auditorías a obtener
 * @return array Lista de auditorías recientes
 */
function obtenerAuditoriasRecientes($limite = 5) {
    try {
        $pdo = obtenerConexion();
        $sql = "
            SELECT 
                a.*,
                c.nombre as cliente_nombre,
                u.nombre as usuario_nombre
            FROM auditorias a
            LEFT JOIN clientes c ON a.cliente_id = c.id
            LEFT JOIN usuarios u ON a.usuario_id = u.id
            ORDER BY a.fecha_inicio DESC
            LIMIT ?
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limite]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        registrarError("Error obteniendo auditorías recientes: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene pasos críticos pendientes
 * 
 * @param int $limite Número de pasos a obtener
 * @return array Lista de pasos críticos pendientes
 */
function obtenerPasosCriticosPendientes($limite = 10) {
    try {
        $pdo = obtenerConexion();
        $sql = "
            SELECT 
                a.id as auditoria_id,
                a.titulo as auditoria_nombre,
                c.nombre as cliente_nombre,
                pt.codigo_paso,
                pt.nombre as paso_nombre,
                ap.estado,
                ap.fecha_inicio
            FROM auditoria_pasos ap
            JOIN auditorias a ON ap.auditoria_id = a.id
            LEFT JOIN clientes c ON a.cliente_id = c.id
            JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
            WHERE pt.es_critico = 1 
            AND ap.estado IN ('pendiente', 'en_progreso')
            AND a.estado IN ('en_progreso', 'pendiente')
            ORDER BY a.fecha_inicio DESC, pt.orden_en_fase
            LIMIT ?
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limite]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        registrarError("Error obteniendo pasos críticos: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene actividad reciente del sistema
 * 
 * @param int $limite Número de actividades a obtener
 * @return array Lista de actividades recientes
 */
function obtenerActividadReciente($limite = 8) {
    try {
        $pdo = obtenerConexion();
        
        // Como no tenemos tabla de historial_cambios, simulamos con cambios en pasos
        $sql = "
            SELECT 
                'paso_actualizado' as tipo_actividad,
                a.titulo as auditoria_nombre,
                c.nombre as cliente_nombre,
                pt.nombre as descripcion,
                ap.fecha_completado as fecha_actividad,
                u.nombre as usuario_nombre
            FROM auditoria_pasos ap
            JOIN auditorias a ON ap.auditoria_id = a.id
            LEFT JOIN clientes c ON a.cliente_id = c.id
            JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
            LEFT JOIN usuarios u ON a.usuario_id = u.id
            WHERE ap.fecha_completado IS NOT NULL
            ORDER BY ap.fecha_completado DESC
            LIMIT ?
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limite]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        registrarError("Error obteniendo actividad reciente: " . $e->getMessage());
        return [];
    }
}

/**
 * Verifica si el sistema está instalado correctamente
 * 
 * @return bool True si está instalado, false si no
 */
function verificarInstalacion() {
    try {
        $pdo = obtenerConexion();
        
        // Verificar si existe la tabla de auditorías (compatible con SQLite)
        $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='auditorias'");
        $tabla_existe = $stmt->fetchColumn() > 0;
        
        if (!$tabla_existe) {
            return false;
        }
        
        // Verificar si existe la tabla de pasos_plantilla (en lugar de 'pasos')
        $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='pasos_plantilla'");
        $tabla_pasos_existe = $stmt->fetchColumn() > 0;
        
        return $tabla_pasos_existe;
        
    } catch (PDOException $e) {
        // Si hay error de conexión, probablemente no está instalado
        return false;
    }
}
 
 /**
  * Obtiene datos para el gráfico de progreso de auditorías
  * 
  * @return array Datos formateados para Chart.js
  */
 function obtenerDatosGraficoProgreso() {
    try {
        $pdo = obtenerConexion();
        
        // Obtener progreso promedio por mes de los últimos 6 meses
        $sql = "
            SELECT 
                strftime('%Y-%m', fecha_inicio) as mes,
                AVG(porcentaje_completado) as progreso_promedio
            FROM auditorias 
            WHERE fecha_inicio >= date('now', '-6 months')
            GROUP BY strftime('%Y-%m', fecha_inicio)
            ORDER BY mes
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $labels = [];
        $data = [];
        
        foreach ($resultados as $resultado) {
            $labels[] = date('M Y', strtotime($resultado['mes'] . '-01'));
            $data[] = round($resultado['progreso_promedio'], 1);
        }
        
        // Si no hay datos, generar datos de ejemplo
        if (empty($labels)) {
            $labels = ['Ene 2024', 'Feb 2024', 'Mar 2024', 'Abr 2024', 'May 2024', 'Jun 2024'];
            $data = [0, 0, 0, 0, 0, 0];
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
        
    } catch (Exception $e) {
        registrarError("Error obteniendo datos gráfico progreso: " . $e->getMessage());
        return [
            'labels' => ['Sin datos'],
            'data' => [0]
        ];
    }
}

/**
 * Obtiene datos para el gráfico de estados de auditorías
 * 
 * @return array Datos formateados para Chart.js
 */
function obtenerDatosGraficoEstados() {
    try {
        $pdo = obtenerConexion();
        
        $sql = "
            SELECT 
                estado,
                COUNT(*) as total
            FROM auditorias 
            GROUP BY estado
            ORDER BY total DESC
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $labels = [];
        $data = [];
        
        $estadosNombres = [
            'pendiente' => 'Pendientes',
            'en_progreso' => 'En Progreso',
            'completado' => 'Completadas',
            'pausada' => 'Pausadas',
            'cancelada' => 'Canceladas'
        ];
        
        foreach ($resultados as $resultado) {
            $labels[] = $estadosNombres[$resultado['estado']] ?? ucfirst($resultado['estado']);
            $data[] = (int)$resultado['total'];
        }
        
        // Si no hay datos, generar datos de ejemplo
        if (empty($labels)) {
            $labels = ['Sin auditorías'];
            $data = [0];
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
        
    } catch (Exception $e) {
        registrarError("Error obteniendo datos gráfico estados: " . $e->getMessage());
        return [
            'labels' => ['Sin datos'],
            'data' => [0]
        ];
    }
}

/**
 * Obtiene la clase CSS para un estado específico
 * 
 * @param string $estado Estado de la auditoría
 * @return string Clase CSS
 */
function obtenerClaseCSS($estado) {
    $clases = [
        'pendiente' => 'bg-secondary',
        'en_progreso' => 'bg-warning',
        'completado' => 'bg-success',
        'pausada' => 'bg-info',
        'cancelada' => 'bg-danger'
    ];
    
    return $clases[$estado] ?? 'bg-secondary';
 }
 
 ?>